<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__("Enregistrement réussie, vous pouvez vous connecter"));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__("L'enregistrement a échoué, réessayez"));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        session_start();
        $users = $this->paginate($this->Users);
        if ($this->request->is('post')) {
            
            if (isset($this->request->data['connect'])) {
                $userdemande= $this->request->getData('login');
                $passwddemande=$this->request->getData('passwd');
                $passwddemande=md5($passwddemande);
                foreach ($users as $user):
                    if (($userdemande==$user->login) && ($passwddemande==$user->passwd)) {
                        $_SESSION['connect']='oui';
                    }
                endforeach;
                if ($_SESSION['connect']=='oui') {
                    $this->Flash->success(__('Connexion réussie, bienvenue !'));
                    return $this->redirect(['controller'=>'Sites','action' => 'index']);
                }
                else
                {
                     return $this->Flash->error(__('Identifiants erronés'));
                }
            }
        }
        
    }
    
    public function deco() {
        session_start();
        $_SESSION['connect']='non';
        $this->Flash->success(__('Vous avez été déconnecté !'));
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    
}
