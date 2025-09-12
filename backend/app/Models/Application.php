<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Application extends Model
{
    use HasFactory , Notifiable;

    public $fillable= ['cv_path','message'];


    public function User(){
        return $this->belongsTo(User::class);
    }
    public function JobPost(){
        return $this->belongsTo(JobPost::class);
    }
}
