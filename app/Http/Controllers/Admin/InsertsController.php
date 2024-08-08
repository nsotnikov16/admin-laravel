<?php

namespace App\Http\Controllers\Admin;

use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
use App\Http\Controllers\Controller;
use Admin\Form\Domain\Dto\RowDtoCollection;
use Admin\Form\Domain\Dto\RowDto;
use App\Services\AdminService;
use Illuminate\Http\Request;

class InsertsController extends Controller
{
    public function index()
    {
        $inserts = app('admin')->getInserts();

        app('admin')->title = 'Вставки';

        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto())->setName('Главная')->setLink('/'),
            (new BreadcrumbDto())->setName('Вставки'),
        ]);

        $items = [];

        foreach ($inserts as $insert) {
            $items[] = (new RowDto())->setType(RowDto::TYPE_TEXTAREA)->setName($insert->code)->setLabel($insert->name)->setTextareaRows(20)->setValue($insert->content);
        }

        $collection = new RowDtoCollection($items);
        return view('admin.inserts', compact('collection'));
    }

    public function save(Request $request)
    {
        $inserts = app('admin')->getInserts();
        foreach ($inserts as $insert) {
            $insert->content = $request[$insert->code];
            $insert->save();
        }
        return response()->json('asfasf');
    }
}
