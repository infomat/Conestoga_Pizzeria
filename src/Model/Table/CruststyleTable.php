<?php
namespace App\Model\Table;

use App\Model\Entity\Cruststyle;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cruststyle Model
 *
 */
class CruststyleTable extends Table
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

        $this->table('cruststyle');
        $this->displayField('name');
        $this->primaryKey('name');

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
            ->allowEmpty('name', 'create');

        $validator
            ->add('price', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('price');

        return $validator;
    }
}
