<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    public $fillable = ['player1Id','player2Id'];

    public function players()
    {
        return $this->belongsTo(User::class);
    }
}