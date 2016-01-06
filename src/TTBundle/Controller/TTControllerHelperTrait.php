<?php
	namespace TTBundle\Controller;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Form;
	use Symfony\Component\Form\FormError;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Validator\ConstraintViolation;

	trait TTControllerHelperTrait
	{
		/**
		 * Gets the repository for a class.
		 * @param string $className
		 * @return \Doctrine\Common\Persistence\ObjectRepository
		 * @see \Doctrine\Common\Persistence\ObjectManager::getRepository
		 */
		protected function getRepository($className)
		{
			return $this->getDoctrine()->getManager()->getRepository($className);
		}

		/**
		 * @param Request      $request
		 * @param AbstractType $formClass
		 * @return \Symfony\Component\Form\Form
		 */
		protected function initForm(Request $request, $formClass, $formData = null)
		{
			$flashBag = $request->getSession()->getFlashBag();
			$errors = $flashBag->get('validation_error_' . $formClass);
			$errorRequest = $flashBag->get('validation_error_request_' . $formClass);

			if ($errorRequest)
			{
				$request = $errorRequest[0];
			}

			$form = $this->createForm($formClass, $formData);

			if ($errors)
			{
				foreach ($errors[0] as $error)
				{
					$form->get($error['cause'])->addError(new FormError($error['message'], $error['messageTemplate'], $error['messageParameters'], $error['messagePluralization']));
				}
			}

			$form->handleRequest($request);

			return $form;
		}

		/**
		 * @param Request $request
		 * @param
		 *            $form
		 * @param
		 *            $errors
		 */
		protected function saveErrorsToFlashBag(Request $request, Form $form)
		{
			$formClass = get_class($form->getConfig()->getType()->getInnerType());
			$errors = [];
			foreach ($form->getErrors(TRUE) as $error)
			{
				$cause = $error->getCause();
				$errors[] = [
					'message' => $error->getMessage(),
					'messageTemplate' => $error->getMessageTemplate(),
					'messageParameters' => $error->getMessageParameters(),
					'messagePluralization' => $error->getMessagePluralization(),
					'cause' => preg_replace('/data\.|children\[(.*?)\]/', '$1', $cause->getPropertyPath()),
					'invalidValue' => $cause->getInvalidValue()
				];
			}
			$this->addFlash('validation_error_' . $formClass, $errors);
			$this->addFlash('validation_error_request_' . $formClass, $request);
		}
	}