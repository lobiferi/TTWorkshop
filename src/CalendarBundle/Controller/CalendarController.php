<?php
	namespace CalendarBundle\Controller;

	use CalendarBundle\Entity\Exercise;
	use CalendarBundle\Repository\ExerciseRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use TTBundle\Controller\TTControllerHelperTrait;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

	/**
	 * @Route("/calendar")
	 */
	class CalendarController extends Controller
	{
		use TTControllerHelperTrait;

		/**
		 * @Route("/index")
		 */
		public function indexAction()
		{
			/** @var $repo ExerciseRepository */
			$repo = $this->getRepository(Exercise::class);

			return [
				'twoWeeksBefore' => $repo->getExercisesTwoWeeksBefore(),
				'oneWeekBefore' => $repo->getExercisesOneWeekBefore(),
				'today' => $repo->getExercisesToday()
			];
		}
	}