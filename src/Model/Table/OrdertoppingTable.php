<?php
namespace App\Model\Table;

use App\Model\Entity\Ordertopping;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ordertopping Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ordertoppings
 * @property \Cake\ORM\Association\BelongsTo $Orders
 */
class OrdertoppingTable extends Table
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

        $this->table('ordertopping');
        $this->displayField('ordertopping_id');
        $this->primaryKey('ordertopping_id');

        $this->belongsTo('Ordertoppings', [
            'foreignKey' => 'ordertopping_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id'
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
            ->allowEmpty('topping');

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
        $rules->add($rules->existsIn(['ordertopping_id'], 'Ordertoppings'));
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        return $rules;
    }
}
