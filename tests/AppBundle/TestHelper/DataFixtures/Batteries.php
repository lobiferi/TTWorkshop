<?php
	namespace Tests\AppBundle\TestHelper\DataFixtures;

	use AppBundle\Entity\Battery;
	use Doctrine\Common\DataFixtures\FixtureInterface;
	use Doctrine\Common\Persistence\ObjectManager;

	class Batteries implements FixtureInterface
	{
		public function load(ObjectManager $manager)
		{
			$this->abbBattery($manager, 'AA', 'Duracell', 12);
			$this->abbBattery($manager, 'AAA', 'Duracell', 10);
			$this->abbBattery($manager, '9V', 'Duracell', 8);
			$this->abbBattery($manager, 'AA', 'GP', 12);
			$this->abbBattery($manager, 'AAA', 'GP', 10);
			$this->abbBattery($manager, 'AA', 'GP', 8);
		}

		/**
		 * @param ObjectManager $manager
		 * @param               $batteryType
		 * @param               $name
		 * @param               $count
		 */
		protected function abbBattery(ObjectManager $manager, $batteryType, $name, $count)
		{
			$battery = new Battery();
			$battery->setBatteryType($batteryType);
			$battery->setName($name);
			$battery->setCount($count);
			$manager->persist($battery);
			$manager->flush();
		}
	}