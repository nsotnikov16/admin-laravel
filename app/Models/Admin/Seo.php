<?php

namespace App\Models\Admin;

use Admin\Dropdown\Domain\Dto\DropdownCollectionDto;
use Admin\Field\Domain\Dto\FieldCollectionDto;
use App\Models\Admin\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Admin\Field\Domain\Dto\FieldDto;

class Seo extends BaseModel
{
    use HasFactory;
    protected $table = 'sa_seo';

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
            (new FieldDto)->setName('url')->setLabel('URL')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('title')->setLabel('TITLE')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('h1')->setLabel('H1')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('description')->setLabel('DESCRIPTION')->setType(FieldDto::TYPE_TEXT),
            (new FieldDto)->setName('entity_id')->setLabel('Привязка')->setType(FieldDto::TYPE_DROPDOWN)->setCollection(new DropdownCollectionDto([])),
        ]);
    }

    public function getFieldsWithValues() {
        $fields = self::getFields();
        foreach ($fields as $key => $field) {
            $fields[$key]->setValue($this[$field->name]);
            if ($field->name === 'active') $fields[$key]->setValue('1');
            $fields[$key]->setChecked((bool) $this[$field->name]);
        }
        return $fields;
    }
}
