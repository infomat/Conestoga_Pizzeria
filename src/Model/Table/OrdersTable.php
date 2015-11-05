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

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'orderdate' => 'new',
                    'modified' => 'always',
                ],
                'Orders.completed' => [
                    'modified' => 'always'
                ]
            ]
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        
        $this->hasMany('Doughsize', [
            'foreignKey' => 'size',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('Cruststyle', [
            'foreignKey' => 'name',
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
            ->requirePresence('crustname', 'create')
            ->notEmpty('crustname');

        $validator
            ->add('quantity', 'valid', ['rule' => 'numeric'])
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->add('subtotal', 'valid', ['rule' => 'numeric'])
            ->notEmpty('subtotal');

        $validator
            ->add('tax', 'valid', ['rule' => 'numeric'])
            ->notEmpty('tax');

        $validator
            ->add('total', 'valid', ['rule' => 'numeric'])
            ->notEmpty('total');

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
        $rules->add($rules->existsIn(['size'], 'Doughsize'));
        $rules->add($rules->existsIn(['crustname'], 'Cruststyle'));
        return $rules;
    }
    
    public function isOwnedBy($orderId, $userId)
    {
        return $this->exists(['order_id' => $orderId, 'user_id' => $userId]);
    }
}
