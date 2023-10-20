<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = ['id'];
    protected $dates = [
      'created_at'
    ];


//    public function setCreatedAtAttribute($value)
//    {
//        $this->attributes['created_at'] = Carbon::parse($value);
//    }

    public function orders_users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function orders_managers()
    {
        return $this->hasMany(User::class, 'id', 'manager_id');
    }
}
