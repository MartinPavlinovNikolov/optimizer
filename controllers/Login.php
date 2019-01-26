<?php

namespace Optimizer\Controllers;

use MPN\DefaultController;
use Optimizer\Models\Languages\Polyglot;
use Optimizer\Models\User;
use Exception;

/**
 * Description: form-maker class
 *
 * @author Martin Nikolov
 */
class Login extends DefaultController {

    /**
     *
     * @var \Optimizer\Models\User
     */
    private $user = null;
    private $polyglot = null;
    private $dictionary = array();

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->polyglot = new Polyglot();
        if ($this->session->language === null) {
            $this->session->language = 'en';
        }
    }

    public function makeLoginForm() {
        $this->dictionary = $this->polyglot->setLanguage($this->session->language)->getDictionery(__FUNCTION__);

        $this->session->isLogget = false;

        /* set all variables for tamplates */
        $this->view->language = $this->session->language;
        $this->view->action1 = DOMAIN_LOGIN_ISLOGGET;
        $this->view->action2 = DOMAIN_REGISTER_MAKEREGISTERFORM;
        $this->view->title = $this->dictionary['login'];
        $this->view->name = $this->dictionary['name'];
        $this->view->min = $this->dictionary['min'];
        $this->view->password = $this->dictionary['password'];
        $this->view->characters = $this->dictionary['characters'];
        $this->view->btn2 = $this->dictionary['new_registration'];
        $this->view->login = $this->dictionary['login'];
        $this->view->icon1 = $this->dictionary['glyphicon_log_in'];
        $this->view->icon2 = $this->dictionary['glyphicon_plus'];
        $this->view->color1 = $this->dictionary['btn_primary'];
        $this->view->color2 = $this->dictionary['btn_success'];
        $this->view->choose_language = $this->dictionary['choose_language'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'login-register-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('content', 'login-register-templates/login-register-form');
        $this->view->appendToLayouts('language', 'language-form');
        $this->view->appendToLayouts('scripts', 'login-register-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.login-register.form');
    }

    public function isLogget() {
        $this->dictionary = $this->polyglot->setLanguage($this->session->language)->getDictionery(__FUNCTION__);

        $user = $this->input->post('username', 'trim|string');
        $pass = $this->input->post('password', 'trim|string');

        $this->validation->setRule('minLength', $user, 4, $this->dictionary['short_name'])->setRule('minLength', $pass, 8, $this->dictionary['short_pass']);

        if (!$this->validation->validate()) {
            $this->session->message = $this->validation->getErrorsLikeString(true);
            $this->session->isLogget = false;
            header("Location: " . DOMAIN_LOGIN_NOTYET);
            exit;
        } elseif ($this->user->isExist($user, $pass)) {
            $this->user->sincSessionId($this->app->getSession()->getSessionId(), $user);
            $this->user->update($this->session->language, 'user_language', $this->app->getSession()->getSessionId());
            $this->user->getData($this->app->getSession()->getSessionId());
            $this->session->isLogget = true;
            $this->session->message = $this->dictionary['session_message'] . ' ' . mb_convert_case($this->user->name, MB_CASE_TITLE, "UTF-8");
            header("Location: " . DOMAIN_CONTROLPANEL_MAKESETINGS);
            exit;
        } else {
            $this->session->isLogget = false;
            $this->session->message = $this->dictionary['error_login_wrong_name_or_password'];
            header("Location: " . DOMAIN_LOGIN_NOTYET);
            exit;
        }
    }

    public function notYet() {
        $this->dictionary = $this->polyglot->setLanguage($this->session->language)->getDictionery(__FUNCTION__);

        if ($this->session->isLogget) {
            throw new Exception('URI Patch error(manual accessing via URL with valid session)', 400);
        }
        $this->view->message = $this->session->message;

        /* set all variables for tamplates */
        $this->view->language = $this->session->language;
        $this->view->action1 = DOMAIN_LOGIN_ISLOGGET;
        $this->view->action2 = DOMAIN_REGISTER_MAKEREGISTERFORM;
        $this->view->title = $this->dictionary['login'];
        $this->view->name = $this->dictionary['name'];
        $this->view->min = $this->dictionary['min'];
        $this->view->password = $this->dictionary['password'];
        $this->view->characters = $this->dictionary['characters'];
        $this->view->btn2 = $this->dictionary['new_registration'];
        $this->view->login = $this->dictionary['login'];
        $this->view->icon1 = $this->dictionary['glyphicon_log_in'];
        $this->view->icon2 = $this->dictionary['glyphicon_plus'];
        $this->view->color1 = $this->dictionary['btn_primary'];
        $this->view->color2 = $this->dictionary['btn_success'];
        $this->view->choose_language = $this->dictionary['choose_language'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'login-register-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('error_message', 'login-register-templates/login-register-form-not-yet');
        $this->view->appendToLayouts('content', 'login-register-templates/login-register-form');
        $this->view->appendToLayouts('language', 'language-form');
        $this->view->appendToLayouts('scripts', 'login-register-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.login-register.form');
    }

}
