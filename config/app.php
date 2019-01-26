<?php

/* define links in the sistem */
define(DOMAIN, 'http://optimizer.com');
define(DOMAIN_HOME_WELCOME, 'http://optimizer.com/home/welcome');
define(DOMAIN_LOGIN_MAKELOGINFORM, 'http://optimizer.com/login/make-login-form');
define(DOMAIN_LOGIN_ISLOGGET, 'http://optimizer.com/login/is-logget');
define(DOMAIN_LOGIN_NOTYET, 'http://optimizer.com/login/not-yet');
define(DOMAIN_REGISTER_MAKEREGISTERFORM, 'http://optimizer.com/register/make-register-form');
define(DOMAIN_REGISTER_ISREGISTER, 'http://optimizer.com/register/is-registered');
define(DOMAIN_REGISTER_REGISTERERROR, 'http://optimizer.com/register/register-error');
define(DOMAIN_CONTROLPANEL_MAKESETINGS, 'http://optimizer.com/controlpanel/make-setings');
define(DOMAIN_CONTROLPANEL_MAKEMENU, 'http://optimizer.com/controlpanel/make-menu');
define(DOMAIN_CONTROLPANEL_MAKEWALLPAPER, 'http://optimizer.com/controlpanel/make-wallpaper');
define(DOMAIN_CONTROLPANEL_LOGOUT, 'http://optimizer.com/controlpanel/log-out');
define(DOMAIN_CONTROLPANEL_MAKEPRINTER, 'http://optimizer.com/controlpanel/make-printer');
define(DOMAIN_CONTROLPANEL_MAKETABLETS, 'http://optimizer.com/controlpanel/make-tablets');
define(DOMAIN_CONTROLPANEL_MAKELANGUAGE, 'http://optimizer.com/controlpanel/make-language');
define(DOMAIN_CONTROLPANEL_MAKESTATISTICS, 'http://optimizer.com/controlpanel/make-statistics');
define(DOMAIN_CONTROLPANEL_MAKEHELP, 'http://optimizer.com/controlpanel/make-help');
define(DOMAIN_APPLICATION_OPTIMIZER_MAKEKEYBOARD, 'http://optimizer.com/application/optimizer/make-keyboard');

/* display exeptions in the browser: true/false */
$config['displayExceptions'] = true;

/* error-log location(errors.txt) */
$config['errors_log_location'] = '../private/errors.txt';

/* select my default controller */
$config['default_controller'] = 'Home';
/* select my default method */
$config['default_method'] = 'welcome';

/* my project controllers full path! */
$config['namespaces']['Optimizer\Models'] = 'C:\xampp\htdocs\optimizer\models';
$config['namespaces']['Optimizer\Controllers'] = 'C:\xampp\htdocs\optimizer\controllers';
$config['namespaces']['Optimizer\Controllers\Application'] = 'C:\xampp\htdocs\optimizer\controllers\application';

/* autostart session true/false */
$config['session']['autostart'] = true;

/* select session type native/database */
$config['session']['type'] = 'native';
$config['session']['name'] = '__sess';
$config['session']['lifetime'] = 3600 * 24 * 30;
$config['session']['path'] = '/';
$config['session']['domain'] = '';

/* select mode for cookies http/https (false/true) */
$config['session']['secure'] = false;

/* if sessions are stored in database */
$config['session']['dbConnection'] = 'default';
$config['session']['dbTable'] = 'sessions';

return $config;
