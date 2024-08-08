<?php
namespace App\Services;

use Admin\Breadcrumbs\Domain\Dto\BreadcrumbCollectionDto;
use App\Models\Admin\Entity;
use App\Models\Admin\Insert;

class AdminService {
    public string $title = '';
    public $breadcrumbs;

    public function getEntities() {
        return Entity::all()->toArray();
    }

    public function getInserts() {
        return Insert::all();
    }
}
