<?php

/* * *************************************************************************** */
/* real json controllers in your sistem */
define(JSON, 'Json/');
/* real json methods in your sistem */
define(GET_TABLE_NUMBER, 'getTableNumber');
define(MAKE_ORDER, 'makeOrder');
define(MAKE_TOTAL, 'makeTotal');
define(MAKE_MENU, 'makeMenu');
define(SWITCH_LANG, 'switchLanguage');
/* * *************************************************************************** */


/* * *************************************************************************** */
/* relative methods from the JsonRPC */
define(URI_GET_TABLE_NUMBER, 'get-table-number');
define(URI_MAKE_ORDER, 'make-order');
define(URI_MAKE_TOTAL, 'make-total');
define(URI_MAKE_MENU, 'make-menu');
define(URI_SWITCH_LANG, 'switch-language');
/* * *************************************************************************** */

$cnf[URI_GET_TABLE_NUMBER] = JSON . GET_TABLE_NUMBER;
$cnf[URI_MAKE_ORDER] = JSON . MAKE_ORDER;
$cnf[URI_MAKE_TOTAL] = JSON . MAKE_TOTAL;
$cnf[URI_MAKE_MENU] = JSON . MAKE_MENU;
$cnf[URI_SWITCH_LANG] = JSON . SWITCH_LANG;
return $cnf;
