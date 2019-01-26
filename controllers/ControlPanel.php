<?php

/**
 * Description: class for control panel
 *
 * @author Martin Nikolov
 */

namespace Optimizer\Controllers;

use MPN\DefaultController;
use Optimizer\Models\Languages\Polyglot;
use Optimizer\Models\User;
use Optimizer\Models\Artist;

class ControlPanel extends DefaultController {

    private $user = null;
    private $polyglot = null;
    private $dictionary = array();

    public function __construct() {
        parent::__construct();
        if (!$this->session->isLogget) {
            throw new Exception('Not logget user!', 410);
        }
        $this->user = new User();
        $this->polyglot = new Polyglot();
    }

    public function makeSetings() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        if ($this->input->hasGet(0)) {
            $this->session->message = $this->dictionary[$this->input->get(0, 'trim|string')];
        }

        /* set all variables for tamplates */
        $this->view->message = $this->session->message;
        $this->view->language = $this->user->language;
        $this->view->user_printer = $this->user->printer;
        $langs = array("en" => "gb", "bg" => "bg", "el" => "gr", "es" => "es");
        $this->view->currentLanguage = "famfamfam-flag-" . $langs[$this->user->language];
        $this->view->title = $this->dictionary['setings'];
        $this->view->menu = $this->dictionary['menu'];
        $this->view->wallpaper = $this->dictionary['wallpaper'];
        $this->view->printer = $this->dictionary['printer'];
        $this->view->validate_devices = $this->dictionary['validate_devices'];
        $this->view->language = $this->dictionary['language'];
        $this->view->help = $this->dictionary['help'];
        $this->view->statistics = $this->dictionary['statistics'];
        $this->view->logout = $this->dictionary['logout'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function makeMenu() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        $this->view->arrMenu = $this->user->getMenu($this->user->name);

        /* set all variables for tamplates */
        $this->view->language = $this->user->language;
        $this->view->title = $this->dictionary['menu'];
        $this->view->save = $this->dictionary['save'];
        $this->view->back = $this->dictionary['back'];
        $this->view->new_page = $this->dictionary['new_page'];
        $this->view->kitchen = $this->dictionary['kitchen'];
        $this->view->bar = $this->dictionary['bar'];
        $this->view->placeholder_item = $this->dictionary['placeholder-item'];
        $this->view->placeholder_cost = $this->dictionary['placeholder-cost'];
        $this->view->btn_item = $this->dictionary['btn-item'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/menu/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/menu/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/menu/scripts');
        $this->view->appendToLayouts('footer', 'setings-templates/menu/footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function makeWallpaper() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        $artist = new Artist();
        $this->view->msg = $this->dictionary['upload-image'];
        $session_id = $this->user->session_id;
        if ($this->input->hasGet(0) && $this->input->get(0) === 'back_to_default_image') {
            $artist->deleteUserImage($session_id);
            $this->user->image = 'default.png';
            $this->user->update('default.png', 'user_image', $session_id);
        } elseif ($this->input->hasPost('submit') && $_FILES['file']['name'] !== null) {
            $filename = $artist->uploadImage($session_id);
            if ($filename !== null && $filename !== false) {
                $this->view->msg = $this->dictionary['image-success'];
                $this->user->image = $filename;
                $this->user->update($filename, 'user_image', $session_id);
            } else {
                $this->view->msg = $this->dictionary['image-failed'];
            }
        }

        /* set all variables for tamplates */
        $this->view->src = "/images/uploads/" . $this->user->image;
        $this->view->title = $this->dictionary['wallpaper'];
        $this->view->back = $this->dictionary['back'];
        $this->view->upload = $this->dictionary['upload'];
        $this->view->back_to_default_image = $this->dictionary['back_to_default_image'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/wallpaper/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/wallpaper/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function makePrinter() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        if ($this->input->hasPost('save')) {
            $this->user->printer = $this->input->post('printer_name', 'trim|string');
            $this->user->printer_domain = $this->input->post('printer_domain', 'trim|string');
            /* write it in DB */
            $this->user->update([$this->user->printer, $this->user->printer_domain], ['user_printer', 'user_printer_domain'], $this->user->session_id);
            $this->view->content_for_printer = $this->dictionary['printer_success_msg'] . '<br>' . $this->dictionary['printer_domain_success_msg'];
        } else {
            $this->view->content_for_printer = $this->dictionary['content_for_printer'];
        }

        /* set all variables for tamplates */
        $this->view->type_printer_name = $this->dictionary['type_printer_name'];
        $this->view->type_printer_domain = $this->dictionary['type_printer_domain'];
        $this->view->printer_name = $this->user->printer;
        $this->view->printer_domain = $this->user->printer_domain;
        $this->view->title = $this->dictionary['printer'];
        $this->view->save = $this->dictionary['save'];
        $this->view->back = $this->dictionary['back'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/printer/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/printer/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function makeTablets() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        /* set all variables for tamplates */
        if ($this->input->hasPost('submit')) {
            $this->user->update($this->input->post('magic_code'), 'user_magic_token', $this->user->session_id);
            $this->user->magic_token = $this->input->post('magic_code');
            $this->view->msg = $this->dictionary['tablets_text_done'];
        } else {
            $this->view->msg = $this->dictionary['tablets_text'];
        }
        $this->view->title = $this->dictionary['validate_devices'];
        $this->view->back = $this->dictionary['back'];
        $this->view->magic_label = $this->dictionary['magic_label'];
        $this->view->save = $this->dictionary['save'];
        $this->view->input_value = $this->user->magic_token;

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/tablets/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/tablets/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function makeHelp() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        /* set all variables for tamplates */
        $this->view->title = $this->dictionary['help'];
        $this->view->back = $this->dictionary['back'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/help/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/help/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function makeLanguage() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        /* set all variables for tamplates */
        $this->view->language = $this->user->language;
        $this->view->choose_language = $this->dictionary['choose_language'];
        $this->view->title = $this->dictionary['language'];
        $this->view->back = $this->dictionary['back'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/language/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/language/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/language/scripts');
        $this->view->appendToLayouts('footer', 'setings-templates/language/footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function makeStatistics() {
        $this->user->getData($this->app->getSession()->getSessionId());
        $this->dictionary = $this->polyglot->setLanguage($this->user->language)->getDictionery(__FUNCTION__);

        /* set all variables for tamplates */
        $this->view->title = $this->dictionary['statistics'];
        $this->view->back = $this->dictionary['back'];

        /* set all templates to layout */
        $this->view->appendToLayouts('styles', 'setings-templates/statistics/styles');
        $this->view->appendToLayouts('header', 'header');
        $this->view->appendToLayouts('left_content', 'setings-templates/statistics/left-content');
        $this->view->appendToLayouts('right_content', 'setings-templates/statistics/right-content');
        $this->view->appendToLayouts('scripts', 'setings-templates/statistics/scripts');
        $this->view->appendToLayouts('footer', 'footer');

        /* display layout to the browser */
        $this->view->display('layouts.setings.setings');
    }

    public function logOut() {
        $this->app->getSession()->destroySession(true);
        header('Location: ' . DOMAIN);
        exit;
    }

}
