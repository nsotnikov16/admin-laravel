<?php

namespace App\Models\Admin;

use App\Models\Admin\BaseModel;

class Insert extends BaseModel
{
    protected $table = 'sa_inserts';
    protected $fillable = ['content'];
}
