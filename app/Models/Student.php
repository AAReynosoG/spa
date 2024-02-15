<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function academicData(){
        return $this->hasMany(AcademicData::class);
    }

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'address',
    ];
}
