<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity.
 *
 * @property int $order_id
 * @property \App\Model\Entity\Order $order
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $size
 * @property string $cruststyle
 * @property int $quantity
 * @property int $subtotal
 * @property int $tax
 * @property int $total
 * @property \Cake\I18n\Time $orderdate
 * @property \Cake\I18n\Time $modified
 * @property bool $iscompleted
 */
class Order extends Entity
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
        'order_id' => false,
    ];
}
