<?php

namespace App\Services;

use App\Exceptions\ProgramInBidNotFound;
use App\Models\Orders\Bids\Bid;

class BidService
{
    public static function deleteProgram(string $id, string $bidId)
    {
        $bid = Bid::where(['id' => $bidId, 'program_id' => $id])->first();
        if(!$bid)
        {
            throw new ProgramInBidNotFound();
        }
        $bid->delete();


        return $bid;
    }
}