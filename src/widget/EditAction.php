<?php


namespace widget;


use Widget;

class EditAction extends Widget
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var integer
     */
    private $itemId;

    public function __construct(array $config, int $itemId)
    {
        $this->config = $config;
        $this->itemId = $itemId;
    }

    public function render()
    {
        $url = $this->config['url'] . '?id=' . $this->itemId;

        echo '<a class="btn btn-primary mr-1 ml-1" href="', $url,'">Edit</a>';
    }
}
