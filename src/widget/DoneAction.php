<?php


namespace widget;


use helper\CsrfHelper;
use Widget;

class DoneAction extends Widget
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
        $url = $this->config['url'];

        echo '<form class="d-inline-block mr-1 ml-1" action="' . $url . '" method="post">';
        CsrfHelper::createFormField();
        echo '<input type="hidden" name="id" value="'. $this->itemId .'">';
        echo '<button class="btn btn-primary" type="submit">Done</button>';
        echo '</form>';
    }
}
