<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Page;
use Illuminate\Http\Request;
use Admin\Field\Domain\Dto\FieldDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
use App\Http\Controllers\Admin\AdminController;
use Admin\Field\Domain\Dto\FieldCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;

class PagesController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        app('admin')->title = 'Добавление страницы';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink(route('admin.main')),
            (new BreadcrumbDto)->setName('SEO')->setLink(route('admin.pages.index')),
            (new BreadcrumbDto)->setName(app('admin')->title)
        ]);

        $fields = [];
        foreach (Page::getColumns() as $key => $value) {
            if (in_array($key, ['id', 'created_at', 'updated_at'])) continue;
            $dto =  (new FieldDto())->setName($key)->setLabel($value)->setType(FieldDto::TYPE_TEXT);
            if ($key === 'active') $dto = $dto->setValue(1)->setChecked(true)->setType(FieldDto::TYPE_CHECKBOX);
            $fields[] = $dto;
        }

        $collection = new FieldCollectionDto($fields);
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
