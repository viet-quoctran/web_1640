<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
    ];

    public function user()
    {
        // Giả định rằng bạn có mối quan hệ 'student' trong model User
        return $this->belongsTo(User::class, 'student_id');
    }

    public function words()
    {
        return $this->hasMany(Word::class, 'contribution_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'contribution_id');
    }
}
