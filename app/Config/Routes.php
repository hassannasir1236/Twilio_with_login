<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->view('sms/send', 'smsSend');
$routes->post('sms/send', 'SmsController::send');
