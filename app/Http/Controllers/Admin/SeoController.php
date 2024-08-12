<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Seo;
use Illuminate\Http\Request;
use Admin\Query\Domain\Dto\QueryDto;
use Admin\Shared\Domain\Dto\ResultDto;
use Admin\Dropdown\Domain\Dto\DropdownItemDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
use App\Http\Controllers\Admin\AdminController;
use Admin\Form\Domain\Dto\FormFieldCollectionDto;
use Admin\Dropdown\Domain\Dto\DropdownCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;
use Admin\Form\Domain\Dto\FormFieldDto;

class SeoController extends AdminController
{
    protected $columns = [];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $columns = Seo::getColumns();

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
        $addRoute = route('admin.seo.create');
        $templateLinkEdit = route('admin.seo.edit', ['seo' => '#id#']);
        $templateLinkDelete = route('admin.seo.destroy', ['seo' => '#id#']);

        $table = app('admin')->getPropTable($result->all(), $columns, $templateLinkEdit, $templateLinkDelete);

        if ($request->ajax()) {
            $result = (new ResultDto)->setSuccess(true)
                ->setData([
                    'html' => view('admin.rows.bottom', compact(
                        'table',
                        'count',
                        'total',
                        'templateLinkEdit',
                        'templateLinkDelete',
                    ))->render()
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

        return view('admin.rows.list', compact(
            'table',
            'count',
            'total',
            'dropdownSearch',
            'filterColumns',
            'addRoute',
            'templateLinkEdit',
            'templateLinkDelete',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        app('admin')->title = 'Добавление SEO для страницы';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink(route('admin.main')),
            (new BreadcrumbDto)->setName('SEO')->setLink(route('admin.seo.index')),
            (new BreadcrumbDto)->setName(app('admin')->title)
        ]);

        $fields = [];
        foreach (Seo::getColumns() as $key => $value) {
            if (in_array($key, ['id', 'created_at', 'updated_at'])) continue;
            $dto =  (new FormFieldDto())->setName($key)->setLabel($value)->setType(FormFieldDto::TYPE_TEXT);
            if ($key === 'active') $dto = $dto->setValue(1)->setChecked(true)->setType(FormFieldDto::TYPE_CHECKBOX);
            $fields[] = $dto;
        }

        $collection = new FormFieldCollectionDto($fields);
        $action = route('admin.seo.store');
        $method = 'POST';
        $btnText = 'Добавить';
        return view('admin.rows.detail', compact('collection', 'action', 'btnText', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|unique:sa_seo|max:500',
            'title' => 'max:255',
            'h1' => 'max:100',
            'description' => 'max:255',
        ]);
        $model = Seo::create($request->all());
        $model->save();

        $result = (new ResultDto())->setSuccess(true);
        return $this->respond($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        app('admin')->title = 'Редактирование SEO для страницы';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink(route('admin.main')),
            (new BreadcrumbDto)->setName('SEO')->setLink(route('admin.seo.index')),
            (new BreadcrumbDto)->setName(app('admin')->title)
        ]);

        $model = Seo::find($id);

        $fields = [];
        foreach (Seo::getColumns() as $key => $value) {
            if (in_array($key, ['id', 'created_at', 'updated_at'])) continue;
            $dto =  (new FormFieldDto())->setName($key)->setLabel($value)->setType(FormFieldDto::TYPE_TEXT)->setValue($model[$key]);
            if ($key === 'active') $dto = $dto->setValue($model[$key])->setChecked(true)->setType(FormFieldDto::TYPE_CHECKBOX);
            $fields[] = $dto;
        }

        $collection = new FormFieldCollectionDto($fields);
        $action = route('admin.seo.update', ['seo' => $id]);
        $method = 'PUT';
        $btnText = 'Изменить';
        return view('admin.rows.detail', compact('collection', 'action', 'btnText', 'method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'url' => 'required|unique:sa_seo,url,' . $id . '|max:500',
            'title' => 'max:255',
            'h1' => 'max:100',
            'description' => 'max:255',
        ]);
        $model = Seo::find($id);
        $model->update($request->all());
        $model->save();

        $result = (new ResultDto())->setSuccess(true);
        return $this->respond($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Seo::find($id);
        $model->delete();
        $result = (new ResultDto())->setSuccess(true);
        return $this->respond($result);
    }
}
