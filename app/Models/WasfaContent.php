<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class WasfaContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_en',
        'price',
        'status',
        'wasfa_id',
        'image',
        'image_id',
    ];


    public function wasfa()
    {
        return $this->belongsTo(Wasfa::class, 'wasfa_id', 'id');
    }
    public function name()
    {
        if (App::getLocale() == 'ar') {
            $name = $this->name;
        } else {
            $name = $this->name_en;
        }
        return $name;
    }
}
