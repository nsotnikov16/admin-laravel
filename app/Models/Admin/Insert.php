<?php

namespace App\Models\Admin;

use Admin\Field\Domain\Dto\FieldCollectionDto;
use Admin\Field\Domain\Dto\FieldDto;
use App\Models\Admin\BaseModel;

class Insert extends BaseModel
{
    protected $table = 'sa_inserts';
    protected $fillable = ['content'];
}
