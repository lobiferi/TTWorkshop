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
		 * //todo: please, combine indexAction and postAction. It should be one action, responsible for both processes
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
				//todo: form itself is able to generate battery, so no need to create it manually in this case
				$battery = new Battery();
				//todo: if you configure form correctly, then $form->getData() will return Battery object with all parameters set.
				$battery->setName($form->get('name')->getData());
				$battery->setBatteryType($form->get('batteryType')->getData());
				$battery->setCount($form->get('count')->getData());

				$em->persist($battery);
				$em->flush();

				return $this->redirectToRoute('app_batterypack_report');
			}
			//todo: this is really not needed. Form is able to render errors togather with fields. In flash bag there should be just a message that "you have errors"
			$this->saveErrorsToFlashBag($request, $form);

			return $this->redirectToRoute('app_batterypack_index');
		}
	}
