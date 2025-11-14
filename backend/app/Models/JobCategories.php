<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JobCategories extends Model
{
    use HasFactory , Notifiable; 
    

    public $fillable= ['name'];

    public function JobPosts(){
        return $this->hasMany(JobPost::class);
    }
}
