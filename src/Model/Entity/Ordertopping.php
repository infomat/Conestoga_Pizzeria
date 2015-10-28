<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ordertopping Entity.
 *
 * @property int $ordertopping_id
 * @property \App\Model\Entity\Ordertopping $ordertopping
 * @property string $topping
 * @property int $order_id
 * @property \App\Model\Entity\Orderinfo $orderinfo
 */
class Ordertopping extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'ordertopping_id' => false,
    ];
}
