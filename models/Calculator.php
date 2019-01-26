<?php

namespace Optimizer\Models;

/**
 * Description: class for Math methods
 *
 * @author Martin Nikolov
 */
class Calculator {
    
    public $result = 0;


    public function __construct() {
        
    }
    
    public function add($x, $y) {
        $this->result = ($x + $y);
        return $this;
    }
    
    public function substract($x, $y) {
        $this->result = ($x - $y);
        return $this;
    }
    
    public function multiply($x, $y) {
        $this->result = ($x * $y);
        return $this;
    }
    
    public function devide($x, $y) {
        $this->result = ($x / $y);
        return $this;
    }
    
    public function result() {
        return $this->result;
    }
}
