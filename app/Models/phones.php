<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class phones extends Model
{

    public function User (){

        return $this->belongsTo('App\Models\User');
        
        }

        protected $fillable =['phone','user_id'];

    protected $table='phones';  
use SoftDeletes;
    use HasFactory;
}
