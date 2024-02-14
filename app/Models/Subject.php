<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function career(){
        return $this->belongsTo(Career::class);
    }

    protected $fillable = [
        'name',
        'career_id'
    ];
}
