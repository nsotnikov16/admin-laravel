<?php

namespace App\Services;

use App\Models\Admin\Entity;
use App\Models\Admin\Insert;
use Illuminate\Support\Facades\DB;
use Admin\Query\Domain\Dto\QueryDto;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class AdminService
{
    public string $title = '';
    public $breadcrumbs;

    public function getEntities(): array
    {
        return Entity::all()->toArray();
    }

    public function getInserts(): EloquentCollection
    {
        return Insert::all();
    }

    public function getRecords(QueryDto $dto)
    {
        $dto->table ? ($query = DB::table($dto->table)) : ($query = new $dto->modelClass);
        $query = $query->orderBy($dto->sortBy, $dto->sortType);
        $query = $dto->logicAnd ? $query->where($dto->filter) : $query->orWhere($dto->filter);
        $records = $query->select($dto->columns)->paginate($dto->limit);
        return $records;
    }

    public function modifyRecords(array $records, callable $callback = null)
    {
        foreach ($records as $key => $record) {
            $records[$key] = $this->modifyRecord(json_decode(json_encode($record), true), $callback);
        }

        return $records;
    }

    public function modifyRecord(array $record, callable $callback = null)
    {
        foreach ($record as $key => $value) {
            switch ($key) {
                case 'active':
                    $record[$key] = ($value ? 'Да' : 'Нет');
                    break;
            }
        }

        if ($callback) $record = $callback($record);
        return $record;
    }

    public function getPropTable(array $items, array $columns = []): array
    {
        return [
            'head' => array_values($columns),
            'body' => $this->modifyRecords($items),
        ];
    }
}
