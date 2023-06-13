<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtMastHeader extends Model
{
    protected $table='court_mast_copy';
    protected $guarded=[];
    protected $primaryKey = 'court_code';

}
