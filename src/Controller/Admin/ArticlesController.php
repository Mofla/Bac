<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($state = 1)
    {
        $this->paginate = [
            'contain' => ['Tags']
        ];
        $articles = $this->paginate($this->Articles->find()->where(['state' => $state]));
        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
        $this->set('title','Administration : Articles');
    }

    public function listajax($state=null)
    {
        if($this->request->is('ajax'))
        {
            $this->paginate = [
                'contain' => ['Tags','Comments'],
                'limit' => 10
            ];
            ($this->request->query['state'] != null) ? $state = $this->request->query['state'] : $state = 1;
            $articles = $this->paginate($this->Articles->find()->where(['state' => $state]));

            $this->set(compact('articles'));
            $this->set('_serialize', ['articles']);
        }
        else{
            return $this->redirect($this->referer());
        }
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags', 'Comments','Comments.Users','Users']
        ]);
        $this->paginate = [
            'limit' => 8
        ];
        $comments = $this->paginate($this->Articles->Comments->find()->contain(['Users','Loves'])->where(['article_id' => $id])->orderDesc('Comments.created'));
        $comment = $this->Articles->Comments->newEntity();
        if($this->request->is('post'))
        {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['article_id'] = $id;
            $comment = $this->Articles->Comments->patchEntity($comment,$this->request->data);
            if($this->Articles->Comments->save($comment))
            {
                $this->Flash->success('Votre commentaire a bien été posté');
                return $this->redirect($this->referer());
            }
            else {
                $this->Flash->error('Impossible de valider votre commentaire');
            }
        }

        $this->set('article', $article);
        $this->set(compact('comment','comments','canLike'));
        $this->set('_serialize', ['article','comment','comments']);
        $this->set('title','Administration : Article '.$article->name);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->User('id');
            if($this->request->data['picture_url']['name'])
            {
                $this->request->data['picture_url'] = $this->Upload->uploadImg($this->request->data['picture_url'],[
                    'rename' => [
                        'id' => $this->Auth->User('id')
                    ],
                    'resize' => [
                        'small' => 100,
                        'medium' => 320
                    ],
                    'directory' => 'articles'
                ]);
            }
            else {
                unset($this->request->data['picture_url']);
            }
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'tags'));
        $this->set('_serialize', ['article']);
        $this->set('title','Administration : Ajouter un nouvel article');
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->data['picture_url']['name'])
            {
                $image = $article->picture_url;
                if($image !== 'default.jpg')
                {
                    $this->Upload->deleteImg($image,['sizes' => [100,320],'directory' => 'articles']);
                }
                $this->request->data['picture_url'] = $this->Upload->uploadImg($this->request->data['picture_url'],[
                    'rename' => [
                        'id' => $this->Auth->User('id')
                    ],
                    'resize' => [
                        'small' => 100,
                        'medium' => 320
                    ],
                    'directory' => 'articles'
                ]);
            }
            else {
                unset($this->request->data['picture_url']);
            }
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'tags'));
        $this->set('_serialize', ['article']);
        $this->set('title','Administration : Edition de l\'article '.$article->name);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        // First : we need to suppress all comments bound to this article
        // & all likes bound to all these comments
        // Here : suppress all likes
        $comments = $this->Articles->Comments->find()->where(['article_id' => $id]);
        foreach ($comments as $comment)
        {
            $likes[] = $comment->id;
        }
        // condition IN
        if(!empty($likes)) {
            $this->Articles->Comments->Loves->deleteAll(['comment_id IN' => $likes]);
        }
        // Then we delete all comments
        $this->Articles->Comments->deleteAll(['article_id' => $id]);

        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function publish($id = null)
    {
        $this->request->allowMethod('post');
        $article = $this->Articles->get($id);
        switch ($article->state)
        {
            case 0:
                $data['state'] = 1;
                break;
            case 1:
                $data['state'] = 0;
                break;
            case 2:
                $data['state'] = 1;
        }
        $article = $this->Articles->patchEntity($article,$data);
        if($this->Articles->save($article))
        {
            $this->Flash->success('Changement effectué');
        }
        else
        {
            $this->Flash->error('Changement non effectué');
        }

        return $this->redirect(['action' => 'index']);

    }

    public function retire($id = null)
    {
        $this->request->allowMethod('post');
        $article = $this->Articles->get($id);
        $data['state'] = 2;
        $article = $this->Articles->patchEntity($article,$data);
        if($this->Articles->save($article))
        {
            $this->Flash->success('Changement effectué');
        }
        else
        {
            $this->Flash->error('Changement non effectué');
        }

        return $this->redirect(['action' => 'index']);
    }
}
