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
                    return $this->redirect(['controller'=>'Pages','action' => 'accueil']);
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
