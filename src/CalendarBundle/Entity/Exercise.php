<?php

	namespace CalendarBundle\Entity;

	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Battery
	 * @ORM\Table(name="exercise")
	 * @ORM\Entity(repositoryClass="CalendarBundle\Repository\ExerciseRepository")
	 */
	class Exercise
	{
		/**
		 * @var int
		 * @ORM\Column(name="id", type="integer")
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		private $id;
		/**
		 * @var string
		 * @ORM\Column(name="short_desc", type="string", length=50)
		 */
		private $shortDesc;
		/**
		 * @var integer
		 * @ORM\Column(name="weight", type="integer")
		 */
		private $weight;
		/**
		 * @var int
		 * @ORM\Column(name="count", type="integer")
		 */
		private $count;
		/**
		 * @var DateTime
		 * @ORM\Column(name="date", type="date")
		 */
		private $date;
		/**
		 * @var DateTime
		 * @ORM\Column(name="time", type="time")
		 */
		private $time;

		/**
		 * @return int
		 */
		public function getId()
		{
			return $this->id;
		}

		/**
		 * @param int $id
		 * @return Exercise
		 */
		public function setId($id)
		{
			$this->id = $id;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getShortDesc()
		{
			return $this->shortDesc;
		}

		/**
		 * @param string $shortDesc
		 * @return Exercise
		 */
		public function setShortDesc($shortDesc)
		{
			$this->shortDesc = $shortDesc;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getWeight()
		{
			return $this->weight;
		}

		/**
		 * @param int $weight
		 * @return Exercise
		 */
		public function setWeight($weight)
		{
			$this->weight = $weight;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getCount()
		{
			return $this->count;
		}

		/**
		 * @param int $count
		 * @return Exercise
		 */
		public function setCount($count)
		{
			$this->count = $count;

			return $this;
		}

		/**
		 * @return DateTime
		 */
		public function getDate()
		{
			return $this->date;
		}

		/**
		 * @param DateTime $date
		 * @return Exercise
		 */
		public function setDate($date)
		{
			$this->date = $date;

			return $this;
		}

		/**
		 * @return DateTime
		 */
		public function getTime()
		{
			return $this->time;
		}

		/**
		 * @param DateTime $time
		 * @return Exercise
		 */
		public function setTime($time)
		{
			$this->time = $time;

			return $this;
		}
	}
