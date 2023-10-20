<?php

namespace App\Contracts;

interface ISender
{
    public function send(string $to, mixed $message);
}