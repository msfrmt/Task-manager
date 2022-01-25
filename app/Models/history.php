<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'task_name', 'completion_date', 'completion_status'
    ];


    /*public function task(){

    	return $this->belongsTo(User::class);
    }*/

    public function scopeActive($query){
        return $query->where('completion_status', 1);
    }
}
