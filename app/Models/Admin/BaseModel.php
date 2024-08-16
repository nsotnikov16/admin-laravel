<?

namespace App\Models\Admin;

use Admin\Field\Domain\Dto\FieldCollectionDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    protected $guarded = [
        '_method',
        '_token'
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y H:i'); // Форматируем дату создания
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y H:i'); // Форматируем дату обновления
    }

    public static function getFieldsForCreate(): FieldCollectionDto
    {
        $fields = self::getFields();
        $fields->remove(fn($item) => in_array($item->name, ['id', 'created_at', 'updated_at']));
        $activeItemKey = $fields->search(fn($item) => $item->name === 'active');
        $fields[$activeItemKey]->setChecked(true);
        return $fields;
    }

    public function getFieldsWithValues(): FieldCollectionDto
    {
        $fields = $this->getFields();
        foreach ($fields as $key => $field) {
            $fields[$key]->setValue($this[$field->name]);
            $fields[$key]->setChecked((bool) $this[$field->name]);
            if ($field->name === 'active') $fields[$key]->setValue('1');
        }
        return $fields;
    }
}
