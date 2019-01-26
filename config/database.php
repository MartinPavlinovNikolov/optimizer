<?php

/* * *************************************************************************** */
/* define constants for config.
 * this config using PDO */
define(_DEF_, 'default');
define(_S_, 'session');
define(_CONNECTION_, 'connection_uri');
define(_USERNAME_, 'username');
define(_PASS_, 'pass');
define(_P_O_, 'pdo_options');
define(MY_DB, 'mysql:host=localhost;dbname=optimizer');
define(USERNAME, 'root');
define(PASS, '');
define(ENCODING, 'SET NAMES "UTF8"');
/* * *************************************************************************** */

/* * *************************************************************************** */
/* select default config for my DB */
$config[_DEF_][_CONNECTION_] = MY_DB;
$config[_DEF_][_USERNAME_] = USERNAME;
$config[_DEF_][_PASS_] = PASS;
$config[_DEF_][_P_O_][PDO::MYSQL_ATTR_INIT_COMMAND] = ENCODING;
$config[_DEF_][_P_O_][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
/* * *************************************************************************** */

/* * *************************************************************************** */
/* if sessions are stored in DB, define configuration */
$config[_S_][_CONNECTION_] = 'mysql:host=localhost;dbname=optimizer';
$config[_S_][_USERNAME_] = USERNAME;
$config[_S_][_PASS_] = PASS;
$config[_S_][_P_O_][PDO::MYSQL_ATTR_INIT_COMMAND] = ENCODING;
$config[_S_][_P_O_][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
/* * *************************************************************************** */
return $config;
