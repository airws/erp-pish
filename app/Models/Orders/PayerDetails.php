<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayerDetails extends Model
{
    use HasFactory;

    protected $table = 'payer_details';
    protected $guarded = ['id'];

}
