<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Wasfa extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_en',
        'discription',
        'discription_en',
        'status',
        'image',
        'price',
        'user_id',
        'category_id',
        'time_make',
        'number_user',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function wasfa_content()
    {
        return $this->hasMany(WasfaContent::class);
    }
    public function wasfa_users()
    {
        return $this->hasMany(WasfaUser::class, 'wasfa_id', 'id');
    }
    public function wasfa_user_content()
    {
        return $this->belongsTo(WasfaUserContent::class, 'wasfa_id', 'id');
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
    public function discription()
    {
        if (App::getLocale() == 'ar') {
            $discription = $this->discription;
        } else {
            $discription = $this->discription_en;
        }
        return $discription;
    }
}
