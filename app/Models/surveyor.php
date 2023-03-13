<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveyor extends Model
{
    use HasFactory;
    protected $table='surveyor';



        protected $fillable = [
            'name', 
            'mobilenumber', 
            'emailid',
            'state',
            'country',
            'pincode',
            'age',
            'gender',
            'file',
            'remarks',
            'status',
            'created_at',
            'updated_at'
        
        ];
}
