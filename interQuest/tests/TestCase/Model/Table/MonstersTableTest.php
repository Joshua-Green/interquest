<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MonstersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MonstersTable Test Case
 */
class MonstersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MonstersTable
     */
    public $Monsters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.monsters',
        'app.npcs',
        'app.personas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Monsters') ? [] : ['className' => 'App\Model\Table\MonstersTable'];
        $this->Monsters = TableRegistry::get('Monsters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Monsters);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}