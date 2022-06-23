<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $guarded = ['*'];

    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from');
    }

    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to');
    }

    public function subLocation() {
        return $this->belongsToMany(Location::class, 'route_sub_location', 'route_id', 'sub_location_id')->withPivot('status');
    }
}
