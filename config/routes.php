<?php

/* sistem constants */
define(_NAMESPACE_, 'namespace');
define(_CONTROLLER_, 'controllers');
define(_METHOD_, 'methods');
define(_TO_, 'to');
define(_DEFAULT_, 'index');

/* * *************************************************************************** */
/* real namespaces in your sistem */
define(OPTIMIZER_CONTROLLERS, 'Optimizer\Controllers');
define(OPTIMIZER_CONTROLLERS_APPLICATION, 'Optimizer\Controllers\Application');
/* real controllers in your sistem */
define(HOME, 'Home');
define(LOGIN, 'Login');
define(REGISTER, 'Register');
define(CONTROL_PANEL, 'ControlPanel');
define(OPTIMIZER, 'Optimizer');
/* real methods in your sistem */
define(MAKE_WELCOME, 'welcome');
define(MAKE_LOGIN_FORM, 'makeLoginForm');
define(IS_LOGGET, 'isLogget');
define(NOT_YET, 'notYet');
define(MAKE_REGISTERED_FORM, 'makeRegisterForm');
define(IS_REGISTERED, 'isRegistered');
define(REGISTER_ERROR, 'registerError');
define(MAKE_SETINGS, 'makeSetings');
define(MAKE_MENU, 'makeMenu');
define(MAKE_WALLPAPER, 'makeWallpaper');
define(LOG_OUT, 'logOut');
define(MAKE_PRINTER, 'makePrinter');
define(MAKE_TABLETS, 'makeTablets');
define(MAKE_LANGUAGE, 'makeLanguage');
define(MAKE_STATISTICS, 'makeStatistics');
define(MAKE_HELP, 'makeHelp');
define(MAKE_KEYBOARD, 'makeKeyboard');
/* * *************************************************************************** */


/* * *************************************************************************** */
/* relative namespaces from the URI */
define(URI_APPLICATION, 'application');
/* relative controllers from the URI */
define(URI_HOME, 'home');
define(URI_LOGIN, 'login');
define(URI_REGISTER, 'register');
define(URI_CONTROL_PANEL, 'controlpanel');
define(URI_OPTIMIZER, 'optimizer');
/* relative methods from the URI */
define(URI_MAKE_WELCOME, 'welcome');
define(URI_MAKE_LOGIN_FORM, 'make-login-form');
define(URI_IS_LOGGET, 'is-logget');
define(URI_NOT_YET, 'not-yet');
define(URI_MAKE_REGISTERED_FORM, 'make-register-form');
define(URI_IS_REGISTERED, 'is-registered');
define(URI_REGISTER_ERROR, 'register-error');
define(URI_MAKE_SETINGS, 'make-setings');
define(URI_MAKE_MENU, 'make-menu');
define(URI_MAKE_WALLPAPER, 'make-wallpaper');
define(URI_LOG_OUT, 'log-out');
define(URI_MAKE_PRINTER, 'make-printer');
define(URI_MAKE_TABLETS, 'make-tablets');
define(URI_MAKE_LANGUAGE, 'make-language');
define(URI_MAKE_STATISTICS, 'make-statistics');
define(URI_MAKE_HELP, 'make-help');
define(URI_MAKE_KEYBOARD, 'make-keyboard');
/* * *************************************************************************** */

/* set namespaces */
/* my default namespace */
$config['*'][_NAMESPACE_] = OPTIMIZER_CONTROLLERS;
$config[URI_APPLICATION][_NAMESPACE_] = OPTIMIZER_CONTROLLERS_APPLICATION;
/* set controllers */
$config['*'][_CONTROLLER_][URI_HOME][_TO_] = HOME;
$config['*'][_CONTROLLER_][URI_LOGIN][_TO_] = LOGIN;
$config['*'][_CONTROLLER_][URI_REGISTER][_TO_] = REGISTER;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_TO_] = CONTROL_PANEL;
$config[URI_APPLICATION][_CONTROLLER_][URI_OPTIMIZER][_TO_] = OPTIMIZER;
/* set methods */
$config['*'][_CONTROLLER_][URI_LOGIN][_METHOD_][URI_MAKE_LOGIN_FORM] = MAKE_LOGIN_FORM;
$config['*'][_CONTROLLER_][URI_LOGIN][_METHOD_][URI_IS_LOGGET] = IS_LOGGET;
$config['*'][_CONTROLLER_][URI_LOGIN][_METHOD_][URI_NOT_YET] = NOT_YET;

$config['*'][_CONTROLLER_][URI_REGISTER][_METHOD_][URI_MAKE_REGISTERED_FORM] = MAKE_REGISTERED_FORM;
$config['*'][_CONTROLLER_][URI_REGISTER][_METHOD_][URI_IS_REGISTERED] = IS_REGISTERED;
$config['*'][_CONTROLLER_][URI_REGISTER][_METHOD_][URI_REGISTER_ERROR] = REGISTER_ERROR;

$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_SETINGS] = MAKE_SETINGS;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_MENU] = MAKE_MENU;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_WALLPAPER] = MAKE_WALLPAPER;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_PRINTER] = MAKE_PRINTER;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_TABLETS] = MAKE_TABLETS;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_LANGUAGE] = MAKE_LANGUAGE;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_HELP] = MAKE_HELP;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_MAKE_STATISTICS] = MAKE_STATISTICS;
$config['*'][_CONTROLLER_][URI_CONTROL_PANEL][_METHOD_][URI_LOG_OUT] = LOG_OUT;

$config[URI_APPLICATION][_CONTROLLER_][URI_OPTIMIZER][_METHOD_][URI_MAKE_KEYBOARD] = MAKE_KEYBOARD;

return $config;
