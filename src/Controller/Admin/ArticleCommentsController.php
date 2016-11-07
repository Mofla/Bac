<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ArticleComments Controller
 *
 * @property \App\Model\Table\ArticleCommentsTable $ArticleComments
 */
class ArticleCommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles', 'Comments']
        ];
        $articleComments = $this->paginate($this->ArticleComments);

        $this->set(compact('articleComments'));
        $this->set('_serialize', ['articleComments']);
    }

    /**
     * View method
     *
     * @param string|null $id Article Comment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $articleComment = $this->ArticleComments->get($id, [
            'contain' => ['Articles', 'Comments']
        ]);

        $this->set('articleComment', $articleComment);
        $this->set('_serialize', ['articleComment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $articleComment = $this->ArticleComments->newEntity();
        if ($this->request->is('post')) {
            $articleComment = $this->ArticleComments->patchEntity($articleComment, $this->request->data);
            if ($this->ArticleComments->save($articleComment)) {
                $this->Flash->success(__('The article comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article comment could not be saved. Please, try again.'));
            }
        }
        $articles = $this->ArticleComments->Articles->find('list', ['limit' => 200]);
        $comments = $this->ArticleComments->Comments->find('list', ['limit' => 200]);
        $this->set(compact('articleComment', 'articles', 'comments'));
        $this->set('_serialize', ['articleComment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Article Comment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $articleComment = $this->ArticleComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleComment = $this->ArticleComments->patchEntity($articleComment, $this->request->data);
            if ($this->ArticleComments->save($articleComment)) {
                $this->Flash->success(__('The article comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article comment could not be saved. Please, try again.'));
            }
        }
        $articles = $this->ArticleComments->Articles->find('list', ['limit' => 200]);
        $comments = $this->ArticleComments->Comments->find('list', ['limit' => 200]);
        $this->set(compact('articleComment', 'articles', 'comments'));
        $this->set('_serialize', ['articleComment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $articleComment = $this->ArticleComments->get($id);
        if ($this->ArticleComments->delete($articleComment)) {
            $this->Flash->success(__('The article comment has been deleted.'));
        } else {
            $this->Flash->error(__('The article comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
