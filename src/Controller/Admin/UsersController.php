<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($active = 1)
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $users = $this->paginate($this->Users->find()->where(['role_id !=' => 1,'is_active' => $active]));

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        $this->set('title','Administration : Utilisateurs');
    }

    public function listajax($state=null)
    {
        if($this->request->is('ajax'))
        {
            $this->paginate = [
                'contain' => ['Comments'],
                'limit' => 10
            ];
            ($this->request->query['state'] != null) ? $state = $this->request->query['state'] : $state = 1;
            $users = $this->paginate($this->Users->find()->where(['is_active' => $state]));

            $this->set(compact('users'));
            $this->set('_serialize', ['users']);
        }
        else{
            return $this->redirect($this->referer());
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Comments']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $this->set('title','Administration : Profil de '.$user->username);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$username = null)
    {
        $user = $this->Users->get($id);
        if($this->request->is(['patch','post','put']))
        {
            if($this->request->data['picture_url']['name'])
            {
                $image = $user->picture_url;
                if($image !== 'default.jpg')
                {
                    $this->Upload->deleteImg($image);
                }
                $this->request->data['picture_url'] = $this->Upload->uploadImg($this->request->data['picture_url'],[
                    'rename' => [
                        'id' => $this->Auth->User('id')
                    ]
                ]);
            }
            else {
                unset($this->request->data['picture_url']);
            }
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
        $this->set(compact('user'));
        $this->set('_serialize',['user']);
        $this->set('title','Administration : Editer le profil de '.$user->username);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Users->Loves->deleteAll(['user_id' => $id]);
        $this->Users->Comments->deleteAll(['user_id' => $id]);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function gestion()
    {

    }
}
