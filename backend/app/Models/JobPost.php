<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JobPost extends Model
{
    use HasFactory , Notifiable;

    public $fillable= ['title','description','type','location','salary_range','is_approved'];


    public function JobCategorie(){ 
        return $this->belongsTo(JobCategories::class);
    }

    public function Company(){
        return $this->belongsTo(Company::class);
    }
    public function Applications(){
        return $this->hasMany(Application::class);
    }
}
