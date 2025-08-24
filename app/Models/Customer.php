<?php
// app/Models/Customer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;


class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'notes'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
