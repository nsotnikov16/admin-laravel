<?php

namespace App\Http\Controllers\Admin;

use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
use Admin\Dropdown\Domain\Dto\DropdownItemDto;
use Admin\Dropdown\Domain\Dto\DropdownCollectionDto;
use Admin\Query\Domain\Dto\QueryDto;
use Admin\Shared\Domain\Dto\ResultDto;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Admin\Seo;

class SeoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $columns = [
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

        $query =  (new QueryDto)
            ->setModelClass(Seo::class)
            ->setColumns(array_keys($columns))
            ->setLogicAnd(false);

        if ($request->sortBy && $request->sortType) {
            $query = $query->setSortBy($request->sortBy)->setSortType($request->sortType);
        }

        if ($request->search && $request->column) $query = $query->setSearchColumn($request->column)->setSearchText($request->search);

        if ($request->filter) $query = $query->setFilter($request->filter);

        $result = app('admin')->getRecords($query);
        $count = $result->count();
        $total = $result->total();

        if ($request->ajax()) {
            $result = (new ResultDto)->setSuccess(true)
                ->setData([
                    'data' => app('admin')->modifyRecords($result->all()),
                    'head' => array_values($columns),
                    'count' => $count,
                    'total' => $total
                ]);
            return $this->respond($result);
        }

        $searchColumns = [
            'url' => 'URL',
            'title' => 'title',
            'h1' => 'h1',
            'description' => 'description'
        ];

        $dropdownCollection = [];

        foreach ($searchColumns as $value => $label) {
            $dropdownCollection[] = (new DropdownItemDto)->setName('column')
                ->setValue($value)
                ->setLabel($label)
                ->setChecked($request->column === $value || key($searchColumns) === $value);
        }
        $dropdownSearch = (new DropdownCollectionDto($dropdownCollection))->setIsRadio(true);

        app('admin')->title = 'SEO';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink('/'),
            (new BreadcrumbDto)->setName('SEO'),
        ]);

        $filterColumns = [
            'active' => 'Активность',
            'entity_id' => 'Привязка',
        ];

        $table = app('admin')->getPropTable($result->all(), $columns);
        return view('admin.rows.list', compact('table', 'count', 'total', 'dropdownSearch', 'filterColumns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
