<?php

/**
 * Description: Take table number and manipulate history section
 *
 * @author Martin Nikolov
 */

namespace Optimizer\Models;

use MPN\DB\SimpleDB;

class OptimizerDB extends SimpleDB {

    /**
     * 
     * @param type $username
     * @return user_magic_token from DB
     */
    public function getMagicToken($username) {
        $this->queryBilder->s('user_magic_token', 'users')->w('user_name', '=');
        return $this->prepare($this->queryBilder->go(), [$username])->execute()->fetchRowAssoc()['user_magic_token'];
    }
    
    /**
     * 
     * @param type $username
     * @return user_image from DB
     */
    public function getUserImage($username) {
        $this->queryBilder->s('user_image', 'users')->w('user_name', '=');
        return $this->prepare($this->queryBilder->go(), [$username])->execute()->fetchRowAssoc()['user_image'];
    }

    /**
     * 
     * @return array()
     */
    public function getHistory($tableNumber) {

        $number_of_orders = $this->prepare("SELECT DISTINCT `current_index` FROM `ordered_items` WHERE `table_number`=? ORDER BY `current_index` DESC LIMIT 1", array($tableNumber))->execute()->fetchRowAssoc();
        $i = $number_of_orders['current_index'];
        $j = 0;
        $arr_order = array();
        while ($i > 0) {

            $construct_order = $this->prepare('SELECT * FROM `ordered_items` WHERE `table_number`=? AND `current_index`=?', array($tableNumber, $i))->execute();
            $q = 0;
            while ($fetch = $construct_order->fetchAllAssoc()) {

                $arr_order[$j][$q] = $fetch;
                $q++;
            }

            $i--;
            $j++;
        }

        return $arr_order;
    }

    /**
     * 
     * @return array()
     */
    public function getItems($user) {
        $response = [];
        $i = 1;
        $headers = $this->prepare('SELECT * FROM `headers` WHERE `user_name`=?', array($user))->execute()->fetchAllAssoc();
        foreach ($headers as $v) {
            $response[$v['page_number']]['header'] = $v['header'];
            $items = $this->prepare('SELECT * FROM `items` WHERE `page_number`=? AND `user_name`=?', array($v['page_number'], $user))->execute()->fetchAllAssoc();
            foreach ($items as $v2) {
                $response[$i]['items'][] = $v2;
            }
            $i++;
        }
        return $response;
    }

    public function deleteItems($numTable) {

        $this->prepare('DELETE FROM `ordered_items` WHERE `table_number`=?', array($numTable))->execute();
    }

    public function putOrder($post1, $post2, $post3) {

        $length = count($post1);
        for ($i = 0; $i < $length; $i++) {
            $this->prepare('INSERT INTO `ordered_items` (`current_index`,`name`,`price`,`quantity`,`note`,`type`,`table_number`,`greek`,`date`) VALUES (?,?,?,?,?,?,?,?,?)', array(
                $post1[$i]['currentIndex'],
                $post1[$i]['name'],
                $post1[$i]['prize'],
                $post1[$i]['quantity'],
                $post1[$i]['note'],
                $post1[$i]['location'],
                $post2,
                $post3,
                $post1[$i]['date']
            ))->execute();
        }
    }

    public function putTotal($total, $greek, $numTable) {

        foreach ($total as $v) {
            $this->prepare('INSERT INTO `history` (`current_index`,`name, price`,`quantity`,`note`,`type`,`table_number`,`greek`,`date`) VALUES(?,?,?,?,?,?,?,?,?)', array(
                $v['currentIndex'],
                $v['name'],
                $v['prize'],
                $v['quantity'],
                $v['note'],
                $v['location'],
                $numTable,
                $greek,
                $v['date']))->execute();
        }
    }

}
