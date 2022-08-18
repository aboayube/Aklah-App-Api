<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating', 'note', 'note_en', 'type', 'user_id', 'wasfa_id', 'chef_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id', 'id');
    }
    public function wasfa()
    {
        return $this->belongsTo(Wasfa::class);
    }
}
