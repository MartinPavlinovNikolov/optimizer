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
class Register extends DefaultController {

    private $user = null;
    private $polyglot = null;
    private $dictionary = array();

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->polyglot = new Polyglot();
        if (!$this->session->language) {
            $this->session->language = 'en';
        }
    }

    public function makeRegisterForm() {
        $this->dictionary = $this->polyglot->setLanguage($this->session->language)->getDictionery(__FUNCTION__);

        $this->session->isLogget = false;

        /* set all variables for tamplates */
        $this->view->language = $this->session->language;
        $this->view->action1 = DOMAIN_REGISTER_ISREGISTER;
        $this->view->action2 = DOMAIN_LOGIN_MAKELOGINFORM;
        $this->view->title = $this->dictionary['register'];
        $this->view->name = $this->dictionary['name'];
        $this->view->min = $this->dictionary['min'];
        $this->view->password = $this->dictionary['password'];
        $this->view->characters = $this->dictionary['characters'];
        $this->view->btn2 = $this->dictionary['back_to_login'];
        $this->view->login = $this->dictionary['register'];
        $this->view->icon1 = $this->dictionary['glyphicon_plus'];
        $this->view->icon2 = $this->dictionary['glyphicon_log_in'];
        $this->view->color1 = $this->dictionary['btn_success'];
        $this->view->color2 = $this->dictionary['btn_primary'];
        $this->view->choose_language = $this->dictionary['choose_language'];
        $this->view->note_printer = $this->dictionary['note_printer'];
        $this->view->note_printer2 = $this->dictionary['note_printer2'];
        $this->view->printer = $this->dictionary['printer'];
        $this->view->domain = $this->dictionary['domain'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'login-register-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('printer_part', 'login-register-templates/register-form');
        $this->view->appendToLayouts('content', 'login-register-templates/login-register-form');
        $this->view->appendToLayouts('language', 'language-form');
        $this->view->appendToLayouts('scripts', 'login-register-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.login-register.form');
    }

    public function isRegistered() {
        $this->dictionary = $this->polyglot->setLanguage($this->session->language)->getDictionery(__FUNCTION__);

        $user = $this->input->post('username', 'trim|string');
        $pass = $this->input->post('password', 'trim|string');
        $printer = $this->input->post('printer-name', 'trim|string');
        $domain = $this->input->post('printer-domain', 'trim|string');

        $lang = $this->session->language;

        $this->validation->setRule('minLength', $user, 4, $this->dictionary['short_name'])->
                setRule('minLength', $pass, 8, $this->dictionary['short_pass'])->
                setRule('minLength', $printer, 1, $this->dictionary['empty_printer'])->
                setRule('minLength', $domain, 1, $this->dictionary['empty_domain']);

        if (!$this->validation->validate()) {
            $this->view->language = $this->session->language;
            $this->session->message = $this->validation->getErrorsLikeString(true);
            $this->session->isLogget = false;
            header("Location: " . DOMAIN_REGISTER_REGISTERERROR);
            exit;
        } elseif ($this->user->isExist($user)) {
            $this->view->language = $this->session->language;
            $this->session->message = $this->dictionary['error_register_user_exist'];
            $this->session->isLogget = false;
            header("Location: " . DOMAIN_REGISTER_REGISTERERROR);
            exit;
        } else {
            $this->session->isLogget = true;

            $options = ['cost' => 12];
            $_pass = password_hash($pass, PASSWORD_BCRYPT, $options);
            $this->user->register([$this->app->getSession()->getSessionId(), $user, $_pass, $printer, $lang, $domain, 'default.png']);

            $this->session->message = $this->dictionary['session_message'] . ' ' . mb_convert_case($user, MB_CASE_TITLE, "UTF-8");
            $this->view->language = $lang;
            header("Location: " . DOMAIN_CONTROLPANEL_MAKESETINGS);
            exit;
        }
    }

    public function registerError() {
        $this->dictionary = $this->polyglot->setLanguage($this->session->language)->getDictionery(__FUNCTION__);

        if (!$this->session->isLogget === false) {
            throw new Exception('URI Patch error(manual accessing via URL with valid session)', 400);
        }
        $this->view->message = $this->session->message;

        /* set all variables for tamplates */
        $this->view->language = $this->session->language;
        $this->view->action1 = DOMAIN_REGISTER_ISREGISTER;
        $this->view->action2 = DOMAIN_LOGIN_MAKELOGINFORM;
        $this->view->title = $this->dictionary['register'];
        $this->view->name = $this->dictionary['name'];
        $this->view->min = $this->dictionary['min'];
        $this->view->password = $this->dictionary['password'];
        $this->view->characters = $this->dictionary['characters'];
        $this->view->btn2 = $this->dictionary['back_to_login'];
        $this->view->login = $this->dictionary['register'];
        $this->view->icon1 = $this->dictionary['glyphicon_plus'];
        $this->view->icon2 = $this->dictionary['glyphicon_log_in'];
        $this->view->color1 = $this->dictionary['btn_success'];
        $this->view->color2 = $this->dictionary['btn_primary'];
        $this->view->choose_language = $this->dictionary['choose_language'];
        $this->view->note_printer = $this->dictionary['note_printer'];
        $this->view->note_printer2 = $this->dictionary['note_printer2'];
        $this->view->printer = $this->dictionary['printer'];
        $this->view->domain = $this->dictionary['domain'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'login-register-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('error_message', 'login-register-templates/register-form-error');
        $this->view->appendToLayouts('printer_part', 'login-register-templates/register-form');
        $this->view->appendToLayouts('content', 'login-register-templates/login-register-form');
        $this->view->appendToLayouts('language', 'language-form');
        $this->view->appendToLayouts('scripts', 'login-register-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.login-register.form');
    }

}
