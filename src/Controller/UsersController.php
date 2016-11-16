<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\I18n\Time;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['view','validate']);
        return parent::beforeFilter($event);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit']))
        {
            // can edit only own profile
            $userId = (int)$this->request->params['pass'][0];
            if ($userId === $user['id']) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id,['contain' => ['Comments','Roles','Comments.Articles']]);
        // load all comments from this user, to enable pagination
        $comments = $this->Users->Comments->find()->contain('Articles')->where(['Comments.user_id' => $id])->orderDesc('Comments.created');
        $this->paginate = [
            'limit' => 5
        ];
        $this->paginate($comments);

        $this->set(compact('user','comments'));
    }

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
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if($user)
            {
                if ($user['is_active']) {
                    $this->Auth->setUser($user);
                    return $this->redirect(['controller' => 'Articles','action' => 'index']);
                }
                else {
                    unset($user);
                    $this->Flash->error('Le compte non validé');
                }
            }
            else {
                $this->Flash->error('Identifiant(s) invalide(s)');
            }

        }
    }

    public function logout()
    {
        $now = Time::now();
        $id = $this->Auth->User('id');
        $user = $this->Users->get($id);
        $data['last_time'] = $now;
        $user = $this->Users->patchEntity($user,$data);
        $this->Users->save($user);
        $this->request->session()->destroy();
        return $this->redirect(['action' => 'login']);
    }

    public function register()
    {
        $users = $this->Users->newEntity();
        if($this->request->is('post'))
        {
            $users = $this->Users->patchEntity($users,$this->request->data);
            if($this->Users->save($users))
            {

                $email = new Email();
                $email->viewVars(['users' => $users])
                    ->template('welcome')
                    ->emailFormat('html')
                    ->to($users->email)
                    ->from('blogdemofla@gmail.com')
                    ->subject('Confirmation de votre inscription')
                    ->send();

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
        $validateForm = null;
        $user = $this->Users;
        if($this->request->is('post'))
        {
            $user = $this->Users->find()->where(['email' => $this->request->data['email']])->first();
            $password = retrievePassword();
            $data['password'] = $password;
            $user = $this->Users->patchEntity($user,$data);
            if($this->Users->save($user))
            {
                $validateForm = true;
                $email = new Email('default');
                $email->from(['administrateur@blogdemofla.fr'])
                    ->to($user->email)
                    ->subject('Récupération de votre mot de passe')
                    ->send('Bonjour, votre nouveau mot de passe est : '.$password);

            }
            else {
                $this->Flash->error('Impossible de retrouver votre mail.');
            }
        }

        $this->set(compact('user'));
        $this->set(compact('validateForm'));
        $this->set('_serialize',['user']);
    }

    public function validate($email=null)
    {
        $users = $this->Users->find()->where(['email' => $email])->first();
        if(!empty($users))
        {
            if(!$users->is_active)
            {
                $data['is_active'] = 1;
                $users = $this->Users->patchEntity($users,$data);
                if($this->Users->save($users))
                {
                    $this->Flash->success('Ce compte est maintenant actif.');

                }
                else {
                    $this->Flash->error('Ce compte ne peut pas être validé.');

                }
            }
            else {
                $this->Flash->error('Ce compte est déjà actif.');
            }
        }
    }


}
