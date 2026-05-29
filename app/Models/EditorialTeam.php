<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditorialTeam extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'role',
        'description',
        'order_column',
    ];
}
