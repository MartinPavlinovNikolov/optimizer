<?php

/**
 * Description of Index
 *
 * @author Martin Nikolov
 */

namespace Optimizer\Controllers;
use MPN\DefaultController;
use MPN\Loader;
use Optimizer\Models\OptimizerDB;
use Optimizer\Controllers\Login;

class Index extends DefaultController {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            throw new \Exception('No session exist!', 400);
        }
    }

    public function index() {
        if ($_SESSION['isLogget'] === true) {
            Loader::registerNamespace('Optimizer\Models', 'C:\xampp\htdocs\optimizer\models');
            $db = new OptimizerDB();
            $this->view->arrMenu = $db->getItems();
            $this->view->appendToLayouts('slider', 'index_templates/slider');
            $this->view->appendToLayouts('canvas', 'index_templates/canvas');
            $this->view->appendToLayouts('corections', 'index_templates/corections');
            $this->view->appendToLayouts('footer', 'index_templates/footer');
            $this->view->appendToLayouts('header', 'index_templates/header');
            $this->view->appendToLayouts('history', 'index_templates/history');
            $this->view->appendToLayouts('mainButtons', 'index_templates/mainButtons');
            $this->view->appendToLayouts('screen', 'index_templates/screen');
            $this->view->appendToLayouts('senders', 'index_templates/senders');
            $this->view->display('layouts.app');
        } else {
            $logger = new Login();
            $logger->makeLoginForm();
        }
    }

}
