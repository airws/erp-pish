<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayerDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payer_details';
    protected $guarded = ['id'];

    public const TYPE_FACE = ['FIZ'=>'FIZ', 'UR'=>'UR', 'IP'=>'IP'];
}
