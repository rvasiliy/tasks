<?php


namespace widget;


use Kilte\Pagination\Pagination;
use Widget;

class Pager extends Widget
{
    /**
     * @var Pagination
     */
    private $pagination;


    public function __construct(Pagination $pagination)
    {
        $this->pagination = $pagination;
    }

    public function render()
    {
        $items = $this->pagination->build();

        echo '<ul class="pagination justify-content-center">';

        foreach ($items as $position => $item) {
            echo '<li class="page-item'. ($item === 'current' ? ' active' : '')  .'">';
            echo '<a class="page-link" href="' . $this->getQueryString($position) . '">' . $position . '</a>';
            echo '</li>';
        }

        echo '</ul>';
    }

    private function getQueryString(int $position):string
    {
        $params = $_GET;
        unset($params['page']);

        if (1 < $position) {
            $params = array_merge(
                $params,
                ['page' => $position]
            );
        }

        $queryString = http_build_query($params);

        if ($queryString) {
            $queryString = '?' . $queryString;
        }

        return $queryString;
    }
}
