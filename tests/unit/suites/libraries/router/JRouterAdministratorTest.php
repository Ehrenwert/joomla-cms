<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Router
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JRouterAdministrator.
 * Generated by PHPUnit on 2012-07-26 at 20:39:38.
 */
class JRouterAdministratorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var JRouterAdministrator
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		// Import dependencies
		jimport('joomla.application.router');

		$this->object = new JRouterAdministrator;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
	}

	/**
	 * Tests the isCompatible method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 *
	 * @covers  JRouterAdministrator::parse
	 */
	public function testParse()
	{
		$uri = JUri::getInstance('http://localhost');

		$this->assertThat(
			$this->object->parse($uri),
			$this->isType('array'),
			'JRouterAdministrator::parse() returns an empty array.'
		);
	}

	/**
	 * @covers JRouterAdministrator::build
	 * @todo   Implement testBuild().
	 */
	public function testBuild()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete('This test has not been implemented yet.'
		);
	}
}
