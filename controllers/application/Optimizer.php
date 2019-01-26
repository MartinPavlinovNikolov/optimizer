<?php

namespace Optimizer\Controllers\Application;

use MPN\DefaultController;
use Optimizer\Models\OptimizerDB;

/**
 * Description: controller for tablets
 *
 * @author Martin Nikolov
 */
class Optimizer extends DefaultController {

    public function makeKeyboard() {
        $db = new OptimizerDB();

        if ($this->session->tabletIsLogget === true) {

            $this->view->title = 'company name';
            $this->view->bgimg = '/images/uploads/' . $db->getUserImage($this->session->user_name);
            $this->view->arrMenu = $db->getItems($this->session->user_name);

            $this->view->appendToLayouts('styles', 'optimizer-templates/styles');
            $this->view->appendToLayouts('header', 'optimizer-templates/header');
            $this->view->appendToLayouts('slider', 'optimizer-templates/slider');
            $this->view->appendToLayouts('canvas', 'optimizer-templates/canvas');
            $this->view->appendToLayouts('corections', 'optimizer-templates/corections');
            $this->view->appendToLayouts('history', 'optimizer-templates/history');
            $this->view->appendToLayouts('mainButtons', 'optimizer-templates/work-page');
            $this->view->appendToLayouts('screen', 'optimizer-templates/screen');
            $this->view->appendToLayouts('senders', 'optimizer-templates/senders');
            $this->view->appendToLayouts('scripts', 'optimizer-templates/scripts');
            $this->view->appendToLayouts('footer', 'optimizer-templates/footer');

            $this->view->display('layouts.application.optimizer');
            exit;
        }

        if ($this->input->hasPost('submit') && count($this->input->post('magic_token')) > 0 && count($this->input->post('user_name')) > 0) {

            $magicToken = $db->getMagicToken($this->input->post('user_name'));

            if ($magicToken === $this->input->post('magic_token')) {
                $this->session->tabletIsLogget = true;
                $this->session->user_name = $this->input->post('user_name');
                header('Location: http://optimizer.com/application/optimizer/make-keyboard');
                exit;
            } else {
                $this->view->msg = 'wrong user name or magic token!';
                $this->view->label1 = 'user name:';
                $this->view->label2 = 'magic token:';

                $this->view->appendToLayouts('styles', 'optimizer-templates/tablet_form_styles');
                $this->view->appendToLayouts('header', 'optimizer-templates/header');
                $this->view->appendToLayouts('form', 'optimizer-templates/tablet_form');
                $this->view->appendToLayouts('footer', 'footer');

                $this->view->display('layouts.application.tablet_form_layout');
                exit;
            }
        }

        $this->view->label1 = 'user name:';
        $this->view->label2 = 'magic token:';

        $this->view->appendToLayouts('styles', 'optimizer-templates/tablet_form_styles');
        $this->view->appendToLayouts('header', 'optimizer-templates/header');
        $this->view->appendToLayouts('form', 'optimizer-templates/tablet_form');
        $this->view->appendToLayouts('footer', 'footer');

        $this->view->display('layouts.application.tablet_form_layout');
    }

}
