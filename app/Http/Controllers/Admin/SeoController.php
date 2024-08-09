<?php

namespace App\Http\Controllers\Admin;

use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;
use Admin\Breadcrumbs\Domain\Dto\BreadcrumbDto;
use Admin\Query\Domain\Dto\QueryDto;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Admin\Seo;
use Illuminate\Support\Facades\DB;

class SeoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        app('admin')->title = 'SEO';
        app('admin')->breadcrumbs = new BreadcrumbCollectionDto([
            (new BreadcrumbDto)->setName('Главная')->setLink('/'),
            (new BreadcrumbDto)->setName('SEO'),
        ]);

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
            ->setColumns(array_keys($columns));

        if ($request->sortBy && $request->sortType) {
            $query = $query->setSortBy($request->sortBy)->setSortType($request->sortType);
        }

        if ($request->filter) {
            dump($request->filter);
            $query = $query->setFilter($request->filter);
        }

        $result = app('admin')->getRecords($query);
        $count = $result->count();
        $total = $result->total();
        $table = app('admin')->getPropTable($result->all(), $columns);

        return view('admin.rows.list', compact('table', 'count', 'total'));
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
