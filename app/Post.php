<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body','user_id','cover_image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profileImage()
    {
        $imagePath = ($this->cover_image) ?  $this->cover_image : '/uploads/noimage.png';
        return  '/storage/' . $imagePath;
    }

}
