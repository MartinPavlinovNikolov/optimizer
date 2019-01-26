<?php

namespace Optimizer\Models\Languages;
use Optimizer\Models\Languages\ILanguage;
use Exception;

/**
 * Description: navigate between languages.
 * every language is a dictionary array-like
 *
 * @author Martin Nikolov
 */
class Polyglot {

    private $_language = null;

    public function __construct() {
        
    }

    /**
     * 
     * Description: set current language like a String 
     * 
     * @param type $language
     */
    public function setLanguage($language) {
        $this->_language = '\\Optimizer\\Models\\Languages\\' . strtoupper($language);
        return $this;
    }

    /**
     * 
     * @return array with words
     */
    public function getDictionery($method) {
        if ($this->_language === null) {
            throw new Exception('Set language first!', 500);
        }
        if ($method == null) {
            throw new Exception('Param "method" requaered!', 500);
        } else {
            $method .= 'Dictionary';
        }
        $language = new $this->_language();
        if (!$language instanceof ILanguage) {
            throw new Exception('Your class must implemets ILanguage interface', 505);
        }
        $dictionary = $language->$method();
        return $dictionary;
    }

}
