<?

namespace Admin\Query\Domain\Dto;

use Admin\Shared\Domain\Dto\Dto;

class QueryDto extends Dto
{
    public string $table = '';
    public string $modelClass = '';
    public string $sortBy = 'id';
    public string $sortType = 'asc';
    public array $filter = [];
    public string $searchText = '';
    public string $searchColumn = 'name';
    public int $limit = 100;
    public int $page = 1;
    public bool $logicAnd = true;
    public array $columns = ['*'];

    public function setTable(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function setModelClass(string $modelClass): self
    {
        $this->modelClass = $modelClass;
        return $this;
    }

    public function setSortBy(string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    public function setSortType(string $sortType): self
    {
        $this->sortType = $sortType;
        return $this;
    }

    public function setFilter(array $filter): self
    {
        $this->filter = $filter;
        return $this;
    }

    public function setLimit(string $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function setPage(string $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function setLogicAnd(bool $logicAnd): self
    {
        $this->logicAnd = $logicAnd;
        return $this;
    }

    public function setColumns(array $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    public function setSearchText(string $searchText): self
    {
        $this->searchText = $searchText;
        return $this;
    }

    public function setSearchColumn(string $searchColumn): self
    {
        $this->searchColumn = $searchColumn;
        return $this;
    }
}
