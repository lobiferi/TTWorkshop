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
			//todo: with this approach, you are testing only "report" page.
			//todo: you also need to test form, via submitting it with crawler.
			//todo: it could be one test - first you submit form several times and then got to "report" and see results. 
			$crawler = $this->client->request('GET', '/battery/report');
			$this->assertEquals(200, $this->client->getResponse()->getStatusCode());
			$this->assertContains('Battery summary', $crawler->filter('body h3')->text());
			//todo: you can not rely on positions of row in a table, now your test is not stable. Because order of rows can be different, table could contain additional rows, but test should still pass.
			$this->assertContains('AA',  $crawler->filter('table tbody>tr td')->text());
			$this->assertContains('32',  $crawler->filter('table tbody>tr td+td')->text());
			$this->assertContains('AAA', $crawler->filter('table tbody>tr+tr td')->text());
			$this->assertContains('20',  $crawler->filter('table tbody>tr+tr td+td')->text());
			$this->assertContains('9V',  $crawler->filter('table tbody>tr+tr+tr td')->text());
			$this->assertContains('8',   $crawler->filter('table tbody>tr+tr+tr td+td')->text());
		}
	}
