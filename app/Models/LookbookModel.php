<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookbookModel extends Model
{
    protected $table = 'lookbook_models';

    protected $fillable = [
        'name',
        'detail',
        'image',
    ];
}