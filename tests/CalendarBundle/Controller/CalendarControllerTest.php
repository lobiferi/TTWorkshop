<?php
	/**
	 * Created by PhpStorm.
	 * User: flobozar
	 * Date: 5-1-2016
	 * Time: 16:23
	 */

	namespace CalendarBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Tests\CalendarBundle\TestHelper\DataFixtures\Exercises;
	use Tests\DBRegenerateTrait;

	//todo: you are trying to create Functional test, it was not required. You need to create Unit test. Unit test do not work with database and do not use fixtures.
	class CalendarControllerTest extends WebTestCase
	{
		use DBRegenerateTrait;

		/**
		 * Sets up environment for testing
		 * Regenerates Database schema before every test-run
		 */
		public function setup()
		{
			$this->regenerateSchema([Exercises::class]);
		}

		public function testIndex()
		{
		}
	}
