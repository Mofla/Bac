<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PermissionsComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\PermissionsComponent Test Case
 */
class PermissionsComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\PermissionsComponent
     */
    public $Permissions;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Permissions = new PermissionsComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Permissions);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
