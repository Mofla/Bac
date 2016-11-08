<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Nav cell
 */
class NavCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    public $components = ['Auth'];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $is_connected = false;
        $is_admin = false;
        ($this->request->session()->read('Auth.User.id') === 1) ? $is_connected = true : '';
        ($this->request->session()->read('Auth.User.role_id') === 1) ? $is_admin = true : '';
        ($is_connected) ? $user_id = $this->request->session()->read('Auth.User.id') : '';
        $this->set(compact(['is_connected','is_admin','user_id']));
    }
}
