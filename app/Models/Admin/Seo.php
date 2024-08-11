<?php

namespace App\Models\Admin;

use App\Models\Admin\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seo extends BaseModel
{
    use HasFactory;
    protected $table = 'sa_seo';

    public static function getColumns()
    {
        return [
            'id' => 'ID',
            'url' => 'URL',
            'title' => 'title',
            'h1' => 'h1',
            'description' => 'description',
            'active' => 'Активность',
            'entity_id' => 'Привязка',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления'
        ];
    }
}
