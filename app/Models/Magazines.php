<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazines extends Model
{
    use HasFactory;
    protected $table = 'magazines';
    protected $fillable = [
        'name',
        'faculties_id',
    ];
    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'magazines_id');
    }
    public function faculties()
    {
        return $this->belongsTo(Faculties::class);
    }
}
