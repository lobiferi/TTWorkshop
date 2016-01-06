<?php

	namespace Tests\AppBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Tests\AppBundle\TestHelper\DataFixtures\Batteries;
	use Tests\DBRegenerateTrait;

	class BatteryControllerTest extends WebTestCase
	{
		use DBRegenerateTrait;


		/**
		 * Sets up environment for testing
		 * Regenerates Database schema before every test-run
		 */
		public function setup()
		{
			$this->regenerateSchema();
			$fixture = new Batteries();
			$fixture->load($this->em);
		}

		public function testIndex()
		{
			$crawler = $this->client->request('GET', '/battery/report');
			$this->assertEquals(200, $this->client->getResponse()->getStatusCode());
			$this->assertContains('Battery summary', $crawler->filter('body h3')->text());
			$this->assertContains('AA',  $crawler->filter('table tbody>tr td')->text());
			$this->assertContains('32',  $crawler->filter('table tbody>tr td+td')->text());
			$this->assertContains('AAA', $crawler->filter('table tbody>tr+tr td')->text());
			$this->assertContains('20',  $crawler->filter('table tbody>tr+tr td+td')->text());
			$this->assertContains('9V',  $crawler->filter('table tbody>tr+tr+tr td')->text());
			$this->assertContains('8',   $crawler->filter('table tbody>tr+tr+tr td+td')->text());
		}
	}
