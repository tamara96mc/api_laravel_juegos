<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public $fillable = ['username','email','password','role','steamUsername'];

    protected $hidden = ['password'];


    public function parties()
    {
        return $this->hasMany(Party::class);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}