<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paths Model
 *
 * @property \App\Model\Table\SitesTable|\Cake\ORM\Association\BelongsTo Sites
 * @property \App\Model\Table\SitesTable|\Cake\ORM\Association\BelongsTo $Sites
 *
 * @method \App\Model\Entity\Path get($primaryKey, $options = [])
 * @method \App\Model\Entity\Path newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Path[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Path|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Path patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Path[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Path findOrCreate($search, callable $callback = null, $options = [])
 */
class PathsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('paths');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sites', [
            'foreignKey' => 'starting_site_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Sites', [
            'foreignKey' => 'ending_site_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->numeric('max_capacity')
            ->requirePresence('max_capacity', 'create')
            ->notEmpty('max_capacity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['starting_site_id'], 'Sites'));
        $rules->add($rules->existsIn(['ending_site_id'], 'Sites'));

        return $rules;
    }
}
