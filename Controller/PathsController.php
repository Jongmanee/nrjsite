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
        $this->loadModel('Sites');

        $sites = $this->Sites->find();
        $this->set('sites',$sites);
        $this->set(compact('paths'));
    }

}
