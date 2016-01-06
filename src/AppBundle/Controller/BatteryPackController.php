<?php
	namespace AppBundle\Controller;

	use AppBundle\Entity\Battery;
	use Doctrine\ORM\QueryBuilder;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Component\Form\FormError;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Validator\ConstraintViolation;
	use AppBundle\Form\BatteryType;
	use AppBundle\Repository\BatteryRepository;
	use AppBundle\AppBundle;
	use TTBundle\Controller\TTControllerHelperTrait;

	/**
	 * Class BatteryPackController
	 * @package AppBundle\Controller
	 * @Route("/battery")
	 */
	class BatteryPackController extends Controller
	{
		use TTControllerHelperTrait;

		/**
		 * @Route("/report")
		 * @Method({"GET"})
		 */
		public function reportAction()
		{
			$report = $this->getRepository(Battery::class)->getSimpleReport();

			return ['data' => $report];
		}

		/**
		 * @Route("/new")
		 * @Method({"GET"})
		 */
		public function indexAction(Request $request)
		{
			$form = $this->initForm($request, BatteryType::class);

			return [
				'form' => $form->createView()
			];
		}


		/**
		 * @Route("/new")
		 * @Method({"POST"})
		 */
		public function postAction(Request $request)
		{
			$form = $this->initForm($request, BatteryType::class);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				/** @var BatteryType $data */
				$data = $form->getData();
				$em->persist((new Battery())->setName($data->name)->setBatteryType($data->batteryType)->setCount($data->count));
				//$em->persist($form->getData());
				$em->flush();
				return $this->redirectToRoute('app_batterypack_report');
			}
			$this->saveErrorsToFlashBag($request, $form);

			return $this->redirectToRoute('app_batterypack_index');
		}
	}