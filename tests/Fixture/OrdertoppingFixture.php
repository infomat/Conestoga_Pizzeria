<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdertoppingFixture
 *
 */
class OrdertoppingFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'ordertopping';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ordertopping_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'topping' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'order_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'topping_key' => ['type' => 'index', 'columns' => ['topping'], 'length' => []],
            'orderinfo_key' => ['type' => 'index', 'columns' => ['order_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ordertopping_id'], 'length' => []],
            'orderinfo_key' => ['type' => 'foreign', 'columns' => ['order_id'], 'references' => ['orders', 'order_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'topping_key' => ['type' => 'foreign', 'columns' => ['topping'], 'references' => ['topping', 'name'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'ordertopping_id' => 1,
            'topping' => 'Lorem ipsum dolor sit amet',
            'order_id' => 1
        ],
    ];
}
