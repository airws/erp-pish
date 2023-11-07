<?php

namespace app\Contracts;

interface IReceiverData
{
    public function getData(int $id): array;
}