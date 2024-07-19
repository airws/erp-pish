<?php

namespace App\Models\Orders\Bids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigsListener extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'configs_listeners';
    protected $fillable = ['listener_id', 'group_programm_id', 'count_clock', 'programm_type', 'form_education', 'type_document', 'price'];

    public function usersBids()
    {
        return $this->hasMany(UserBid::class);
    }
}
