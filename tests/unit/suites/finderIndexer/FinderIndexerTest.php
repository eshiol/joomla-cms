<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/indexer.php';
require_once JPATH_TESTS . '/suites/libraries/joomla/database/stubs/nosqldriver.php';

use Joomla\Registry\Registry;

/**
 * Test class for FinderIndexer.
 * Generated by PHPUnit on 2012-06-10 at 14:41:28.
 */
class FinderIndexerTest extends TestCaseDatabase
{
	/**
	 * @var FinderIndexer
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		parent::setUp();

		// Store the factory state so we can mock the necessary objects
		$this->saveFactoryState();

		JFactory::$application = $this->getMockCmsApp();
		JFactory::$database    = $this->getMockDatabase('Mysqli');
		JFactory::$session     = $this->getMockSession();

		// Register the object
		$this->object = FinderIndexer::getInstance();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
		// Restore the factory state
		$this->restoreFactoryState();
		unset($this->object);
		parent::tearDown();
	}

	/**
	 * Gets the data set to be loaded into the database during setup
	 *
	 * @return  PHPUnit_Extensions_Database_DataSet_CsvDataSet
	 *
	 * @since   3.1
	 */
	protected function getDataSet()
	{
		$dataSet = new PHPUnit_Extensions_Database_DataSet_CsvDataSet(',', "'", '\\');

		$dataSet->addTable('jos_extensions', JPATH_TEST_DATABASE . '/jos_extensions.csv');

		return $dataSet;
	}

	/**
	 * Tests the getInstance method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 * @covers  FinderIndexer::getInstance
	 */
	public function testGetInstance()
	{
		$this->assertInstanceOf(
			'FinderIndexerDriverMysql',
			FinderIndexer::getInstance()
		);
	}

	/**
	 * Tests the getInstance method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 * @covers  FinderIndexer::getInstance
	 */
	public function testGetInstanceSqlazure()
	{
		JFactory::$database = $this->getMockDatabase('Sqlazure');

		$this->assertInstanceOf(
			'FinderIndexerDriverSqlsrv',
			FinderIndexer::getInstance()
		);
	}

	/**
	 * Tests the getInstance method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 * @covers  FinderIndexer::getInstance
	 * @expectedException  RuntimeException
	 */
	public function testGetInstanceException()
	{
		JFactory::$database = $this->getMockDatabase('Nosql');

		FinderIndexer::getInstance();
	}

	/**
	 * Tests the setState method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 * @covers  FinderIndexer::getState
	 */
	public function testGetState()
	{
		$this->assertInstanceOf(
			'JObject',
			FinderIndexer::getState()
		);
	}

	/**
	 * Tests the setState method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 * @covers  FinderIndexer::setState
	 */
	public function testSetState()
	{
		// Set up our test object
		$test = new JObject;
		$test->string = 'Testing FinderIndexer::setState()';

		// First, assert we can successfully set the state
		$this->assertTrue(
			FinderIndexer::setState($test)
		);

		// Set the session data to test retrieval
		FinderIndexer::setState($test);

		// Now assert we can successfully get the state data we just stored
		$this->assertInstanceOf(
			'JObject',
			FinderIndexer::getState()
		);
	}

	/**
	 * Tests the setState method with an invalid data object
	 *
	 * @return  void
	 *
	 * @since   3.0
	 * @covers  FinderIndexer::setState
	 */
	public function testSetStateBadData()
	{
		// Set up our test object
		$test = new Registry;
		$test->set('string', 'Testing FinderIndexer::setState()');

		// Attempt to set the state
		$this->assertFalse(
			FinderIndexer::setState($test),
			'setState method is not compatible with Registry'
		);
	}

	/**
	 * Tests the resetState method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 * @covers  FinderIndexer::resetState
	 */
	public function testResetState()
	{
		// Reset the state
		FinderIndexer::resetState();

		// Test we get a null object
		$this->assertNull(
			JFactory::getSession()->get('_finder.state', null)
		);
	}
}
