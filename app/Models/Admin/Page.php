<?php

namespace App\Models\Admin;

use App\Models\Admin\BaseModel;
use Admin\Field\Domain\Dto\FieldDto;
use Admin\Field\Domain\Dto\FieldCollectionDto;
use Admin\Dropdown\Domain\Dto\DropdownCollectionDto;


class Page extends BaseModel
{
    protected $table = 'sa_pages';

    protected $attributes = [
        'active' => false, // значение по умолчанию для active
    ];

    public static function getFields()
    {
        return new FieldCollectionDto([
            (new FieldDto)->setName('id')->setLabel('ID')->setType(FieldDto::TYPE_TEXT)->setReadOnly(true),
            (new FieldDto)->setName('active')->setLabel('Активность')->setType(FieldDto::TYPE_CHECKBOX)->setValue('1'),
            (new FieldDto)->setName('created_at')->setLabel('Дата создания')->setType(FieldDto::TYPE_TEXT)->setReadOnly(true),
            (new FieldDto)->setName('updated_at')->setLabel('Дата обновления')->setType(FieldDto::TYPE_TEXT)->setReadOnly(true),
            (new FieldDto)->setName('name')->setLabel('Название')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('url')->setLabel('URL')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('title')->setLabel('TITLE')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('h1')->setLabel('H1')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('description')->setLabel('DESCRIPTION')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('content')->setLabel('Содержимое')->setType(FieldDto::TYPE_TEXTAREA)->setTextareaRows(20),
            (new FieldDto)->setName('parent_id')->setLabel('Родительская страница')->setType(FieldDto::TYPE_DROPDOWN)->setCollection(new DropdownCollectionDto([])),
            (new FieldDto)->setName('subdomains')->setLabel('Поддомены')->setType(FieldDto::TYPE_TEXT)->setMultiple(true),
        ]);
    }
}
