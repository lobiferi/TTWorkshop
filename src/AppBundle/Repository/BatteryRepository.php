<?php

	namespace AppBundle\Repository;

	use Doctrine\ORM\QueryBuilder;

	/**
	 * BatteryRepository
	 * This class was generated by the Doctrine ORM. Add your own custom
	 * repository methods below.
	 */
	class BatteryRepository extends \Doctrine\ORM\EntityRepository
	{
		/**
		 * @return mixed
		 */
		function getSimpleReport()
		{
			/** @var $queryBuilder QueryBuilder */
			$queryBuilder = $this->createQueryBuilder('o');
			$queryBuilder->select('o.name');
			$queryBuilder->addSelect('o.batteryType');
			$queryBuilder->addSelect('SUM(o.count) AS counter');
			$queryBuilder->groupBy('o.batteryType');
			$queryBuilder->orderBy('counter', 'DESC');

			return $queryBuilder->getQuery()->execute();
		}
	}
