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

	class CalendarControllerTest extends WebTestCase
	{
		use DBRegenerateTrait;

		/**
		 * Sets up environment for testing
		 * Regenerates Database schema before every test-run
		 */
		public function setup()
		{
			$this->regenerateSchema();
			$fixture = new Exercises();
			$fixture->load($this->em);
		}

		public function testIndex()
		{
		}
	}
