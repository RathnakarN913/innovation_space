<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mappingserveyor extends Model
{
    use HasFactory;

    protected $table='mappingserveyor';



    protected $fillable=[
         'country_id',
         'state_id',
         'project_id',
         'surveyor_id'
         
       

    ];
}
