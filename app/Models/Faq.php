<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Faq extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'title_en', 'status', 'body_en', 'body', 'id', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function title($query)
    {
        if (App::getLocale() == 'ar') {
            $title = $this->title;
        } else {
            $title = $this->title_en;
        }
        return $title;
    }
    public function body()
    {
        if (App::getLocale() == 'ar') {
            $body = $this->body;
        } else {
            $body = $this->body_en;
        }
        return $body;
    }
}
