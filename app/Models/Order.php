<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = [
        'customer_name', 'whatsapp', 'items', 'total',
        'delivery', 'address', 'status', 'notes'
    ];
}