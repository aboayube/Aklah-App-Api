<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasfaUserContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'wasfa_id',
        'wasfa_contents_id',
        'contity',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function wasfa()
    {
        return $this->belongsTo(Wasfa::class, 'wasfa_id', 'id');
    }
    public function wasfa_contents()
    {
        return $this->belongsTo(WasfaContent::class, 'wasfa_contents_id', 'id');
    }
}
