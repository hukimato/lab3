<?php

namespace App\Domain\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['content', 'list_id', 'is_done'];

    public $timestamps = false;
}
