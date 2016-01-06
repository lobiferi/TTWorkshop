<?php

	namespace CalendarBundle\Repository;

	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\QueryBuilder;

	/**
	 * ExerciseRepository
	 * This class was generated by the Doctrine ORM. Add your own custom
	 * repository methods below.
	 */
	class ExerciseRepository extends EntityRepository
	{

		function getExercisesToday()
		{
			return $this->getExercises(0);
		}

		function getExercisesOneWeekBefore()
		{
			return $this->getExercises(1);
		}

		function getExercisesTwoWeeksBefore()
		{
			return $this->getExercises(2);
		}

		/**
		 * @param $weeksBefore
		 * @return mixed
		 */
		protected function getExercises($weeksBefore)
		{
			return $this->getDefaultQuery()->getQuery()->execute(['date'=> $this->getDate($weeksBefore)]);
		}

		/**
		 * @return QueryBuilder
		 */
		protected function getDefaultQuery()
		{
			/** @var $queryBuilder QueryBuilder */
			$queryBuilder = $this->createQueryBuilder('o');
			$queryBuilder->select('o.shortDesc');
			$queryBuilder->addSelect('o.weight');
			$queryBuilder->addSelect('o.count AS counter');
			$queryBuilder->where('o.date = :date');
			$queryBuilder->orderBy('o.shortDesc');

			return $queryBuilder;
		}

		/**
		 * @param int $weeksBefore
		 * @return string
		 */
		protected function getDate($weeksBefore = 0)
		{
			$date = new \DateTime();
			if ($weeksBefore > 0)
			{
				$date->modify("-$weeksBefore week");
			}

			return $date->format('Y-m-d');
		}
	}