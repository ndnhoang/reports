<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id', 'meta_name', 'meta_value'
    ];
    
    public function report()
    {
        return $this->belongsTo('App\Report');
    }
    
}
