<?php
	namespace Tests\CalendarBundle\TestHelper\DataFixtures;

	use AppBundle\Entity\Battery;
	use CalendarBundle\Entity\Exercise;
	use Doctrine\Common\DataFixtures\FixtureInterface;
	use Doctrine\Common\Persistence\ObjectManager;
	use Symfony\Component\Validator\Constraints\DateTime;

	class Exercises implements FixtureInterface
	{
		public function load(ObjectManager $manager)
		{
			$days = 30;
			$date = new \DateTime(sprintf('-%d day', $days));
			$sortDesc = [
				'Exercise 1 - easy',
				'Exercise 2 - medium',
				'Exercise 3 - heavy',
			];

			for($days; $days>=0; $days--){
				for($c=rand(10, 15); $c>0 ; $c--){
					$this->addExercise(
						$manager,
						$sortDesc[rand(0, count($sortDesc) - 1)],
						rand(20, 200),
						rand(5, 15),
						$date
					);
				}
				$date->modify('+1 day');
			}

		}

		/**
		 * @param ObjectManager $manager
		 * @param               $sortDesc
		 * @param               $weight
		 * @param               $count
		 * @param \DateTime     $date
		 */
		protected function addExercise(ObjectManager $manager, $sortDesc, $weight, $count, \DateTime $date)
		{
			$exercise = new Exercise();
			$exercise->setShortDesc($sortDesc);
			$exercise->setWeight($weight);
			$exercise->setCount($count);
			$exercise->setDate($date);
			$exercise->setTime($date);
			$manager->persist($exercise);
			$manager->flush();
		}
	}