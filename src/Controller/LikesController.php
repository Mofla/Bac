<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Likes Controller
 *
 * @property \App\Model\Table\LikesTable $Likes
 */
class LikesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['thumb']);
        return parent::beforeFilter($event);
    }

    public function thumb($id = null,$state = null)
    {
        $like = $this->Likes->newEntity();
        $check = $this->Likes->find()->where([
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
            $like = $this->Likes->patchEntity($like,$data);
            $this->Likes->save($like);
        }
        return $this->redirect($this->referer());

    }
}
