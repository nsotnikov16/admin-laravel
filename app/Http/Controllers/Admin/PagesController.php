<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Page;
use Illuminate\Http\Request;
use Admin\Field\Domain\Dto\FieldDto;
use Admin\Shared\Domain\Dto\ResultDto;
use Admin\Dropdown\Domain\Dto\DropdownItemDto;
use Admin\Field\Domain\Dto\FieldCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
use App\Http\Controllers\Admin\AdminController;
use Admin\Dropdown\Domain\Dto\DropdownCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;

class PagesController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $fields = Page::getFields();
        $result = app('admin')->getRecords(Page::class, $fields);
        $count = $result->count();
        $total = $result->total();
        $addRoute = route('admin.pages.create');
        $templateLinkEdit = route('admin.pages.edit', ['page' => '#id#']);
        $templateLinkDelete = route('admin.pages.destroy', ['page' => '#id#']);

        $table = app('admin')->getPropTable($result->all(), $fields, $templateLinkEdit, $templateLinkDelete);

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

        app('admin')->title = 'Страницы';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink(route('admin.main')),
            (new BreadcrumbDto)->setName('Страницы'),
        ]);

        $filterFields = new FieldCollectionDto([
            (new FieldDto)->setType(FieldDto::TYPE_DROPDOWN)
                ->setLabel('Активность')
                ->setLine(true)
                ->setCollection((new DropdownCollectionDto([
                    (new DropdownItemDto)->setName('filter[active]')
                        ->setValue('1')
                        ->setLabel('Да')
                        ->setChecked($request->filter ? $request->filter['active'] == 1 : false),
                    (new DropdownItemDto)->setName('filter[active]')
                        ->setValue('0')
                        ->setLabel('Нет')
                        ->setChecked($request->filter ? $request->filter['active'] == 0 : false)
                ]))->setIsRadio(true))
        ]);

        $sortFields = new FieldCollectionDto([
            (new FieldDto)->setType(FieldDto::TYPE_DROPDOWN)
                ->setLabel('Поле')
                ->setLine(true)
                ->setCollection((new DropdownCollectionDto([
                    (new DropdownItemDto)->setName('sortBy')
                        ->setValue('id')
                        ->setLabel('Идентификатор (id)')
                        ->setChecked($request->sortBy === 'id'),
                    (new DropdownItemDto)->setName('sortBy')
                        ->setValue('url')
                        ->setLabel('URL')
                        ->setChecked($request->sortBy === 'url')
                ]))->setIsRadio(true)->setButtonText('Выберите поле')),
            (new FieldDto)->setType(FieldDto::TYPE_DROPDOWN)
                ->setLabel('Тип')
                ->setLine(true)
                ->setCollection((new DropdownCollectionDto([
                    (new DropdownItemDto)->setName('sortType')
                        ->setValue('asc')
                        ->setLabel('По возрастанию')
                        ->setChecked($request->sortType === 'asc'),
                    (new DropdownItemDto)->setName('sortType')
                        ->setValue('desc')
                        ->setLabel('По убыванию')
                        ->setChecked($request->sortType === 'desc')
                ]))->setIsRadio(true)->setButtonText('Выберите тип'))
        ]);

        return view('admin.rows.list', compact(
            'table',
            'count',
            'total',
            'dropdownSearch',
            'filterFields',
            'sortFields',
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
        app('admin')->title = 'Добавление страницы';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink(route('admin.main')),
            (new BreadcrumbDto)->setName('Страницы')->setLink(route('admin.pages.index')),
            (new BreadcrumbDto)->setName('Добавление')
        ]);

        $collection = Page::getFieldsForCreate();
        $action = route('admin.pages.store');
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
            'url' => 'required|unique:sa_pages|max:500',
            'title' => 'max:255',
            'h1' => 'max:100',
            'description' => 'max:255'
        ]);
        $model = Page::create($request->all());
        $model->save();

        $result = (new ResultDto())->setSuccess(true)->setRedirect(route('admin.pages.index'));
        return $this->respond($result);
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
        $model = Page::find($id);

        app('admin')->title = 'Редактирование страницы ' . $model->url;
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink(route('admin.main')),
            (new BreadcrumbDto)->setName('Страницы')->setLink(route('admin.pages.index')),
            (new BreadcrumbDto)->setName('Редактирование страницы')
        ]);

        $collection = $model->getFieldsWithValues();
        $action = route('admin.pages.update', ['page' => $id]);
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
            'url' => 'required|unique:sa_pages,url,' . $id . '|max:500',
            'title' => 'max:255',
            'h1' => 'max:100',
            'description' => 'max:255',
        ]);
        $model = Page::find($id);
        $model->update($request->all());
        $model->active = (bool) $request->active;
        $model->save();

        $result = (new ResultDto())->setSuccess(true);
        return $this->respond($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Page::find($id);
        $model->delete();
        $result = (new ResultDto())->setSuccess(true);
        return $this->respond($result);
    }
}
