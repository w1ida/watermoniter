<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;
    protected $primaryKey='pid';
    protected $fillable = ['pname','lng','lat','aid'];


    public function area()
    {
        return $this->belongsTo('App\Area','aid','aid');
    }
}
