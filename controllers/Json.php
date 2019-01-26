<?php

/**
 * Description of Index
 *
 * @author Martin Nikolov
 */

namespace Optimizer\Controllers;

use MPN\DefaultController;
use Optimizer\Models\OptimizerDB;
use Optimizer\Models\Escpos\Printer;
use Optimizer\Models\Escpos\PrintConnectors\WindowsPrintConnector;
use Optimizer\Models\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Optimizer\Models\Escpos\EscposImage;
use Optimizer\Models\User;

class Json extends DefaultController {

    public function getTableNumber() {
        $tableNumber = $this->input->post(0);
        $db = new OptimizerDB();
        $this->jsonResponse($db->getHistory($tableNumber));
    }

    public function makeOrder() {
        $temporalOrder = $this->input->post("to");
        $tableNumber = $this->input->post("tn");
        $greek = $this->input->post("g");
        $db = new OptimizerDB();
        $db->putOrder($temporalOrder, $tableNumber, $greek);

        $date = $temporalOrder[0]['date'] . "\n";
        $kitchen = [];
        $bar = [];
        $kitchenImg = null;
        $barImg = null;

        foreach ($temporalOrder as $v) {
            if ($v['location'] === '1') {
                $kitchen[] = $v;
            } else if ($v['location'] === '2') {
                $bar[] = $v;
            }
        }
        $profile = DefaultCapabilityProfile::getInstance();
        $connector = new WindowsPrintConnector("EPSON TM-T88V ReceiptE4");
        $printer = new Printer($connector, $profile);
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        $info = "table " . $tableNumber . $date . "\n";
        $filename = 'images/deleteme.png';

        if (count($kitchen) !== 0) {
            $printer->text("KITCHEN\n");
            $printer->text($info);
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $kitchenImg = $this->img->colectImages($kitchen);

            foreach ($kitchen as $v) {
                $printer->text($v['quantity'] . " X " . $v['name'] . "\n");
            }

            if (is_array($kitchenImg)) {

                $lenKitchen = count($kitchenImg);

                for ($i = 0; $i < $lenKitchen; $i++) {
                    $printer->feed();
                    $printer->text($kitchenImg[$i]['quantity'] . " X " . $kitchenImg[$i]['name'] . "\n");

                    $this->img->saveImageFromString($kitchenImg[$i]['note'], $filename);
                    $this->img->resize_image($filename, 140, 140);

                    $itemNotes = EscposImage::load($filename, false);
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
                    $printer->graphics($itemNotes);
                    $printer->setJustification(Printer::JUSTIFY_LEFT);
                    unlink($filename);
                }
            }

            $printer->cut();
        }

        if (count($bar) !== 0) {
            $printer->text("BAR\n");
            $printer->text($info);
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $kitchenImg = $this->img->colectImages($bar);

            foreach ($bar as $v) {
                $printer->text($v['quantity'] . " X " . $v['name'] . "\n");
            }

            if (is_array($barImg)) {

                $lenBar = count($barImg);

                for ($i = 0; $i < $lenBar; $i++) {
                    $printer->feed();
                    $printer->text($barImg[$i]['quantity'] . " X " . $barImg[$i]['name'] . "\n");

                    $this->img->saveImageFromString($barImg[$i]['note'], $filename);
                    $this->img->resize_image($filename, 200, 200);

                    $itemNotes = EscposImage::load($filename, false);
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
                    $printer->graphics($itemNotes);
                    $printer->setJustification(Printer::JUSTIFY_LEFT);
                    unlink($filename);
                }
            }
            $printer->cut();
        }
        $printer->close();
    }

