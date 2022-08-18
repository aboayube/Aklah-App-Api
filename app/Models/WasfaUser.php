<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasfaUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'note',
        'note_en',
        'price',
        'countity',
        'status',
        'user_id',
        'wasfa_id',
        'chef_id',
        'payment_status'
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
        return $this->belongsTo(Wasfa::class, 'wasfa_id', 'id');
    }
    /*   public function rating()
    {
        return $this->hasMany(Rating::class, 'reservations_id', 'id');
    } */
}
