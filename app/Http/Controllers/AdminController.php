<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;


class AdminController extends Controller
{
    /* ── DASHBOARD ── */
    public function index()
    {
        $products      = Product::with('category')->get();
        $categories    = Category::all();
        $orders        = Order::latest()->get();
        $testimonials  = Testimonial::latest()->get();
        $totalPending  = $orders->where('status', 'pending')->count();
        $totalDiterima = $orders->where('status', 'diterima')->count();
        $totalRevenue  = $orders->where('status', 'diterima')->sum('total');

        return view('admin.dashboard', compact(
            'products', 'categories', 'orders', 'testimonials',
            'totalPending', 'totalDiterima', 'totalRevenue'
        ));
    }

    /* ── PRODUK: CREATE ── */
    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required',
            'description'   => 'required',
            'price_regular' => 'required|numeric',
            'price_large'   => 'required|numeric',
            'image'         => 'required|image',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        Product::create([
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'price_regular' => $request->price_regular,
            'price_large'   => $request->price_large,
            'image'         => $imageName,
        ]);

        return redirect('/admin')->with('success', 'Produk berhasil ditambahkan!');
    }

    /* ── PRODUK: EDIT ── */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required',
            'description'   => 'required',
            'price_regular' => 'required|numeric',
            'price_large'   => 'required|numeric',
            'image'         => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $oldPath = public_path('products/' . $product->image);
            if (file_exists($oldPath)) unlink($oldPath);

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->name          = $request->name;
        $product->category_id   = $request->category_id;
        $product->description   = $request->description;
        $product->price_regular = $request->price_regular;
        $product->price_large   = $request->price_large;
        $product->save();

        return redirect('/admin')->with('success', 'Produk berhasil diupdate!');
    }
public function selesai($id)
{
    $order = Order::findOrFail($id);
    $order->update(['status' => 'diterima']);

    return back()->with('success', 'Pesanan ditandai selesai.');
}
    /* ── PRODUK: DELETE ── */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $oldPath = public_path('products/' . $product->image);
        if (file_exists($oldPath)) unlink($oldPath);
        $product->delete();

        return redirect('/admin')->with('success', 'Produk berhasil dihapus!');
    }
    /* ── HALAMAN PRODUK ── */
public function products()
{
    $products   = Product::with('category')->get();
    $categories = Category::all();
    return view('admin.products', compact('products', 'categories'));
}

/* ── HALAMAN TESTIMONI ── */
public function testimonials()
{
    $testimonials = \App\Models\Testimonial::all();
    return view('admin.testimonials', compact('testimonials'));
}
    /* ── ORDER: SIMPAN MANUAL ── */
    public function storeOrder(Request $request)
{
    $request->validate([
        'customer_name' => 'required',
        'items'         => 'required',
        'total'         => 'required|numeric',
        'delivery'      => 'required',
    ]);

    Order::create([
        'customer_name' => $request->customer_name,
        'whatsapp'      => $request->whatsapp,  // ← tambah ini
        'items'         => $request->items,
        'total'         => $request->total,
        'delivery'      => $request->delivery,
        'address'       => $request->address,
        'status'        => 'pending',
        'notes'         => $request->notes,
    ]);

    return redirect('/admin')->with('success', 'Order berhasil dicatat!');
}

    /* ── ORDER: SIMPAN DARI WEBSITE (AJAX) ── */
    public function storeFromWebsite(Request $request)
    {
        try {
            $items = $request->items;

            if (is_array($items)) {
                $items = collect($items)->map(function ($item, $i) {
                    $subtotal = ($item['price'] ?? 0) * ($item['qty'] ?? 1);
                    return ($i + 1) . '. ' . ($item['product_name'] ?? $item['name'] ?? '') .
                        ' - ' . ($item['size'] ?? '') .
                        ' x' . ($item['qty'] ?? 1) .
                        ' - Rp ' . number_format($subtotal, 0, ',', '.');
                })->implode("\n");
            }

            $total    = $request->total ?? $request->total_price ?? 0;
            $delivery = $request->delivery ?? $request->delivery_type ?? 'antar';

            Order::create([
    'customer_name' => $request->customer_name,
    'whatsapp'      => $request->customer_phone ?? null,
    'items'         => $items,
    'total'         => $total,
    'delivery'      => $delivery,
    'address'       => $request->address ?? '',
    'status'        => 'pending',
    'notes'         => 'Order dari website',
]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /* ── ORDER: UPDATE STATUS ── */
    public function updateOrderStatus(Request $request, $id)
    {
        $order         = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect('/admin')->with('success', 'Status order diperbarui!');
    }

    /* ── ORDER: DELETE ── */
    public function destroyOrder($id)
    {
        Order::findOrFail($id)->delete();
        return redirect('/admin')->with('success', 'Order dihapus!');
    }

    /* ══════════════════════════════════════
       TESTIMONIAL CRUD
    ══════════════════════════════════════ */

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'role'    => 'required',
            'content' => 'required',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'name'      => $request->name,
            'role'      => $request->role,
            'content'   => $request->content,
            'rating'    => $request->rating,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect('/admin')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function updateTestimonial(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required',
            'role'    => 'required',
            'content' => 'required',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Testimonial::findOrFail($id)->update([
            'name'      => $request->name,
            'role'      => $request->role,
            'content'   => $request->content,
            'rating'    => $request->rating,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect('/admin')->with('success', 'Testimoni berhasil diupdate!');
    }

    public function destroyTestimonial($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect('/admin')->with('success', 'Testimoni berhasil dihapus!');
    }
}