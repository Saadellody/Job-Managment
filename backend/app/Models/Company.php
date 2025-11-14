<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory, Notifiable;

    public $fillable=['name','logo','description','website','slug'];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function JobPosts(){
        return $this->hasMany(JobPost::class);
    }
}
