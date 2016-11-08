<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function view($id = null)
    {
        $user = $this->Users->get($id);

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        if($this->request->is(['patch','put','post']))
        {
            if(!empty($this->request->data['picture_url']['name']))
            {
                $this->request->data['picture_url'] = $this->Upload->uploadImg($this->request->data['picture_url'],[
                    'rename' => [
                        'id' => $this->Auth->User('id')
                    ]
                ]);
                $user = $this->Users->patchEntity($user,$this->request->data);
                if($this->Users->save($user))
                {
                    $this->Flash->success('Profil correctement édité.');
                    return $this->redirect($this->referer());
                }
                else {
                    $this->Flash->error('Edition impossible.');
                }
            }
        }
        $this->set(compact('user'));
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller' => 'Articles','action' => 'index']);
            }
            $this->Flash->error('Identifiant(s) invalide(s)');
        }
    }

    public function logout()
    {
        return $this->redirect(['action' => 'login']);
    }

    public function register()
    {
        $users = $this->Users->newEntity();
        if($this->request->is('post'))
        {
            debug($this->request->data);
            $users = $this->Users->patchEntity($users,$this->request->data);
            if($this->Users->save($users))
            {
                $this->Flash->success('Un mail vous a été envoyé.');
                return $this->redirect(['action' => 'login']);
            }
            else{
                $this->Flash->error('Impossible de créer votre compte');
            }
        }

        $this->set(compact('users'));
    }

    public function retrieve()
    {

    }

    public function beforeFilter(Event $event)
    {
        return parent::beforeFilter($event);
        $this->Auth->allow(['login','logout','register','retrieve']);
    }

}
