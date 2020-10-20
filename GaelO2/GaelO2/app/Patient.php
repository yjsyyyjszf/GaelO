<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;

    public function center(){
        return $this->belongsTo('App\Center', 'center_code', 'code');
    }

    public function study(){
        return $this->belongsTo('App\Study', 'study_name', 'name');
    }
}
