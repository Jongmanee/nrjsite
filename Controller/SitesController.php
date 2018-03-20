<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Sites Controller
 *
 * @property \App\Model\Table\SitesTable $Sites
 *
 * @method \App\Model\Entity\Site[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SitesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        session_start();
        if (empty($_SESSION['connect'])) {
            $_SESSION['connect'] = 'non';
        }
        if (($_SESSION['connect'] == 'non')) {
            $this->Flash->error(__('Vous devez vous connecter pour accéder au site'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }



        $sites = $this->paginate($this->Sites);

        $this->set(compact('sites'));
        if (isset($this->request->data['ajoutsite'])) {
            $nsite = $this->Sites->newEntity();
            $nsite = $this->Sites->patchEntity($nsite, $this->request->getData());
            if ($this->Sites->save($nsite)) {
                $this->Flash->success(__('La site a été ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Le site n'a pas été ajouté, réessayez"));
        }
        $this->set(compact('site'));
    }

    /**
     * View method
     *
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        session_start();
        if (empty($_SESSION['connect'])) {
            $_SESSION['connect'] = 'non';
        }
        if (($_SESSION['connect'] == 'non')) {
            $this->Flash->error(__('Vous devez vous connecter pour accéder au site'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        $site = $this->Sites->get($id, [
            'contain' => ['Records']
        ]);
        $this->set('site', $site);
        
        
        
        $sites = $this->paginate($this->Sites);
        $this->set(compact('sites'));

        $this->loadModel('Records');
        $records = $this->Records->find();
        $this->set('records', $records);

        $this->loadModel('Paths');
        $paths = $this->Paths->find();
        $this->set('paths', $paths);

        //fonction ajouter releve
        if (isset($this->request->data['ajoutreleve'])) {
            $record = $this->Records->newEntity();
            $record = $this->Records->patchEntity($record, $this->request->getData());
            if ($this->Records->save($record)) {
                $this->Flash->success(__('Le relevé a été ajouté.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Le relevé n'a pas été ajouté, réessayez."));
        }         //fin ajouter releve
        else {
            // fonction modification site
            if (isset($this->request->data['modifsite'])) {
                $msite = $this->Sites->patchEntity($site, $this->request->getData());
                if ($this->Sites->save($msite)) {
                    $this->Flash->success(__('Le site a été modifié.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__("Le site n'a pas été modifié, réessayez."));
            }
            //fin modif site
            else {
                // début ajout voie
                if (isset($this->request->data['ajoutvoie'])) {
                    $nvoie = $this->Paths->newEntity();
                    $nvoie = $this->Paths->patchEntity($nvoie, $this->request->getData());
                    if ($this->Paths->save($nvoie)) {
                        $this->Flash->success(__('La voie a été ajoutée.'));
                        return $this->redirect(['controller' => 'Paths', 'action' => 'index']);
                    }
                    $this->Flash->error(__("La voie n'a pas été ajoutée, réessayez."));       //fin ajouter voie
                }
            }
        }
        $this->set(compact('site'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $site = $this->Sites->get($id);
        if ($this->Sites->delete($site)) {
            $this->Flash->success(__('Le site a été supprimer.'));
        } else {
            $this->Flash->error(__("Le site n'a pas été supprimer, réessayer."));
        }

        return $this->redirect(['action' => 'index']);
    }

}
