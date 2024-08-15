<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Admin\Form\Domain\Dto\FormFieldDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
use App\Http\Controllers\Admin\AdminController;
use Admin\Form\Domain\Dto\FormFieldCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;
use Admin\Shared\Domain\Dto\ResultDto;
use Illuminate\Http\JsonResponse;

class InsertsController extends AdminController
{
    public function index()
    {
        $inserts = app('admin')->getInserts();

        app('admin')->title = 'Вставки';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto())->setName('Главная')->setLink(route('admin.main')),
            (new BreadcrumbDto())->setName('Вставки'),
        ]);

        $items = [];

        foreach ($inserts as $insert) {
            $items[] = (new FormFieldDto())
                ->setType(FormFieldDto::TYPE_TEXTAREA)
                ->setName($insert->code)
                ->setLabel($insert->name)
                ->setTextareaRows(20)
                ->setValue($insert->content);
        }

        $collection = new FormFieldCollectionDto($items);
        return view('admin.inserts', compact('collection'));
    }

    public function save(Request $request): JsonResponse
    {
        $inserts = app('admin')->getInserts();
        foreach ($inserts as $insert) {
            $insert->content = $request[$insert->code];
            $insert->save();
        }

        $result = (new ResultDto())->setSuccess(true);
        return $this->respond($result);
    }
}
