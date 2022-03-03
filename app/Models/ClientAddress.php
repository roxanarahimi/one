<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'client_id', 'id');  //or hasMany?!
    }
}
