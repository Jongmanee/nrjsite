<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Paths Controller
 *
 * @property \App\Model\Table\PathsTable $Paths
 *
 * @method \App\Model\Entity\Path[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PathsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sites', 'Sites']
        ];
        $paths = $this->paginate($this->Paths);

        $this->set(compact('paths'));
    }

    /**
     * View method
     *
     * @param string|null $id Path id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $path = $this->Paths->get($id, [
            'contain' => ['Sites', 'Sites']
        ]);

        $this->set('path', $path);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $path = $this->Paths->newEntity();
        if ($this->request->is('post')) {
            $path = $this->Paths->patchEntity($path, $this->request->getData());
            if ($this->Paths->save($path)) {
                $this->Flash->success(__('The path has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The path could not be saved. Please, try again.'));
        }
        $startingSites = $this->Paths->StartingSites->find('list', ['limit' => 200]);
        $endingSites = $this->Paths->Sites->find('list', ['limit' => 200]);
        $this->set(compact('path', 'startingSites', 'endingSites'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Path id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $path = $this->Paths->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $path = $this->Paths->patchEntity($path, $this->request->getData());
            if ($this->Paths->save($path)) {
                $this->Flash->success(__('The path has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The path could not be saved. Please, try again.'));
        }
        $startingSites = $this->Paths->StartingSites->find('list', ['limit' => 200]);
        $endingSites = $this->Paths->Sites->find('list', ['limit' => 200]);
        $this->set(compact('path', 'startingSites', 'endingSites'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Path id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $path = $this->Paths->get($id);
        if ($this->Paths->delete($path)) {
            $this->Flash->success(__('The path has been deleted.'));
        } else {
            $this->Flash->error(__('The path could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
