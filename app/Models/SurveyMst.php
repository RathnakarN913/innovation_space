<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyMst extends Model
{
    use HasFactory;
    protected $table='survey_mst';
    protected $guarded = [];
     public function GetProject()
    {
      
        return $this->belongsTo('App\Models\CreateProject','project_id','id');
    }
}
