<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ToppingFixture
 *
 */
class ToppingFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'topping';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'category' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'category_key' => ['type' => 'index', 'columns' => ['category'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['name'], 'length' => []],
            'category_key' => ['type' => 'foreign', 'columns' => ['category'], 'references' => ['category', 'name'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'name' => '088b1c59-7665-4583-a1e2-983144f2924c',
            'category' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
