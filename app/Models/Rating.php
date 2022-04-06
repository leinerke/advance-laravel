<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Rating extends Pivot
{
    public function rateable()
    {
        $this->morphTo();
    }

    public function qualifier()
    {
        $this->morphTo();
    }
}
