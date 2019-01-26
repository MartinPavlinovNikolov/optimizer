jQuery(document).ready(function ($) {

    const URL = 'http://optimizer.com/json-rpc.php';
    let lang = $('#lang').attr('data-lang');
    let dictionery = {
        'en': {
            'btnItem': 'ITEM',
            'placeholderHeader': 'HEADER',
            'placeholderName': 'name of this item',
            'placeholderCost': 'cost',
            'kitchen': 'kitchen',
            'bar': 'bar',
            'menu': 'Menu',
            'setings': 'Settings',
            'msg': 'SAVE DONE',
            'msgerr': 'SOMETHING WENT WRONG, SAVEING FAIL'
        },
        'bg': {
            'btnItem': 'АРТИКУЛ',
            'placeholderHeader': 'ЗАГЛАВИЕ',
            'placeholderName': 'име на артикул',
            'placeholderCost': 'цена',
            'kitchen': 'кухня',
            'bar': 'бар',
            'menu': 'Меню',
            'setings': 'Настройки',
            'msg': 'Менюто е успешно записано',
            'msgerr': 'нещо се обърка, неуспешен запис'
        }
    };
    let counter = {
        i: $('.btn-page-number').length
    };

    /**
     * description: show view for success or fail and give a option for another modificatin and exit from the app
     * 
     * @returns {undefined}
     */
    function afterSaving(responce) {
        let msg;
        if(responce === 'success'){
            msg = 'msg';
        }else{
            msg = 'msgerr';
        }
        $('.left-panel').html('<h1 class="text-success text-center">' + dictionery[lang][msg] + '</h1>');
        $('.right-panel').html('<a class="glyphicon glyphicon-cutlery btn btn-success btn-tall col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-6" href="http://optimizer.com/controlpanel/make-menu"> ' + dictionery[lang]['menu'] + '</a><a class="glyphicon glyphicon-cog btn btn-success btn-tall col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-6" href="http://optimizer.com/controlpanel/make-setings/back_from_menu"> ' + dictionery[lang]['setings'] + '</a>');
    }

    /**
     * description: if button for type is pressed it changes the state of the button
     * 
     * @param that (jQuery object-button)
     * @returns {undefined}
     */
    function fixLocation(that) {
        let val = $(that).text();
        if (val === dictionery[lang]['kitchen']) {
            $(that).attr('data-item-type', '2');
            $(that).text(dictionery[lang]['bar']);
        } else {
            $(that).attr('data-item-type', '1');
            $(that).text(dictionery[lang]['kitchen']);
        }
    }

    /**
     * description: delete the main panel of the pressed button with all things inside it
     * 
     * @param that (jQuery object-button)
     * @returns {undefined}
     */
    function deletePage(that) {
        removeEvents();
        $(that.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement).remove();
        counter.i--;
        atachEvents();
    }

    /**
     * description: delete the current item in panel of the pressed button
     * 
     * @param that (jQuery object-button)
     * @returns {undefined}
     */
    function deleteItem(that) {
        removeEvents();
        $(that.parentElement.parentElement.parentElement.parentElement).remove();
        atachEvents();
    }

    /**
     * description: add new item in the panel of the pressed button
     * 
     * @param that (jQuery object-button)
     * @param iterator (global object that hold a number)
     * @returns {undefined}
     */
    function addNewItem(that, iterator) {
        removeEvents();
        $(that.parentElement.parentElement).before('<div class="row"><div class="col-md-12"><div class="row custom-panel"><div class = "col-md-1 btn-items-right text-center"><span class="lead glyphicon glyphicon-pencil"></span></div><div class = "col-md-4 btn-items-left"><input data-item-name-page-number="' + iterator + '" class = "form-control text-center" type = "text" placeholder = "' + dictionery[lang]['placeholderName'] + '"></div><div class = "col-md-1 text-right btn-items-right"><span class="lead glyphicon glyphicon-eur"></span></div><div class = "col-md-2 btn-items-left"><input data-item-price-page-number="' + iterator + '" class = "form-control text-center" type = "number" placeholder = "' + dictionery[lang]['placeholderCost'] + '"></div><div class = "col-md-1 text-right btn-items-right"><span class="lead glyphicon glyphicon-refresh"></span></div><div class = "col-md-2 btn-items-left"><button data-item-type-page-number="' + iterator + '" data-item-type="1" class = "btn btn-info">' + dictionery[lang]['kitchen'] + '</button></div><div class = "col-md-1"><button tabindex="-1" class = "btn btn-danger btn-sm delete-this-item">X</button></div></div></div></div>');
        atachEvents();
    }

    /**
     * description: add new page-panel in main-container div
     * 
     * @param iterator (global object that hold a number)
     * @returns {undefined}
     */
    function addNewPage(iterator) {
        removeEvents();
        $('#main-container').append('<div class = "row"><div class="col-md-12"><div class="row current-page"><div class = "col-md-12"><div class = "row"><div class = "col-md-2"><input class="form-control btn-page-number text-center" data-page-number="' + iterator + '" type="number" value="' + iterator + '"></div><div class="col-md-6 col-md-offset-1"><div class="row custom-panel"><div class = "col-md-2 btn-items-right text-center"><span class="lead glyphicon glyphicon-pencil"></span></div><div class = "col-md-7 col-md-offset-1 btn-items-left"><input class="form-control text-center" data-header-page-number="' + iterator + '" class = "header-name unit" type = "text" placeholder = "' + dictionery[lang]['placeholderHeader'] + '"></div><div class = "col-md-1"><button tabindex="-1" class="btn btn-danger btn-sm delete-this-page">X</button></div></div></div></div><div class = "row"><div class = "col-md-2 col-md-offset-9"><button class = "btn btn-success add-new-item glyphicon glyphicon-plus"> ' + dictionery[lang]['btnItem'] + '</button></div></div></div></div></div></div>');
        atachEvents();
        counter.i++;
    }

    /**
     * description: construct menu-object and send ajax request via JSON-RPC to php7 apache2 server
     * 
     * @returns {undefined}
     */
    function save() {
        removeEvents();
        atachEvents();
        let menu = {},
                header,
                i,
                j,
                len = $('input[data-page-number]').length;
        for (i = 0; i < len; i++) {
            header = $('[data-header-page-number="' + (i + 1) + '"]');
            menu[i] = {};
            menu[i].items = {};
            menu[i].header = header.val() + '';
            let count = $('[data-item-name-page-number="' + (i + 1) + '"]').length;

            for (j = 0; j < count; j++) {
                menu[i].items[j] = {};
                let name = $('[data-item-name-page-number="' + (i + 1) + '"]')[j];
                let price = $('[data-item-price-page-number="' + (i + 1) + '"]')[j];
                let type = $('[data-item-type-page-number="' + (i + 1) + '"]')[j];
                menu[i].items[j].name = name.value + '';
                menu[i].items[j].price = price.value + '';
                menu[i].items[j].type = $(type).attr('data-item-type') + '';
            }
        }
        let request = {
            jsonrpc: '2.0',
            method: 'make-menu',
            params: [menu],
            id: 4
        };
        $.ajax({
            url: URL,
            type: 'POST',
            data: JSON.stringify(request),
            dataType: 'json',
            headers: {
                'Content-Type': 'application/json'
            }
        }).done(function (responce) {
            afterSaving(responce);
        });
    }

    /**
     * description: atach few events-listeners to the document.body
     * events: fixLocation(), save(), addNewPage(), addNewItem(), deletePage() and deleteItem()
     * 
     * 
     * @returns {undefined}
     */
    function atachEvents() {
        $(document.body).on('click', '.btn-info', function (e) {
            fixLocation(e.target);
        });
        $(document.body).on('click', '#save', function () {
            removeEvents();
            atachEvents();
            save();
        });
        $(document.body).on('click', '#addNewPage', function () {
            addNewPage(counter.i + 1);
        });
        $(document.body).on('click', '.add-new-item', function (e) {
            let pn = $(e.target.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.lastElementChild).val();
            addNewItem(e.target, pn);
        });
        $(document.body).on('click', '.delete-this-page', function (e) {
            deletePage(e.target);
        });
        $(document.body).on('click', '.delete-this-item', function (e) {
            deleteItem(e.target);
        });
    }

    /**
     * description: remove all events-listeners of the document.body
     * 
     * @returns {undefined}
     */
    function removeEvents() {
        $(document.body).off();
    }

    atachEvents();
});