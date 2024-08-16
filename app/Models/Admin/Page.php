<?php

namespace App\Models\Admin;

use App\Models\Admin\BaseModel;


class Page extends BaseModel
{
    protected $table = 'sa_pages';

    public static function getColumns()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'URL',
            'title' => 'title',
            'h1' => 'h1',
            'description' => 'description',
            'content' => 'Содержимое',
            'active' => 'Активность',
            'parent_id' => 'Родительская страница',
            'subdomains' => 'Поддомены',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления'
        ];
    }
}
