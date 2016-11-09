<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Tags cell
 */
class TagsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $table = $this->loadModel('Tags');
        $tags = $table->find();
        $this->set(compact('tags'));

    }
}
