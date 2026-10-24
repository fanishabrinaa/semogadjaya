<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    $db = \Illuminate\Support\Facades\DB::class;

    // Pastikan 3 kategori ada
    $db::table('categories')->updateOrInsert(['id' => 1], ['name' => 'Kopi']);
    $db::table('categories')->updateOrInsert(['id' => 2], ['name' => 'Non Kopi']);
    $db::table('categories')->updateOrInsert(['id' => 3], ['name' => 'Dessert']);

    $nonKopi = [27, 37, 38, 39, 42, 44, 46];

    // Semua produk lain = Kopi, 7 produk ini = Non Kopi
    $db::table('products')->whereNotIn('id', $nonKopi)->update(['category_id' => 1]);
    $db::table('products')->whereIn('id', $nonKopi)->update(['category_id' => 2]);
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
