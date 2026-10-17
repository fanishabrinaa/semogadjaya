<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Koordinat toko & radius maksimal pengantaran (harus sama dengan di JavaScript)
    private const STORE_LAT       = -6.5199;
    private const STORE_LNG       = 110.7662;
    private const MAX_DELIVERY_KM = 5;

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
            'name'          => 'required|string|max:100',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'required|string',
            'price_regular' => 'required|numeric|min:0',
            'price_large'   => 'required|numeric|min:0',
            'image'         => 'required|image|max:2048',
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
            'name'          => 'required|string|max:100',
            'category_id'   => 'required|exists:categories,id',
            'description'   => 'required|string',
            'price_regular' => 'required|numeric|min:0',
            'price_large'   => 'required|numeric|min:0',
            'image'         => 'nullable|image|max:2048',
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
        $testimonials = Testimonial::all();
        return view('admin.testimonials', compact('testimonials'));
    }

    /* ── ORDER: SIMPAN MANUAL (diinput admin) ── */
    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'items'         => 'required',
            'total'         => 'required|numeric|min:0',
            'delivery'      => 'required',
        ]);

        Order::create([
            'customer_name' => $request->customer_name,
            'whatsapp'      => $request->whatsapp,
            'items'         => $request->items,
            'total'         => $request->total,
            'delivery'      => $request->delivery,
            'address'       => $request->address,
            'status'        => 'pending',
            'notes'         => $request->notes,
        ]);

        return redirect('/admin')->with('success', 'Order berhasil dicatat!');
    }

    /* ── ORDER: SIMPAN DARI WEBSITE (AJAX, publik) ──
       Browser HANYA mengirim id produk, ukuran, dan jumlah.
       Harga & total dihitung di server dari database, jadi tidak bisa dimanipulasi. */
    public function storeFromWebsite(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:100',
            'delivery'      => 'required|in:antar,jemput',
            'address'       => 'nullable|string|max:500',
            'latitude'      => 'nullable|numeric|between:-90,90',
            'longitude'     => 'nullable|numeric|between:-180,180',
            'items'         => 'required|array|min:1|max:30',
            'items.*.id'    => 'required|integer|exists:products,id',
            'items.*.size'  => 'required|in:Regular,Large',
            'items.*.qty'   => 'required|integer|min:1|max:50',
        ]);

        // Validasi lokasi antar di server (bukan hanya di JavaScript)
        if ($data['delivery'] === 'antar') {
            if (empty($data['address']) || !isset($data['latitude'], $data['longitude'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lokasi pengiriman belum dipilih.',
                ], 422);
            }

            $jarak = $this->distanceKm(
                self::STORE_LAT, self::STORE_LNG,
                (float) $data['latitude'], (float) $data['longitude']
            );

            if ($jarak > self::MAX_DELIVERY_KM) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lokasi di luar area pengiriman (maks ' . self::MAX_DELIVERY_KM . ' km).',
                ], 422);
            }
        }

        // Hitung harga dari database
        $products = Product::whereIn('id', collect($data['items'])->pluck('id')->unique())
            ->get()
            ->keyBy('id');

        $total   = 0;
        $lines   = [];
        $summary = [];

        foreach (array_values($data['items']) as $i => $row) {
            $product  = $products[$row['id']];
            $price    = $row['size'] === 'Large' ? $product->price_large : $product->price_regular;
            $subtotal = $price * $row['qty'];
            $total   += $subtotal;

            $lines[] = ($i + 1) . '. ' . $product->name .
                ' - ' . $row['size'] .
                ' x' . $row['qty'] .
                ' - Rp ' . number_format($subtotal, 0, ',', '.');

            $summary[] = [
                'name'     => $product->name,
                'size'     => $row['size'],
                'qty'      => (int) $row['qty'],
                'subtotal' => (int) $subtotal,
            ];
        }

        Order::create([
            'customer_name' => $data['customer_name'],
            'whatsapp'      => null,
            'items'         => implode("\n", $lines),
            'total'         => $total,
            'delivery'      => $data['delivery'],
            'address'       => $data['delivery'] === 'antar' ? $data['address'] : 'Jemput ke Store',
            'status'        => 'pending',
            'notes'         => 'Order dari website',
        ]);

        return response()->json([
            'success' => true,
            'total'   => (int) $total,
            'items'   => $summary,
        ]);
    }

    /* ── ORDER: UPDATE STATUS ── */
    public function updateOrderStatus(Request $request, $id)
    {
        // Sesuaikan daftar ini dengan status yang dipakai di dashboard kamu,
        // mis. 'in:pending,diterima,ditolak'
        $request->validate([
            'status' => 'required|string|max:20',
        ]);

        $order         = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect('/admin')->with('success', 'Status order diperbarui!');
    }

    /* ── ORDER: TANDAI SELESAI ── (belum ada route-nya di web.php) */
    public function selesai($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'diterima']);

        return back()->with('success', 'Pesanan ditandai selesai.');
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

    /* ── Hitung jarak dua koordinat (rumus haversine), hasil dalam km ── */
    private function distanceKm(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $r    = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) ** 2
           + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;

        return 2 * $r * asin(min(1, sqrt($a)));
    }
}