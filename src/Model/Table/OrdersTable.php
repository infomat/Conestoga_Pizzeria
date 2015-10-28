<?php
namespace App\Model\Table;

use App\Model\Entity\Order;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Orders
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class OrdersTable extends Table
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

        $this->table('orders');
        $this->displayField('order_id');
        $this->primaryKey('order_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('size', 'create')
            ->notEmpty('size');

        $validator
            ->requirePresence('cruststyle', 'create')
            ->notEmpty('cruststyle');

        $validator
            ->add('quantity', 'valid', ['rule' => 'numeric'])
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->add('subtotal', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('subtotal');

        $validator
            ->add('tax', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('tax');

        $validator
            ->add('total', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('total');

        $validator
            ->add('orderdate', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('orderdate');

        $validator
            ->add('iscompleted', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('iscompleted');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
