<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'full_name', 'email', 'phone_no', 'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
