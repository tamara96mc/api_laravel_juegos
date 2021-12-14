<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public $fillable = ['title','thumbnail_url','url'];

    public function parties()
    {
        return $this->hasMany(Party::class);
    }

}