    public function makeTotal() {

        $temporalOrder = $this->input->post("to");
        $tableNumber = $this->input->post("tn");
        $greek = $this->input->post("g");
        $total = $this->input->post("t");

        $profile = DefaultCapabilityProfile::getInstance();
        $connector = new WindowsPrintConnector("EPSON TM-T88V ReceiptE4");
        $printer = new Printer($connector, $profile);
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        $db = new OptimizerDB();
        $db->putTotal($total, $greek, $tableNumber);
        $db->deleteItems($tableNumber);
        unset($db);

        if ($temporalOrder !== null && count($temporalOrder) > 0) {

            $date = $temporalOrder[0]['date'] . "\n";
            $kitchen = [];
            $bar = [];
            $kitchenImg = null;
            $barImg = null;

            foreach ($temporalOrder as $v) {
                if ($v['location'] === '1') {
                    $kitchen[] = $v;
                } else if ($v['location'] === '2') {
                    $bar[] = $v;
                }
            }

            $info = "table " . $tableNumber . $date . "\n";
            $filename = 'images/deleteme.png';

            if (count($kitchen) !== 0) {
                $printer->text("KITCHEN\n");
                $printer->text($info);
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $kitchenImg = $this->img->colectImages($kitchen);

                foreach ($kitchen as $v) {
                    $printer->text($v['quantity'] . " X " . $v['name'] . "\n");
                }

                if (is_array($kitchenImg)) {

                    $lenKitchen = count($kitchenImg);

                    for ($i = 0; $i < $lenKitchen; $i++) {
                        $printer->feed();
                        $printer->text($kitchenImg[$i]['quantity'] . " X " . $kitchenImg[$i]['name'] . "\n");

                        $this->img->saveImageFromString($kitchenImg[$i]['note'], $filename);
                        $this->img->resize_image($filename, 140, 140);

                        $itemNotes = EscposImage::load($filename, false);
                        $printer->setJustification(Printer::JUSTIFY_CENTER);
                        $printer->graphics($itemNotes);
                        $printer->setJustification(Printer::JUSTIFY_LEFT);
                        unlink($filename);
                    }
                }

                $printer->cut();
            }

            if (count($bar) !== 0) {
                $printer->text("BAR\n");
                $printer->text($info);
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $kitchenImg = colectImg($bar);

                foreach ($bar as $v) {
                    $printer->text($v['quantity'] . " X " . $v['name'] . "\n");
                }

                if (is_array($barImg)) {

                    $lenBar = count($barImg);

                    for ($i = 0; $i < $lenBar; $i++) {
                        $printer->feed();
                        $printer->text($barImg[$i]['quantity'] . " X " . $barImg[$i]['name'] . "\n");

                        $this->img->saveImageFromString($barImg[$i]['note'], $filename);
                        $this->img->resize_image($filename, 200, 200);

                        $itemNotes = EscposImage::load($filename, false);
                        $printer->setJustification(Printer::JUSTIFY_CENTER);
                        $printer->graphics($itemNotes);
                        $printer->setJustification(Printer::JUSTIFY_LEFT);
                        unlink($filename);
                    }
                }

                $printer->cut();
            }
        }

        $printCustomer = '';
        $printPefka = '';
        $date = $total[0]['date'];

        $max = 0;
        $length = count($total);
        for ($i = 0; $i < $length; $i++) {
            if ($total[$i]['currentIndex'] > $max) {
                $max = $total[$i]['currentIndex'];
            }
        }

        for ($i = 1; $i <= $max; $i++) {

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("PEFKA\n");
            $printer->text("table: " . $tableNumber . "\n");
            $printer->text("date: " . $date . "\n");
            $printer->feed();
            $printer->setJustification(Printer::JUSTIFY_LEFT);

            foreach ($total as $v) {

                if ($v['currentIndex'] === $i) {
                    $reserveSpace = mb_strlen($v['quantity'] . $v['name']);
                    $len = 33 - $reserveSpace;
                    $lineSpace = '';

                    for ($space = 0; $space < $len; $space++) {
                        $lineSpace = $lineSpace . ' ';
                    }

                    $printCustomer = $printCustomer . $v['quantity'] . " X " . $v['name'] . $lineSpace . ".....\n";
                    $printPefka = $printPefka . $v['quantity'] . " X " . $v['name'] . $lineSpace . ".....\n";
                    unset($reserveSpace, $space, $len, $lineSpace);
                }
            }
            $printer->feed();
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text($printCustomer);
            $printer->feed();
            $printer->text("TOTAL                               .....\n");
            $printer->feed();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("thanks for your visit\n");
            unset($printCustomer);
            $printer->cut();
            $printer->setJustification(Printer::JUSTIFY_LEFT);
        }

        $printer->text("PEFKA\n");
        $printer->text("table: " . $tableNumber . "\n" . " date: " . $date . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text($printPefka);
        $printer->feed();
        $printer->text("TOTAL                               .....\n");
        $printer->cut();
        $printer->close();
    }

    public function makeMenu() {
        $user = new User();
        $menu = $this->input->post(0);
        try {
            $user->setMenu($menu, $user->getData($this->app->getSession()->getSessionId())->name);
            $this->jsonResponse('success');
        } catch (Exception $exc) {
            unset($exc);
            $this->jsonResponse('failed');
        }
    }

    public function switchLanguage() {
        $this->session->message = '';
        if ($this->session->isLogget === true) {
            $user = new User();
            $user->getData($this->app->getSession()->getSessionId())->update($this->input->post(0), 'user_language', $user->session_id);
            $this->jsonResponse($user->language);
        } else {
            $this->session->language = $this->input->post(0);
            $this->jsonResponse($this->session->language);
        }
    }

}
