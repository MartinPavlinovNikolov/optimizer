<?php

namespace Optimizer\Models;

use MPN\DB\SimpleDB;
use Exception;

/**
 * @Description: manage all property of of the client
 *
 * @author Martin Nikolov
 */
class User extends SimpleDB {

    public $session_id = null;
    public $name = null;
    public $printer = null;
    public $image = null;
    public $printer_domain = null;
    public $magic_token = null;
    public $language = null;

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return array()
     */
    public function getMenu($username) {
        $response = [];
        $i = 1;
        $headers = $this->prepare($this->queryBilder->s('*', 'headers')->w('user_name', '=')->go(), array($username))->execute()->fetchAllAssoc();
        foreach ($headers as $v) {
            $response[$v['page_number']]['header'] = $v['header'];
            $items = $this->prepare($this->queryBilder->s('*', 'items')->w(['page_number', 'user_name'], ['=', '='], '&&')->go(), array((int) $v['page_number'], $username))->execute()->fetchAllAssoc();
            foreach ($items as $v2) {
                $response[$i]['items'][] = $v2;
            }
            $i++;
        }
        return $response;
    }

    /**
     * @Description: take all information about the user
     * @return Object
     */
    public function getData($session_id) {
        $obj = $this->prepare($this->queryBilder->s('*', 'users')->w('user_session_id', '=')->go(), [$session_id])->execute()->fetchRowObj();
        $this->session_id = $obj->user_session_id;
        $this->name = $obj->user_name;
        $this->printer = $obj->user_printer;
        $this->printer_domain = $obj->user_printer_domain;
        $this->image = $obj->user_image;
        $this->magic_token = $obj->user_magic_token;
        $this->language = $obj->user_language;

        return $this;
    }

    /**
     * @Description: check username and/or password when user try to make register/login
     * @return true if user exist
     */
    public function isExist($user, $pass = null) {
        if ($pass === null) {
            if ($this->prepare($this->queryBilder->s('user_name', 'users')->w('user_name', '=')->go(), array($user))->execute()->fetchRowAssoc()) {
                return true;
            }
            return false;
        } else {
            if ($this->prepare($this->queryBilder->s('user_name', 'users')->w('user_name', '=')->go(), array($user))->execute()->fetchRowAssoc()) {
                $hash = $this->prepare($this->queryBilder->s('user_password', 'users')->w('user_name', '=')->go(), array($user))->execute()->fetchRowAssoc()['user_password'];
                return password_verify($pass, $hash);
            } else {
                return false;
            }
        }
    }

    /**
     * @Description: use when is possible for the user to be register
     * @return user-id from DB
     */
    public function register($array) {
        $this->prepare($this->queryBilder->i('users', ['user_session_id', 'user_name', 'user_password', 'user_printer', 'user_language', 'user_printer_domain', 'user_image'])->go(), $array)->execute();

        return $this;
    }

    /**
     * 
     * Description: For multiple columns update: give parameters like array;
     *              For single column update: give one parameter;
     * 
     * @param string $newValue 
     * @param string $columnName
     * @param String $session_id
     * @throws Exception
     */
    public function update($newValue, $columnName, $session_id) {
        if (is_array($newValue) && is_array($columnName)) {
            array_push($newValue, $session_id);
            $this->prepare($this->queryBilder->u('users', $columnName)->w('user_session_id', '=')->go(), $newValue)->execute();
        } elseif (is_string($newValue) && is_string($columnName)) {
            $this->prepare($this->queryBilder->u('users', $columnName)->w('user_session_id', '=')->go(), array($newValue, $session_id))->execute();
        } else {
            throw new Exception('Invalid arguments for update()!', 500);
        }
    }

    public function setMenu($menu, $username) {
        $len = count($menu);
        $this->prepare($this->queryBilder->delete('headers')->w('user_name', '=')->go(), [$username])->execute();
        $this->prepare($this->queryBilder->delete('items')->w('user_name', '=')->go(), [$username])->execute();
        for ($i = 0; $i < $len; $i++) {
            $header = $menu[$i]['header'];
            $page = ($i + 1);
            $this->prepare($this->queryBilder->i('headers', ['header', 'page_number', 'user_name'])->go(), [$header, $page, $username])->execute();
            $len2 = count($menu[$i]['items']);
            $this->prepare($this->queryBilder->i('items', ['name', 'type', 'page_number', 'price', 'user_name'])->go());
            for ($i2 = 0; $i2 < $len2; $i2++) {

                $name = $menu[$i]['items'][$i2]['name'];
                $type = $menu[$i]['items'][$i2]['type'];

                $price = $menu[$i]['items'][$i2]['price'];
                $this->execute(array($name, $type, $page, $price, $username));
            }
        }
    }

    public function sincSessionId($id, $name) {
        $_id = $this->prepare($this->queryBilder->s('user_session_id', 'users')->w('user_name', '=')->go(), [$name])->execute()->fetchRowAssoc()['user_session_id'];
        if ($_id != $id) {
            $this->prepare($this->queryBilder->u('users', 'user_session_id')->w('user_name', '=')->go(), [$id, $name])->execute();
        }
    }

}
