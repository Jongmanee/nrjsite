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
        session_start();
        if (empty($_SESSION['connect'])) {
            $_SESSION['connect'] = 'non';
        }
        if (($_SESSION['connect']=='non')) {
                        $this->Flash->error(__('Vous devez vous connecter pour accéder au site'));
                        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        $this->paginate = [
            'contain' => ['Sites', 'Sites']
        ];
        $paths = $this->paginate($this->Paths);
        
        $this->loadModel('Sites');
        $sites = $this->Sites->find();
        $this->set('sites',$sites);
        
        $this->loadModel('Records');
        $records = $this->Records->find();
        $this->set('records',$records);
        
        $this->set(compact('paths'));
    }

}
