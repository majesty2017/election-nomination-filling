<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NominationFilling extends Model
{
    use HasFactory, SoftDeletes;

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
