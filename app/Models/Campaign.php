<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    //
    protected $table='campaigns';
    protected $fillable=['campaign_name','description','goal_amount','raised_amount','start_date','end_date','status','image'];
    public function donations(){
        return $this->HasMany(Donations::class);
    }
    
    
}
