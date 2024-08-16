<?php

namespace App\Services;

use App\Models\Admin\Entity;
use App\Models\Admin\Insert;
use Illuminate\Support\Facades\DB;
use Admin\Query\Domain\Dto\QueryDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
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
        if (!empty($dto->filter)) {
            foreach ($dto->filter as $key => $value) {
                if (!is_array($value)) $value = [$value];
                $query = $dto->logicAnd ? $query->whereIn($key, $value) : $query->orWhereIn($key, $value);
            }
        }

        if ($dto->searchText !== '') $query = $query->where($dto->searchColumn, 'like', '%' . $dto->searchText . '%');
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

    public function getPropTable(array $items, array $columns = [], string $templateLinkEdit, string $templateLinkDelete): array
    {
        return [
            'head' => array_map(fn($item) => $item['name'], $columns),
            'body' => $this->modifyRecords($items, function ($record) use ($templateLinkEdit, $templateLinkDelete) {
                $record['editLink'] = str_replace('#id#', $record['id'], $templateLinkEdit);
                $record['deleteLink'] = str_replace('#id#', $record['id'], $templateLinkDelete);
                return $record;
            }),
        ];
    }
}
