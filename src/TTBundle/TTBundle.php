<?php

	namespace TTBundle;

	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Bundle\Bundle;
	use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
	use Symfony\Component\HttpKernel\KernelEvents;

	class TTBundle extends Bundle
	{
		public function boot()
		{
			$container = $this->container;




			$this->container->get('debug.event_dispatcher')->addListener(KernelEvents::VIEW, function (GetResponseForControllerResultEvent $result)
			{
				$parameters = (array) $result->getControllerResult();
				$defaultRoute = $result->getRequest()->get('_route');
				//var_dump($result->getRequest());die;
				$routeParts = preg_split('/_/', $defaultRoute);
				array_shift($routeParts);

				$view = 'views/'.implode('/',$routeParts).'.html.twig';


				if ($this->container->has('templating')) {
					$response = $this->container->get('templating')->renderResponse($view, $parameters);
					$result->setResponse($response);;
					return;
				}

				if (!$this->container->has('twig')) {
					throw new \LogicException('You can not use the "render" method if the Templating Component or the Twig Bundle are not available.');
				}

				$response = new Response();

				$response->setContent($this->container->get('twig')->render($view, $parameters));

				$result->setResponse($response);
			});
		}
	}
