<?php

namespace Optimizer\Models\Languages;

/**
 *
 * @author Martin Nikolov
 */
interface ILanguage {

    public function welcomeDictionary();
    public function makeLoginFormDictionary();
    public function isLoggetDictionary();
    public function notYetDictionary();
    public function makeRegisterFormDictionary();
    public function isRegisteredDictionary();
    public function registerErrorDictionary();
    public function makeSetingsDictionary();
    public function makeMenuDictionary();
    public function makeWallpaperDictionary();
    public function makePrinterDictionary();
    public function makeTabletsDictionary();
    public function makeLanguageDictionary();
    public function makeStatisticsDictionary();
    public function makeHelpDictionary();
}
