<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneratedCode extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->select(['id', 'name', 'email']);
    }
}
