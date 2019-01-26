<?php

namespace Optimizer\Controllers;

use MPN\DefaultController;
use Optimizer\Models\Languages\Polyglot;
use Optimizer\Models\User;

/**
 * Description: main entry point controller
 *
 * @author Martin Nikolov
 */
class Home extends DefaultController {

    private $user = null;
    private $polyglot = null;
    private $dictionary = array();

    public function __construct() {
        parent::__construct();
    }

    public function welcome() {
        if(!$this->session->isLogget){
            $this->session->isLogget = false;
        }
        if ($this->session->isLogget === true) {
            $this->user = new User();
            $this->polyglot = new Polyglot();
            $this->dictionary = $this->polyglot->setLanguage($this->user->getData($this->app->getSession()->getSessionId())->language)->getDictionery(__FUNCTION__);
            $this->session->message = $this->dictionary['session_message'] . ' ' . $this->user->name;
            header("Location: " . DOMAIN_CONTROLPANEL_MAKESETINGS);
            exit;
        } else {
            header("Location: " . DOMAIN_LOGIN_MAKELOGINFORM);
            exit;
        }
    }

}
