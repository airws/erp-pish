<?php

namespace App\Models\Orders\Bids;

use App\Models\Orders\Bids\UserBid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use HasFactory, SoftDeletes;
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($bid) {
            $bid->usersBids()->each(function ($userBid) {
                $userBid->delete();
            });
        });

        static::restoring(function ($bid) {
            $bid->usersBids()->withTrashed()->each(function ($userBid) {
                $userBid->restore();
            });
        });
    }

    public function usersBids()
    {
        return $this->hasMany(UserBid::class);
    }
}
