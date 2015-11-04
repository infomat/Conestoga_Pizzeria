<?php
namespace App\Model\Table;

use App\Model\Entity\Province;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Province Model
 *
 */
class ProvinceTable extends Table
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

        $this->table('province');
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
            ->add('tax_percent', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('tax_percent');

        return $validator;
    }
}
