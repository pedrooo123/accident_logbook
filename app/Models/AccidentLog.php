<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentLog extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'location', 'licence_plate', 'flight_number', 'injured_people', 'description', 'date'];
}
