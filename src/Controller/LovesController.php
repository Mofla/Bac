<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Loves Controller
 *
 * @property \App\Model\Table\LovesTable $Loves
 */
class LovesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['thumb']);
        return parent::beforeFilter($event);
    }

    public function thumb($id = null,$state = null)
    {
        $like = $this->Loves->newEntity();
        $check = $this->Loves->find()->where([
            'comment_id' => $id,
            'user_id' => $this->Auth->User('id')
        ])->count();
        if($check == 0)
        {
            $data = [
                'comment_id' => $id,
                'user_id' => $this->Auth->User('id'),
                'state' => $state
            ];
            $like = $this->Loves->patchEntity($like,$data);
            $this->Loves->save($like);
        }
        return $this->redirect($this->referer());

    }
}
