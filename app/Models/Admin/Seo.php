<?php

namespace App\Models\Admin;

use App\Models\Admin\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Admin\Form\Domain\Dto\FormFieldDto;

class Seo extends BaseModel
{
    use HasFactory;
    protected $table = 'sa_seo';

    protected $attributes = [
        'active' => false, // значение по умолчанию для active
    ];

    public static function getColumns()
    {
        return [
            'id' => ['name' => 'ID', 'type' => FormFieldDto::TYPE_TEXT, 'default' => true],
            'url' => ['name' => 'URL', 'type' => FormFieldDto::TYPE_TEXT, 'default' => true],
            'title' => ['name' => 'TITLE', 'type' => FormFieldDto::TYPE_TEXT, 'default' => true],
            'h1' => ['name' => 'H1', 'type' => FormFieldDto::TYPE_TEXT, 'default' => true],
            'description' => ['name' => 'DESCRIPTION', 'type' => FormFieldDto::TYPE_TEXT, 'default' => true],
            'active' => ['name' => 'Активность', 'type' => FormFieldDto::TYPE_CHECKBOX, 'default' => true],
            //'entity_id' => ['name' => 'Привязка', 'type' => FormFieldDto::TYPE_DROPDOWN, 'default' => true],
            'created_at' => ['name' => 'Дата создания', 'type' => FormFieldDto::TYPE_TEXT, 'default' => true],
            'updated_at' => ['name' => 'Дата обновления', 'type' => FormFieldDto::TYPE_TEXT, 'default' => true]
        ];
    }
}
