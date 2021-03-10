<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ResolveTimestampTrait
{
    public function EpochConverter($unixTimestamp)
    {
        return date("d.m.Y", substr($unixTimestamp, 0, 10));
    }
}
