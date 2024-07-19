<?php

namespace App\Models\Orders\Bids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class UserBid extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_bids';

    protected $fillable = ['id','user_id', 'bid_id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($userBid) {
            $userBid->user()->delete();
            $userBid->configs_listener()->delete();
        });

        static::restoring(function ($userBid) {
            $userBid->user()->withTrashed()->restore();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function configs_listener()
    {
        return $this->belongsTo(ConfigsListener::class, 'id', 'listener_id');
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }
}
