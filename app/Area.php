<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    //protected $table = 'areas';
    protected $primaryKey='aid';
    protected $fillable = ['aname','remark'];
    public function points(){
        return $this->hasMany('App\Point','aid','aid');
    }
}
