<?php


namespace widget;


use Widget;

class DataGrid extends Widget
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $columns;

    /**
     * @var array
     */
    private $actions;

    public function __construct(array $config)
    {
        $this->data = is_array($config['data']) ? $config['data'] : [];
        $this->columns = is_array($config['columns']) ? $config['columns'] : [];
        $this->actions = is_array($config['actions']) ? $config['actions'] : [];
    }

    public function render()
    {
        echo '<table class="table">';

        echo '<thead>';
        $this->renderHeaderRow();
        echo '</thead>';

        echo '<tbody>';
        foreach ($this->data as $itemData) {
            $this->renderBodyRow($itemData);
        }
        echo '</tbody>';

        echo '</table>';
    }

    private function renderHeaderRow()
    {
        echo '<tr>';

        foreach ($this->columns as $key => $column) {
            echo '<th>', htmlspecialchars($column['label']), '</th>';
        }

        if (!empty($this->actions)) {
            echo '<th>', '</th>';
        }

        echo '<tr>';
    }

    private function renderBodyRow(array $data)
    {
        echo '<tr>';

        foreach ($this->columns as $key => $column) {
            $value = $data[$key];

            if (array_key_exists('value', $column)) {
                if (is_callable($column['value'])) {
                    $value = $column['value']($data);
                } else {
                    $value = $column['value'];
                }
            }

            echo '<td>', htmlspecialchars($value), '</td>';
        }

        if (!empty($this->actions)) {
            echo '<td>';

            foreach ($this->actions as $action) {
                $hiddenCallback = isset($action['hiddenCallback']) ? $action['hiddenCallback'] : function () {
                    return false;
                };

                if (!$hiddenCallback($data)) {
                    (new $action['class']($action, $data['id']))->render();
                }
            }

            echo '</td>';
        }

        echo '<tr>';
    }
}
