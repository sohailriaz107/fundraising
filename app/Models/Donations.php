<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    //
    protected $table = "donations";
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
