<?php

namespace App\Domain\MyList\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
    protected $fillable = ['title',];

    public $timestamps = false;
}
