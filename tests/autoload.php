<?php
	$loader = require __DIR__ . '/../app/autoload.php';
	$loader->set('AppBundle\\TestHelper\\',[__DIR__]);
	$loader->set('CalendarBundle\\TestHelper\\',[__DIR__]);
	return $loader;
