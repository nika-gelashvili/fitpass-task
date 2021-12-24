<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportFacility extends Model
{
    protected $table = 'sport_facilities';
    use HasFactory, Uuids;
}
