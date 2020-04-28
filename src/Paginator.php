<?php


class Paginator
{
    private $page = 1;
    private $perPage = 3;
    private $total = 1;


    public function __construct(int $page = 1, int $perPage = 3, int $total = 1)
    {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->total = $total;
    }

    public function getPage(): int
    {
        $page =  $this->page;
        $pages = $this->getPages();

        if ($page < 1) {
            $page = 1;
        }

        if ($pages < $page) {
            $page = $pages;
        }

        return $page;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getPages()
    {
        return ceil($this->total / $this->perPage);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getOffset()
    {
        return ($this->getPage() - 1) * $this->perPage;
    }
}
