<?php
	namespace Tests;

	use Doctrine\ORM\EntityManagerInterface;
	use Doctrine\ORM\Tools\SchemaTool;
	use Symfony\Bundle\FrameworkBundle\Client;

	trait DBRegenerateTrait
	{
		/**
		 * @var EntityManagerInterface
		 */
		private $em;

		/**
		 * @var Client
		 */
		protected $client;

		protected function regenerateSchema(array $fixtures)
		{
			$this->client = static::createClient();
			$container = $this->client->getContainer();
			$doctrine = $container->get('doctrine');
			$this->em = $doctrine->getManager();
			$metadata = $this->em->getMetadataFactory()->getAllMetadata();
			/**
			 * Drops current schema and creates a brand new one
			 */
			if (!empty($metadata))
			{
				$tool = new SchemaTool($this->em);
				$tool->dropSchema($metadata);
				$tool->createSchema($metadata);
			}

			foreach($fixtures as $fixtureClass)
			{
				$fixture = new $fixtureClass();
				$fixture->load($this->em);
			}
		}

		protected function tearDown()
		{
			parent::tearDown();
			$this->em->close();
		}
	}