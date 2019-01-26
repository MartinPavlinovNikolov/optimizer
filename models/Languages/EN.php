<?php

namespace Optimizer\Models\Languages;

/**
 * Description: EN dictionary
 *
 * @author Martin Nikolov
 */
class EN implements ILanguage {

    public function welcomeDictionary() {
        $config['session_message'] = 'Welcome';
        return $config;
    }

    public function isLoggetDictionary() {
        $config['short_name'] = 'name is too short';
        $config['short_pass'] = 'password is too short';
        $config['session_message'] = 'Welcome';
        $config['error_login_wrong_name_or_password'] = 'wrong username or password !';

        return $config;
    }

    public function isRegisteredDictionary() {
        $config['short_name'] = 'Name is too short';
        $config['short_pass'] = 'Password is too short';
        $config['empty_printer'] = 'forget to enter printer name';
        $config['empty_domain'] = 'forget to enter printer domain';
        $config['error_register_user_exist'] = 'This user already exist';
        $config['session_message'] = 'Welcome';

        return $config;
    }

    public function makeHelpDictionary() {
        $config['help'] = 'Help';
        $config['back'] = 'Back';

        return $config;
    }

    public function makeLanguageDictionary() {
        $config['choose_language'] = 'Choose language';
        $config['language'] = 'Language';
        $config['back'] = 'Back';

        return $config;
    }

    public function makeLoginFormDictionary() {
        $config['login'] = 'Login';
        $config['name'] = 'Name';
        $config['min'] = 'Minimum';
        $config['password'] = 'Password';
        $config['characters'] = 'characters';
        $config['new_registration'] = 'New register';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Choose language';

        return $config;
    }

    public function makeMenuDictionary() {
        $config['menu'] = 'Menu';
        $config['save'] = 'Save';
        $config['back'] = 'Back';
        $config['new_page'] = 'New<br>page';
        $config['kitchen'] = 'kitchen';
        $config['bar'] = 'bar';
        $config['placeholder-header'] = 'HEADER';
        $config['placeholder-item'] = 'name of this item';
        $config['placeholder-cost'] = 'cost';
        $config['btn-item'] = 'ITEM';

        return $config;
    }

    public function makePrinterDictionary() {
        $config['printer_success_msg'] = 'Saving printer name is successful';
        $config['printer_domain_success_msg'] = 'Saving domain is successful';
        $config['content_for_printer'] = 'Please, before go foreyard, make sure that you have connected your printer, whether you are a named it and make it visible in your operating system.<br>Also you must have valid domain for the printer.';
        $config['type_printer_name'] = 'Type your new printer name:';
        $config['type_printer_domain'] = 'Type your new domain:';
        $config['printer'] = 'Printer';
        $config['save'] = 'Save';
        $config['back'] = 'Back';

        return $config;
    }

    public function makeRegisterFormDictionary() {
        $config['register'] = 'Register';
        $config['name'] = 'Name';
        $config['min'] = 'Minimum';
        $config['password'] = 'Password';
        $config['characters'] = 'characters';
        $config['back_to_login'] = 'Back to login';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Choose language';
        $config['note_printer'] = 'note: your printer must be visible and must have name!<br>Make shooar to have valid domain!';
        $config['note_printer2'] = 'If this steps are done, please continue';
        $config['printer'] = 'Printer';
        $config['domain'] = 'domain';

        return $config;
    }

    public function makeSetingsDictionary() {
        $config['back_from_menu_no_save'] = 'Choose settings';
        $config['back_from_menu'] = 'your menu is ready for work <br> in your devices';
        $config[''] = '';
        $config['setings'] = 'Settings';
        $config['menu'] = 'Menu';
        $config['wallpaper'] = 'Wallpaper';
        $config['printer'] = 'Printer';
        $config['validate_devices'] = 'Tablets';
        $config['language'] = 'Language';
        $config['help'] = 'Help';
        $config['statistics'] = 'Statistics';
        $config['logout'] = 'Exit';

        return $config;
    }

    public function makeStatisticsDictionary() {
        $config['statistics'] = 'Statistics';
        $config['back'] = 'Back';

        return $config;
    }

    public function makeTabletsDictionary() {
        $config['tablets_text_done'] = 'Your magic-cod is successful saved.';
        $config['tablets_text'] = 'With this code, your tablets will access the application.';
        $config['validate_devices'] = 'Tablets';
        $config['back'] = 'Back';
        $config['magic_label'] = 'Set your magic-code';
        $config['save'] = 'Save';

        return $config;
    }

    public function makeWallpaperDictionary() {
        $config['upload-image'] = 'Choose some image file from your file-system <br> for background on yours devices';
        $config['image-success'] = 'Uploading was successful';
        $config['image-failed'] = 'Something went wrong, please try again!';
        $config['wallpaper'] = 'Wallpaper';
        $config['back'] = 'Back';
        $config['upload'] = 'UPLOAD';
        $config['back_to_default_image'] = 'Set default image';

        return $config;
    }

    public function notYetDictionary() {
        $config['login'] = 'Login';
        $config['name'] = 'Name';
        $config['min'] = 'Minimum';
        $config['password'] = 'Password';
        $config['characters'] = 'characters';
        $config['new_registration'] = 'New register';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Choose language';

        return $config;
    }

    public function registerErrorDictionary() {
        $config['register'] = 'Register';
        $config['name'] = 'Name';
        $config['min'] = 'Minimum';
        $config['password'] = 'Password';
        $config['characters'] = 'characters';
        $config['back_to_login'] = 'Back to login';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Choose language';
        $config['note_printer'] = 'note: your printer must be visible and must have name!<br>Make shooar to have valid domain!';
        $config['note_printer2'] = 'If this steps are done, please continue';
        $config['printer'] = 'Printer';
        $config['domain'] = 'domain';

        return $config;
    }

}
