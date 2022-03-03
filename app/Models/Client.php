<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function allOrders()
    {
        return $this->hasMany(Order::class,'client_id','id')->orderByDesc('id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,   'id','client_id')->where('status','< >','cart')->orderByDesc('id');
    }

    public function cart()
    {
        return $this->hasOne(Order::class, 'client_id', 'id')->where('status','cart');
    }
    public function addresses()
    {
        return $this->hasMany(ClientAddress::class,   'client_id','id');
    }
}
