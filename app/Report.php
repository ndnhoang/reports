<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    
    public function report_type()
    {
        return $this->belongsTo('App\ReportType', 'type_id');
    }
    
}
