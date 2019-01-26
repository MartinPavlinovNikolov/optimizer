<?php

namespace Optimizer\Models\Languages;

/**
 * Description: BG dictionary
 *
 * @author Martin Nikolov
 */
class BG implements ILanguage {

    public function welcomeDictionary() {
        $config['session_message'] = 'Добре дошли';
        return $config;
    }

    public function isLoggetDictionary() {
        $config['short_name'] = 'Името е прекалено късо';
        $config['short_pass'] = 'Паролата е ненадеждна, нека бъде поне 8 символа';
        $config['session_message'] = 'Добре дошли';
        $config['error_login_wrong_name_or_password'] = 'Грешно име или парола !';

        return $config;
    }

    public function isRegisteredDictionary() {
        $config['short_name'] = 'Името е прекалено късо';
        $config['short_pass'] = 'Паролата е ненадеждна, нека бъде поне 8 символа';
        $config['empty_printer'] = 'Забравихте да въведете името на принтерът си';
        $config['empty_domain'] = 'Забравихте да въведете домейнът си';
        $config['error_register_user_exist'] = 'Вече съществува потребител с такова име';
        $config['session_message'] = 'Добре дошли';

        return $config;
    }

    public function makeHelpDictionary() {
        $config['help'] = 'Помощ';
        $config['back'] = 'Назад';

        return $config;
    }

    public function makeLanguageDictionary() {
        $config['choose_language'] = 'Моля, изберете език';
        $config['language'] = 'Език';
        $config['back'] = 'Назад';

        return $config;
    }

    public function makeLoginFormDictionary() {
        $config['login'] = 'Вписване';
        $config['name'] = 'Име';
        $config['min'] = 'Минимум';
        $config['password'] = 'Парола';
        $config['characters'] = 'символа';
        $config['new_registration'] = 'Регистрирай се';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Изберете език';

        return $config;
    }

    public function makeMenuDictionary() {
        $config['menu'] = 'Меню';
        $config['save'] = 'Запази';
        $config['back'] = 'Назад';
        $config['new_page'] = 'Нова<br>страница';
        $config['kitchen'] = 'кухня';
        $config['bar'] = 'бар';
        $config['placeholder-header'] = 'ЗАГЛАВИЕ';
        $config['placeholder-item'] = 'име на артикул';
        $config['placeholder-cost'] = 'цена';
        $config['btn-item'] = 'АРТИКУЛ';

        return $config;
    }

    public function makePrinterDictionary() {
        $config['printer_success_msg'] = 'Името на принтера е записано успешно.';
        $config['printer_domain_success_msg'] = 'Новият домейн е записан успешно.';
        $config['content_for_printer'] = 'Моля преди да продължите се уверете , че сте свързали вашият принтер, дали сте му име и е видим в операционната Ви система.<br>Също така, трябва да имате и валиден домейн!';
        $config['type_printer_name'] = 'Въведете новото име на принтера:';
        $config['type_printer_domain'] = 'Въведете новият домейн за принтера:';
        $config['printer'] = 'Принтер';
        $config['save'] = 'Запази';
        $config['back'] = 'Назад';

        return $config;
    }

    public function makeRegisterFormDictionary() {
        $config['register'] = 'Регистрация';
        $config['name'] = 'Име';
        $config['min'] = 'Минимум';
        $config['password'] = 'Парола';
        $config['characters'] = 'символа';
        $config['back_to_login'] = 'Обратно към вписване';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Изберете език';
        $config['note_printer'] = 'Внимание: принтера трябва да е видим и трябва да има име!<br>Уверете се, че имате и валиден домейн!';
        $config['note_printer2'] = 'ако тези стъпки са направени, моля продължете';
        $config['printer'] = 'Принтер';
        $config['domain'] = 'домейн';

        return $config;
    }

    public function makeSetingsDictionary() {
        $config['back_from_menu_no_save'] = 'Изберете настройка';
        $config['back_from_menu'] = 'Менюто Ви е заредено <br> в устроиствата за работа';
        $config['setings'] = 'Настройки';
        $config['menu'] = 'Меню';
        $config['wallpaper'] = 'Тапет';
        $config['printer'] = 'Принтер';
        $config['validate_devices'] = 'Таблети';
        $config['language'] = 'Език';
        $config['help'] = 'Помощ';
        $config['statistics'] = 'Статистики';
        $config['logout'] = 'Изход';

        return $config;
    }

    public function makeStatisticsDictionary() {
        $config['statistics'] = 'Статистики';
        $config['back'] = 'Назад';

        return $config;
    }

    public function makeTabletsDictionary() {
        $config['tablets_text_done'] = 'Магическият Ви код е успешно записан.';
        $config['tablets_text'] = 'С кодът който ще въведете, таблетите ще могат да достъпват приложението.';
        $config['validate_devices'] = 'Таблети';
        $config['back'] = 'Назад';
        $config['magic_label'] = 'Запишете си магическият код';
        $config['save'] = 'Запази';

        return $config;
    }

    public function makeWallpaperDictionary() {
        $config['upload-image'] = 'Изберете изображение от фаиловата Ви система, <br> за тапет на мобилните Ви устройства';
        $config['image-success'] = 'Изображението е качено успешно';
        $config['image-failed'] = 'Нещо се обърка.Моля, опитайте отново.';
        $config['wallpaper'] = 'Тапет';
        $config['back'] = 'Назад';
        $config['upload'] = 'Качи изображението';
        $config['back_to_default_image'] = 'Задай изображението по подразбиране';

        return $config;
    }

    public function notYetDictionary() {
        $config['login'] = 'Вписване';
        $config['name'] = 'Име';
        $config['min'] = 'Минимум';
        $config['password'] = 'Парола';
        $config['characters'] = 'символа';
        $config['new_registration'] = 'Регистрирай се';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Изберете език';

        return $config;
    }

    public function registerErrorDictionary() {
        $config['register'] = 'Регистрация';
        $config['name'] = 'Име';
        $config['min'] = 'Минимум';
        $config['password'] = 'Парола';
        $config['characters'] = 'символа';
        $config['back_to_login'] = 'Обратно към вписване';
        $config['glyphicon_log_in'] = 'glyphicon-log-in';
        $config['glyphicon_plus'] = 'glyphicon-plus';
        $config['btn_primary'] = 'btn-primary';
        $config['btn_success'] = 'btn-success';
        $config['choose_language'] = 'Изберете език';
        $config['note_printer'] = 'Внимание: принтера трябва да е видим и трябва да има име!<br>Уверете се, че имате и валиден домейн!';
        $config['note_printer2'] = 'ако тези стъпки са направени, моля продължете';
        $config['printer'] = 'Принтер';
        $config['domain'] = 'домейн';

        return $config;
    }

}
