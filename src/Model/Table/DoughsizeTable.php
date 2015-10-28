<?php
namespace App\Model\Table;

use App\Model\Entity\Doughsize;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Doughsize Model
 *
 */
class DoughsizeTable extends Table
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

        $this->table('doughsize');
        $this->displayField('size');
        $this->primaryKey('size');

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
            ->add('price', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('price');

        $validator
            ->allowEmpty('size', 'create');

        return $validator;
    }
}
