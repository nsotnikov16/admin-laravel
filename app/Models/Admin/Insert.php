<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insert extends Model
{
    use HasFactory;
    protected $table = 'sa_inserts';
    protected $fillable = ['content'];
}
