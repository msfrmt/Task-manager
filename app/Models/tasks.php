<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_name', 'completion_date', 'completion_status'
    ];



    public function user(){

    	return $this->belongsTo(User::class);
    }

   /* public function history(){

    	return $this->belongsTo(history::class);
    }*/

    public function scopeActive($query, $q){
        return $query->where('completion_status', $q);
                     
  } 
}
