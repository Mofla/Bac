<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['add','view','edit','user']);
        return parent::beforeFilter($event);
    }



    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $comments = $this->paginate($this->Comments);

        $this->set(compact('comments'));
        $this->set('_serialize', ['comments']);
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->paginate = [
            'contain' => ['Users','Likes'],
            'limit' => 2
        ];
        ($this->request->query['id'] != null) ? $id = $this->request->query['id'] : '';
        $comments = $this->paginate($this->Comments->find()->where(['article_id' => $id])->orderDesc('Comments.created'));

        $this->set('comments', $comments);
        $this->set('_serialize', ['comments']);
    }

    public function user($id=null)
    {
        if($this->request->is('ajax'))
        {
            $this->paginate = [
                'limit' => 5
            ];
            ($this->request->query['id'] != null) ? $id = $this->request->query['id'] : '';
            $comments = $this->paginate($this->Comments->find()->contain(['Articles','Likes'])->where(['Comments.user_id' => $id])->orderDesc('Comments.created'));

            $this->set(compact('comments'));
            $this->set('_serialize', ['comments']);
        }
        else{
            return $this->redirect($this->referer());
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            }
        }
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'users'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        (isset($this->request->query['id'])) ? $id = $this->request->query['id'] : '';
        $comment = $this->Comments->get($id);
        if ($this->request->is('ajax')) {
            $users = $this->Comments->Users->find('list', ['limit' => 200]);
            $this->set(compact('comment', 'users'));
            $this->set('_serialize', ['comment']);
        }
        elseif ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success('Commentaire bien édité.');

            } else {
                $this->Flash->error('Le commentaire n\'a pas été édité.');
            }
            return $this->redirect($this->referer());
        }
        else {
            return $this->redirect($this->referer());
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
