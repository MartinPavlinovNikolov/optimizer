jQuery(document).ready(function ($) {

    /* time stamp */
    const currentTime = (function () {
        return new Date().getTime();
    })();
    /**
     * 
     * @type object with array
     */
    const Order = {
        mainOrder: {
            history: []
        },
        temporalOrder: [],
        temporalOrderProxy: [],
        temporalOrderProxyStorigeRest: [],
        corectionMemory: [],
        corectionMemoryProxyStorigeRest: [],
        loadCorectionProxys: function () {
            this.temporalOrderProxy = this.temporalOrder.filter(x => {
                return (x.currentIndex === TableNumber.currentIndex.value);
            });
            this.temporalOrderProxyStorigeRest = this.temporalOrder.filter(x => {
                return (x.currentIndex !== TableNumber.currentIndex.value);
            });
        },
        initializeEmptyMemory: function () {
            this.corectionMemory.push({
                name: 'empty',
                price: 'empty',
                quantity: 'empty',
                location: 'empty',
                note: 'empty',
                date: 'empty',
                currentIndex: 'empty',
                userName: 'empty'
            });
        }
    };
    /**
     * flags
     * @type object
     */
    const KeyboardNumbers = {
        one: false,
        two: false
    };
    /**
     * object to hold table numbers to display
     * @type type object
     */
    const TableNumber = {
        firstParam: 0,
        secondParam: 0,
        display: 0,
        intiger: 0,
        currentIndex: {
            value: null
        },
        currentIndexStorige: [],
        format: function () {
            TableNumber.furstParam = $('#table-1').text();
            TableNumber.secondParam = $('#table-2').text();
            TableNumber.display = TableNumber.furstParam + TableNumber.secondParam;
            TableNumber.intiger = (TableNumber.furstParam + TableNumber.secondParam) | 0;
            if (TableNumber.display.length < 2) {
                TableNumber.display = '0' + TableNumber.display;
            }
        }
    };
    /**
     * manipulate request for json-rpc
     * @type type
     */
    const Request = {
        request: {
            jsonrpc: "2.0",
            method: "",
            params: [TableNumber.intiger],
            id: 1
        },
        setParams: function (method, id) {
            this.request.method = method;
            this.request.id = id;
        },
        URL: 'http://optimizer.com/json-rpc.php'
    };
    /**
     * canvas object for drawing notes with finger
     * @type type
     */
    const Canvas = {
        instance: null,
        ctx: null,
        touchPosition: {
            x: 0,
            y: 0
        },
        fingerDown: false,
        target: null,
        targetValue: null,
        draw: function (a, b, e) {
            this.touchPosition.x = e.originalEvent.touches[0].pageX;
            this.touchPosition.y = e.originalEvent.touches[0].pageY;
            if (this.fingerDown) {
                this.ctx.beginPath();
                this.ctx.moveTo(a - 28, b - 30);
                this.ctx.arc(a - 28, b - 30, 25, 0, 360 * Math.PI / 180);
                this.ctx.fill();
                this.ctx.stroke();
            }
        }
    };
    /**
     * bug fixing in bootstrap.js mising swipe events! 
     * @returns {undefined}
     */
    function custumizeSlider() {
        $('.carousel').carousel({
            interval: false
        });
        $('#page-menu0').addClass('active');
        $('.carousel').on('touchstart', function (event) {
            let xClick = event.originalEvent.touches[0].pageX;
            $(this).one('touchmove', function (event) {
                let xMove = event.originalEvent.touches[0].pageX;
                if (Math.floor(xClick - xMove) > 5) {
                    $('.carousel').carousel('next');
                } else if (Math.floor(xClick - xMove) < -5) {
                    $('.carousel').carousel('prev');
                }
                $('.carousel').on('touchend', function () {
                    $(this).off('touchmove');
                });
            });
        });
    }

    /**
     * description: left arrow for more then one order in current table
     * 
     * @returns {undefined}
     */
    function left() {
        if ($('#left-arrow').hasClass('btn-info')) {
            if (Order.temporalOrder.length > 0) {
                $('#drow-note').addClass('btn-info');
                $('#corection').addClass('btn-info');
                $('#history').addClass('btn-info');
                $('#send-order').addClass('btn-info');
                $('#send-total').addClass('btn-info');
                $('.yes-button-hidden').removeClass('hidden-xs hidden-sm');
            }
            const letter = $('#current-table-order').text().slice(-1);
            $('#right-arrow').removeClass('btn-muted');
            $('#right-arrow').addClass('btn-info');
            $('.badge').text('');
            switch (letter) {
                case "B":
                    $('#left-arrow').removeClass('btn-info');
                    $('#left-arrow').addClass('btn-muted');
                    $('#current-table-order').text(TableNumber.display + ':A');
                    TableNumber.currentIndex.value = 1;
                    break;
                case "C":
                    $('#current-table-order').text(TableNumber.display + ':B');
                    TableNumber.currentIndex.value = 2;
                    break;
                case "D":
                    $('#current-table-order').text(TableNumber.display + ':C');
                    TableNumber.currentIndex.value = 3;
                    break;
                case "E":
                    $('#current-table-order').text(TableNumber.display + ':D');
                    TableNumber.currentIndex.value = 4;
                    break;
                case "F":
                    $('#current-table-order').text(TableNumber.display + ':E');
                    TableNumber.currentIndex.value = 5;
                    break;
                case "G":
                    $('#current-table-order').text(TableNumber.display + ':F');
                    TableNumber.currentIndex.value = 6;
                    break;
                case "H":
                    $('#current-table-order').text(TableNumber.display + ':G');
                    TableNumber.currentIndex.value = 7;
                    break;
                case "I":
                    $('#current-table-order').text(TableNumber.display + ':H');
                    TableNumber.currentIndex.value = 8;
                    break;
                case "J":
                    $('#current-table-order').text(TableNumber.display + ':I');
                    TableNumber.currentIndex.value = 9;
                    break;
                default:
                    console.log('martin...you forget for this exeption');
                    break;
            }
            Order.temporalOrder.forEach(item => {
                if (item.currentIndex === TableNumber.currentIndex.value) {
                    $('.menu-page-item[data-name][data-name="' + item.name + '"] .badge').text(item.quantity);
                }
            });
        }
    }

    /**
     * description: right arrow for more then one order in current table
     * 
     * @returns {undefined}
     */
    function right() {
        if ($('#right-arrow').hasClass('btn-info')) {
            if (Order.temporalOrder.length > 0) {
                $('#drow-note').addClass('btn-info');
                $('#corection').addClass('btn-info');
                $('#history').addClass('btn-info');
                $('#send-order').addClass('btn-info');
                $('#send-total').addClass('btn-info');
                $('.yes-button-hidden').removeClass('hidden-xs hidden-sm');
            }
            const str = $('#current-table-order').text().slice(-1);
            $('#left-arrow').removeClass('btn-muted');
            $('#left-arrow').addClass('btn-info');
            $('.badge').text('');
            switch (str) {
                case "A":
                    $('#current-table-order').text(TableNumber.display + ':B');
                    TableNumber.currentIndex.value = 2;
                    break;
                case "B":
                    $('#current-table-order').text(TableNumber.display + ':C');
                    TableNumber.currentIndex.value = 3;
                    break;
                case "C":
                    $('#current-table-order').text(TableNumber.display + ':D');
                    TableNumber.currentIndex.value = 4;
                    break;
                case "D":
                    $('#current-table-order').text(TableNumber.display + ':E');
                    TableNumber.currentIndex.value = 5;
                    break;
                case "E":
                    $('#current-table-order').text(TableNumber.display + ':F');
                    TableNumber.currentIndex.value = 6;
                    break;
                case "F":
                    $('#current-table-order').text(TableNumber.display + ':G');
                    TableNumber.currentIndex.value = 7;
                    break;
                case "G":
                    $('#current-table-order').text(TableNumber.display + ':H');
                    TableNumber.currentIndex.value = 8;
                    break;
                case "H":
                    $('#current-table-order').text(TableNumber.display + ':I');
                    TableNumber.currentIndex.value = 9;
                    break;
                case "I":
                    $('#current-table-order').text(TableNumber.display + ':J');
                    TableNumber.currentIndex.value = 10;
                    break;
                default:
                    console.log('martin...you forget for this exeption');
                    break;
            }
            Order.temporalOrder.forEach(item => {
                if (item.currentIndex === TableNumber.currentIndex.value) {
                    $('.menu-page-item[data-name][data-name="' + item.name + '"] .badge').text(item.quantity);
                }
            });
            if (TableNumber.currentIndexStorige.length === (TableNumber.currentIndex.value | 0)) {
                $('#right-arrow').removeClass('btn-info');
                $('#right-arrow').addClass('btn-muted');
            }
        }
    }

    /**
     * description: add another order in the current order
     * 
     * @returns {undefined}
     */
    function plus() {
        if ($('#add-order').hasClass('btn-info')) {
            $('#left-arrow').removeClass('btn-muted');
            $('#left-arrow').addClass('btn-info');
            $('#right-arrow').removeClass('btn-info');
            $('#right-arrow').addClass('btn-muted');
            $('#drow-note, #corection, #history, #send-order, #send-total').removeClass('btn-info');
            $('#add-order').removeClass('btn-info');
            $('#drow-note').removeClass('btn-info');
            $('#corection').removeClass('btn-info');
            $('#history').removeClass('btn-info');
            $('#send-order').removeClass('btn-info');
            $('#send-total').removeClass('btn-info');
            $('.yes-button-hidden').addClass('hidden-xs hidden-sm');
            const str = TableNumber.currentIndexStorige.slice(-1) + '';
            $('.badge').text('');
            switch (str) {
                case "B":
                    $('#current-table-order').text(TableNumber.display + ':C');
                    TableNumber.currentIndex.value = 3;
                    TableNumber.currentIndexStorige.push('C');
                    break;
                case "C":
                    $('#current-table-order').text(TableNumber.display + ':D');
                    TableNumber.currentIndex.value = 4;
                    TableNumber.currentIndexStorige.push('D');
                    break;
                case "D":
                    $('#current-table-order').text(TableNumber.display + ':E');
                    TableNumber.currentIndex.value = 5;
                    TableNumber.currentIndexStorige.push('E');
                    break;
                case "E":
                    $('#current-table-order').text(TableNumber.display + ':F');
                    TableNumber.currentIndex.value = 6;
                    TableNumber.currentIndexStorige.push('F');
                    break;
                case "F":
                    $('#current-table-order').text(TableNumber.display + ':G');
                    TableNumber.currentIndex.value = 7;
                    TableNumber.currentIndexStorige.push('G');
                    break;
                case "G":
                    $('#current-table-order').text(TableNumber.display + ':H');
                    TableNumber.currentIndex.value = 8;
                    TableNumber.currentIndexStorige.push('H');
                    break;
                case "H":
                    $('#current-table-order').text(TableNumber.display + ':I');
                    TableNumber.currentIndex.value = 9;
                    TableNumber.currentIndexStorige.push('I');
                    break;
                case "I":
                    $('#add-order').removeClass('btn-info');
                    $('#add-order').addClass('btn-muted');
                    $('#current-table-order').text(TableNumber.display + ':J');
                    TableNumber.currentIndex.value = 10;
                    TableNumber.currentIndexStorige.push('J');
                    break;
                default:
                    $('#current-table-order').text(TableNumber.display + ':B');
                    TableNumber.currentIndex.value = 2;
                    TableNumber.currentIndexStorige.push('B');
                    break;
            }
        }
    }

    /**
     * switch classes of elements between some interval.
     * If "repeat" is a number, will create that many iterations
     * @param {type} selector
     * @param {type} className
     * @param {type} time [optional][default = 200ms]
     * @param {type} repeat [optional][default = 0]
     * @returns {undefined}
     */
    function blink(selector, className, time = 200, repeat = 0) {
        $(selector).addClass(className);
        const newSelector = $(selector);
        setTimeout(function () {
            $(newSelector).removeClass(className);
            if (repeat > 0) {
                repeat--;
                setTimeout(function () {
                    blink(newSelector, className, time, repeat);
                }, time);
            }
        }, time);
    }

    /**
     * description: this function help, when one table have more then one order
     * 
     * @param {type} someNumber
     * @returns {String}
     */
    function convertToLetter(someNumber) {
        const convertor = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        let letter = convertor[someNumber - 1];
        if (letter === undefined || letter === 'undefined') {
            letter = 'A';
        }
        return letter;
    }

    /**
     *  description: this function help, when one table have more then one order
     * 
     * @param {type} number
     * @returns {Array}
     */
    function convertToLettersFromLetter(number) {
        const convertor = [['A'], ['A', 'B'], ['A', 'B', 'C'], ['A', 'B', 'C', 'D'], ['A', 'B', 'C', 'D', 'E'], [' A', 'B', 'C', 'D', 'E', 'F'], ['A', 'B', 'C', 'D', 'E', 'F', 'G'], ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'], ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'], ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J']];
        let arrayOfLetters = convertor[(number - 1)];
        if (number === 0 || number === '0') {
            arrayOfLetters = ['A'];
        }
        return arrayOfLetters;
    }

    /**
     * description: if item is pressed, blink and add item to order
     * 
     * @param {type} selectedItemFromMenu
     * @returns {undefined}
     */
    function addItemToTemporalOrder(selectedItemFromMenu) {
        if ($('#add-order').hasClass('btn-muted')) {
            $('#add-order').addClass('btn-info');
            $('#drow-note').addClass('btn-info');
            $('#corection').addClass('btn-info');
            $('#history').addClass('btn-info');
            $('#send-order').addClass('btn-info');
            $('#send-total').addClass('btn-info');
            $('.yes-button-hidden').removeClass('hidden-xs hidden-sm');
        }
        const name = $(selectedItemFromMenu).attr('data-name');
        const userName = $(selectedItemFromMenu).attr('data-user-name');
        const price = $(selectedItemFromMenu).attr('data-price');
        const location = $(selectedItemFromMenu).attr('data-type');
        const badge = selectedItemFromMenu.lastChild;
        const addedItemFromMenu = {
            name: name,
            price: price,
            quantity: 1,
            location: location,
            note: false,
            date: currentTime,
            currentIndex: TableNumber.currentIndex.value,
            userName: userName
        };
        if (Order.temporalOrder.length < 1) {
            Order.temporalOrder.push(addedItemFromMenu);
            $(badge).text(1);
        } else {
            const itemsNumber = Order.temporalOrder.length;
            for (i = 0; i <= itemsNumber; i++) {
                if (i === itemsNumber) {
                    Order.temporalOrder.push(addedItemFromMenu);
                    $(badge).text(1);
                    return;
                }
                if (Order.temporalOrder[i].name === addedItemFromMenu.name && Order.temporalOrder[i].currentIndex === addedItemFromMenu.currentIndex) {
                    Order.temporalOrder[i].quantity = parseInt(Order.temporalOrder[i].quantity) + 1;
                    $(badge).text(Order.temporalOrder[i].quantity);
                    return;
                }
            }
        }
    }

    /**
     * show page for canvas
     * @returns {undefined}
     */
    function letDrawWithCanvas() {
        const currentItems = Order.temporalOrder.filter(function (item) {
            return item.currentIndex === TableNumber.currentIndex.value;
        });
        const tmpOrderLength = currentItems.length;
        for (i = 0; i < tmpOrderLength; i++) {
            const item = currentItems[i].name;
            const badgeValue = currentItems[i].quantity;
            $('#page-canvas .p-holder').append(`<p class="note-page-item text-left bg-info" data-name="${item}">${item}<span class="badge pull-right">${badgeValue}</span></p>`);
        }
        $('.note-page-item').on('tap', function () {
            $('#page-canvas').prepend('<canvas class="col-xs-12 col-sm-12"></canvas>');
            drowNote(this);
        });
        $('#work-page').hide();
        $('#page-canvas').show();
    }

    /* close canvas page */
    function cancelCanvas() {
        $('.note-page-item').remove();
        $('#work-page').show();
        $('#page-canvas').hide();
    }

    /* drow with finger */
    function drowNote(that) {
        Canvas.instance = document.getElementsByTagName('canvas');
        Canvas.ctx = $(Canvas.instance).get(0).getContext('2d');
        Canvas.target = $(that);
        Canvas.targetValue = $(Canvas.target).attr('data-name');
        $('.note-page-item, #close-canvas-page').addClass('hidden-xs hidden-sm');
        $('#cancel-drow').removeClass('hidden-xs hidden-sm');
        //canvas risuvane s prust!
        $(Canvas.instance).on('touchstart', function (e) {
            $('#save-canvas').removeClass('hidden-xs hidden-sm');
            Canvas.fingerDown = true;
            Canvas.draw(Canvas.touchPosition.x, Canvas.touchPosition.y, e);
        });
        $(Canvas.instance).on('touchend', function (e) {
            Canvas.fingerDown = false;
        });
        $(Canvas.instance).on('touchmove', function (e) {
            Canvas.draw(Canvas.touchPosition.x, Canvas.touchPosition.y, e);
        });
        //risuvaneto prikluchi
        $('#cancel-drow').on('tap', function () {
            drowNoteDone(Canvas.target);
        });
        //push note into order
        $('#save-canvas').on('tap', function () {
            $('#save-canvas').off();
            const canvasTargetValue = Canvas.targetValue;
            Order.temporalOrder.forEach(function (item) {
                if (item.name === canvasTargetValue && item.currentIndex === TableNumber.currentIndex.value) {
                    item.note = $(Canvas.instance).get(0).toDataURL('image/png').replace('data:image/png;base64,', '').replace(' ', '+');
                }
            });
            drowNoteDone(Canvas.target);
        });
    }

    /**
     * sinc view after note addet
     * @param {type} that
     * @returns {undefined}
     */
    function drowNoteDone(that) {
        $('canvas').remove();
        $('.note-page-item').off();
        $('.note-page-item').on('tap', function () {
            $('#page-canvas').prepend('<canvas class="col-xs-12 col-sm-12"></canvas>');
            drowNote(this);
        });
        $('#cancel-drow, #save-canvas').addClass('hidden-xs hidden-sm');
        $('#close-canvas-page, .note-page-item').removeClass('hidden-xs hidden-sm');
    }

    /* realy massy functions i give up to document them */
    function prepeareForCorection() {
        Order.loadCorectionProxys();
        const temporalOrderProxyLength = Order.temporalOrderProxy.length;
        for (i = 0; i < temporalOrderProxyLength; i++) {
            Order.initializeEmptyMemory();
            const name = Order.temporalOrderProxy[i].name;
            const quantity = Order.temporalOrderProxy[i].quantity;
            $('#page-corection .p-holder').append(`<p class="corection-page-item text-left bg-info" data-index="${i}" data-name="${name}">${name}<span class="badge pull-right">${quantity}</span></p>`);
        }
        $('.corection-page-item').off();
        $('.corection-page-item').on('tap', function () {
            corectionElements(this);
        });
        $('#work-page').hide();
        $('#page-corection').show();
    }

    /* realy massy functions i give up to document them */
    function corectionElements(pressedElement) {
        const dataIndex = $(pressedElement).attr('data-index') | 0;
        const temporalOrderObj = {
            name: Order.temporalOrderProxy[dataIndex].name,
            price: Order.temporalOrderProxy[dataIndex].price,
            quantity: Order.temporalOrderProxy[dataIndex].quantity,
            location: Order.temporalOrderProxy[dataIndex].location,
            note: Order.temporalOrderProxy[dataIndex].note,
            date: Order.temporalOrderProxy[dataIndex].date,
            currentIndex: TableNumber.currentIndex.value,
            userName: Order.temporalOrderProxy[dataIndex].userName
        };
        const memoryObj = {
            name: Order.corectionMemory[dataIndex].name,
            price: Order.corectionMemory[dataIndex].price,
            location: Order.corectionMemory[dataIndex].location,
            note: Order.corectionMemory[dataIndex].note,
            quantity: Order.corectionMemory[dataIndex].quantity,
            date: Order.corectionMemory[dataIndex].date,
            currentIndex: TableNumber.currentIndex.value,
            dataIndex: dataIndex,
            userName: Order.corectionMemory[dataIndex].userName
        };
        const empty = {
            name: 'empty',
            price: 'empty',
            location: 'empty',
            note: 'empty',
            quantity: 'empty',
            date: 'empty',
            dataIndex: 'empty',
            userName: 'empty'
        };
        if (!$(pressedElement).hasClass('bg-danger')) {
            if (Order.temporalOrderProxy[dataIndex].quantity > 1) {
                if (Order.corectionMemory[dataIndex].name === 'empty') {
                    Order.temporalOrderProxy[dataIndex].quantity--;
                    Order.corectionMemory.splice(dataIndex, 1, temporalOrderObj);
                    Order.corectionMemory[dataIndex].quantity = 1;
                } else if (Order.corectionMemory[dataIndex].name !== 'empty') {
                    Order.corectionMemory[dataIndex].quantity++;
                    Order.temporalOrderProxy[dataIndex].quantity--;
                }
            } else if (Order.temporalOrderProxy[dataIndex].quantity === 1) {
                if (Order.corectionMemory[dataIndex].name === 'empty') {
                    Order.corectionMemory.splice(dataIndex, 1, temporalOrderObj);
                    Order.temporalOrderProxy.splice(dataIndex, 1, empty);
                } else if (Order.corectionMemory[dataIndex].name !== 'empty') {
                    Order.corectionMemory[dataIndex].quantity++;
                    Order.temporalOrderProxy.splice(dataIndex, 1, empty);
                }
            }
            $('#remove').addClass('btn-warning');
            $(pressedElement).addClass('bg-danger');
        } else if ($(pressedElement).hasClass('bg-danger')) {
            if (Order.corectionMemory[dataIndex].quantity > 1) {
                if (Order.temporalOrderProxy[dataIndex].name === 'empty') {
                    Order.corectionMemory[dataIndex].quantity--;
                    Order.temporalOrderProxy.splice(dataIndex, 1, memoryObj);
                    Order.temporalOrderProxy[dataIndex].quantity = 1;
                } else if (Order.temporalOrderProxy[dataIndex].name !== 'empty') {
                    Order.temporalOrderProxy[dataIndex].quantity++;
                    Order.corectionMemory[dataIndex].quantity--;
                }
            } else if (Order.corectionMemory[dataIndex].quantity === 1) {
                if (Order.temporalOrderProxy[dataIndex].name === 'empty') {
                    Order.temporalOrderProxy.splice(dataIndex, 1, memoryObj);
                    Order.corectionMemory.splice(dataIndex, 1, empty);
                } else if (Order.temporalOrderProxy[dataIndex].name !== 'empty') {
                    Order.temporalOrderProxy[dataIndex].quantity++;
                    Order.corectionMemory.splice(dataIndex, 1, empty);
                }
            }
            $(pressedElement).removeClass('bg-danger');
            if ($('#page-corection .bg-danger').length < 1) {
                $('#remove').removeClass('btn-warning');
            }
        }
    }

    /* realy massy functions i give up to document them */
    function deleteThisItemFunction() {
        const dataIndex = $(this).attr('data-index');
        const memoryProxyItem = {
            name: Order.corectionMemory[dataIndex].name,
            price: Order.corectionMemory[dataIndex].price,
            note: Order.corectionMemory[dataIndex].note,
            location: Order.corectionMemory[dataIndex].location,
            date: Order.corectionMemory[dataIndex].date,
            quantity: Order.corectionMemory[dataIndex].quantity,
            currentIndex: Order.corectionMemory[dataIndex].currentIndex,
            userName: Order.corectionMemory[dataIndex].userName,
            dataIndex: dataIndex
        };
        Order.corectionMemory[dataIndex];
        Order.corectionMemoryProxyStorigeRest.push(memoryProxyItem);
        if (parseInt(($(this).children().text())) > 1) {
            $(this).children().text(parseInt($(this).children().text()) - 1);
            $(this).removeClass('bg-danger');
        } else {
            $(this).remove();
        }
    }

    /* realy massy functions i give up to document them */
    function deleteThisItems() {
        if ($('#remove').hasClass('btn-warning')) {
            if ($('#page-coection .bg-danger').length < 1) {
                $('#remove').removeClass('btn-warning');
            }
            $('#page-corection .bg-danger').each(deleteThisItemFunction);
            $('#step-back').addClass('btn-info');
            $('#remove').removeClass('btn-warning');
        }
    }

    /* realy massy functions i give up to document them */
    function stepBackFunction() {
        const itemFromMemoryStorige = Order.corectionMemoryProxyStorigeRest.pop();
        const items = $('.corection-page-item');
        let simpleCounter = 0;
        const itemsLength = items.length;
        for (i = 0; i < itemsLength; i++) {
            if ($(items[i]).attr('data-name') === itemFromMemoryStorige.name) {
                $(items[i]).children().text(parseInt($(items[i]).children().text()) + 1);
                simpleCounter++;
            }
        }
        if (simpleCounter === 0) {
            $('#page-corection .p-holder').append(`<p class="corection-page-item text-left bg-info" data-index="` + itemFromMemoryStorige.dataIndex + `" data-name="` + itemFromMemoryStorige.name + `">` + itemFromMemoryStorige.name + `<span class="badge pull-right">` + 1 + `</span></p>`);
            Order.temporalOrderProxy.splice(itemFromMemoryStorige.dataIndex, 1, {
                name: itemFromMemoryStorige.name,
                price: itemFromMemoryStorige.prize,
                location: itemFromMemoryStorige.location,
                quantity: 1,
                note: itemFromMemoryStorige.note,
                date: itemFromMemoryStorige.date,
                currentIndex: TableNumber.currentIndex.value,
                dataIndex: itemFromMemoryStorige.dataIndex,
                userName: itemFromMemoryStorige.userName
            });
            if (Order.corectionMemory[itemFromMemoryStorige.dataIndex].quantity === 0) {
                Order.corectionMemory.splice(itemFromMemoryStorige.dataIndex, 1, {
                    name: 'empty',
                    price: 'empty',
                    location: 'empty',
                    note: 'empty',
                    quantity: 'empty',
                    date: 'empty',
                    currentIndex: 'empty',
                    dataIndex: 'empty',
                    userName: 'empty'
                });
            }
        } else if (simpleCounter > 0) {
            const newQuantity = (Order.temporalOrderProxy[itemFromMemoryStorige.dataIndex].quantity + 1);
            Order.temporalOrderProxy.splice(itemFromMemoryStorige.dataIndex, 1, {
                name: itemFromMemoryStorige.name,
                price: itemFromMemoryStorige.prize,
                location: itemFromMemoryStorige.location,
                quantity: newQuantity,
                date: itemFromMemoryStorige.date,
                note: itemFromMemoryStorige.note,
                currentIndex: TableNumber.currentIndex.value,
                dataIndex: itemFromMemoryStorige.dataIndex
            });
            Order.corectionMemory[itemFromMemoryStorige.dataIndex].quantity--;
            if (Order.corectionMemory[itemFromMemoryStorige.dataIndex].quantity === 0) {
                Order.corectionMemory.splice(itemFromMemoryStorige.dataIndex, 1, {
                    name: 'empty',
                    price: 'empty',
                    location: 'empty',
                    note: 'empty',
                    quantity: 'empty',
                    date: 'empty',
                    currentIndex: 'empty',
                    dataIndex: 'empty',
                    userName: 'empty'
                });
            }
        }
        if (Order.corectionMemoryProxyStorigeRest.length < 1) {
            $('#step-back').removeClass('btn-info');
        }
        $('.corection-page-item').off();
        $('.corection-page-item').on('tap', function () {
            corectionElements(this);
        });
    }

    /* realy massy functions i give up to document them */
    function doneFunction() {
        if ($('#remove').hasClass('btn-warning')) {
            blink('#page-corection .bg-danger', 'errorItemToDelete', 150, 5);
            return;
        }
        Order.temporalOrderProxy = Order.temporalOrderProxy.filter(that => {
            return (that.name !== 'empty' && that.quantity !== 0);
        });
        Order.temporalOrderProxyStorigeRest = Order.temporalOrderProxyStorigeRest.filter(that => {
            return (that.name !== 'empty' && that.quantity !== 0);
        });
        Order.temporalOrder = Order.temporalOrderProxy.concat(Order.temporalOrderProxyStorigeRest).sort();
        Order.temporalOrderProxy = [];
        Order.temporalOrderProxyStorigeRest = [];
        Order.corectionMemory = [];
        Order.corectionMemoryProxyStorigeRest = [];
        $('#step-back').removeClass('btn-info');
        $('#page-corection .corection-page-item').remove();
        $('#remove').removeClass('btn-warning');
        $('.badge').text('');
        Order.temporalOrder.forEach(item => {
            if (item.currentIndex === TableNumber.currentIndex.value) {
                $('#work-page .menu-page-item[data-name][data-name="' + item.name + '"] .badge').text(item.quantity);
            }
        });
        if (Order.temporalOrder.length <= 0) {
            $('#add-order').removeClass('btn-info');
            $('#drow-note').removeClass('btn-info');
            $('#corection').removeClass('btn-info');
            $('#history').removeClass('btn-info');
            $('#send-order').removeClass('btn-info');
            $('#send-total').removeClass('btn-info');
            $('.yes-button-hidden').addClass('hidden-xs hidden-sm');
        }
        $('#page-corection').hide();
        $('#work-page').show();
    }

    function checkHistoryOfThisTable() {
        $('#back-from-history').on('tap', function () {
            $('#work-page').show();
            $('#page-history').hide();
        });
        $('#work-page').hide();
        $('#page-history').show();
    }

    function bildWorkSpace() {
        Request.setParams("get-table-number", 1);
        $.ajax({
            url: Request.URL,
            type: 'POST',
            data: JSON.stringify(Request.request),
            dataType: 'json',
            headers: {
                'Content-Type': 'application/json'
            }
        }).done(function (result) {
            const resultLength = result.length;
            if (resultLength > 0) {
                for (i = 0; i < resultLength; i++) {
                    Order.mainOrder.history[i] = {
                        items: []
                    };
                    const innerResultLength = result[i][0].length;
                    for (j = 0; j < innerResultLength; j++) {
                        Order.mainOrder.history[i].items.push({
                            name: result[i][0][j].name,
                            price: result[i][0][j].price,
                            quantity: result[i][0][j].quantity,
                            note: result[i][0][j].note,
                            location: result[i][0][j].type,
                            date: result[i][0][j].date,
                            currentIndex: result[i][0][j].current_index
                        });
                        Order.mainOrder.history[i].items[j].currentIndex = convertToLetter(Order.mainOrder.history[i].items[j].currentIndex);
                    }
                }
                if (Order.mainOrder.history[1] === undefined) {
                    TableNumber.currentIndex.value = 1;
                    TableNumber.currentIndexStorige.push('A');
                    $('#current-table-order').text(TableNumber.display);
                } else {
                    TableNumber.currentIndex.value = result[0][0][0].current_index;
                }
                const numberOfOrders = Order.mainOrder.history.length;
                TableNumber.currentIndexStorige = convertToLettersFromLetter(numberOfOrders);
                if (TableNumber.currentIndexStorige.length === 10) {
                    $('#add-order').removeClass('btn-info');
                    $('#add-order').addClass('btn-muted');
                }
                $('#current-table-order').text(TableNumber.display + ':' + Order.mainOrder.history[0].items[0].currentIndex);
            } else {
                TableNumber.currentIndex.value = 1;
                TableNumber.currentIndexStorige.push('A');
                Order.mainOrder.history[0] = null;
                $('#current-table-order').text(TableNumber.display);
            }
            if (TableNumber.currentIndexStorige[1] === undefined) {
                $('#left-arrow').removeClass('btn-info');
                $('#left-arrow').addClass('btn-muted');
            }
            $('#keyboard-page').hide();
            $('#work-page').show();
            $('#slide-menu').on('tap', '.menu-page-item', function () {
                blink(this, 'bg-danger', 300);
                addItemToTemporalOrder(this);
            });
            $('#left-arrow').on('tap', left);
            $('#right-arrow').on('tap', right);
            $('#add-order').on('tap', plus);
            $('#drow-note').on('tap', function () {
                if ($('#drow-note').hasClass('btn-info')) {
                    letDrawWithCanvas();
                }
            });
            $('#close-canvas-page').on('tap', cancelCanvas);
            $('#corection').on('tap', function () {
                if ($('#corection').hasClass('btn-info')) {
                    prepeareForCorection();
                }
            });
            $('#remove').on('tap', deleteThisItems);
            $('#step-back').on('tap', function () {
                if ($(this).hasClass('btn-info')) {
                    stepBackFunction();
                }
            });
            $('#corection-done').on('tap', doneFunction);

            $('#history').on('tap', function () {
                if ($('#history').hasClass('btn-info')) {
                    checkHistoryOfThisTable();
                }
            });
            /* atention swicher */
            $('#atention').on('tap', function () {
                const atention = $(this);
                if (atention.hasClass('btn-danger')) {
                    atention.removeClass('btn-danger');
                } else {
                    atention.addClass('btn-danger');
                }
            });
            //$('#send-total').on('tap', totalWasPressed);
            //$('#yesSendTotal').on('tap', yesTotalWasPressed);
            //$('#noSendTotal').on('tap', noTotalWasPressed);
            //
            //$('#yesSendOrder').on('tap', yesSendOrderWasPressed);
            //$('#noSendOrder').on('tap', noSendOrderWasPressed);

            $('#yes-cancel').on('tap', function () {
                window.location.reload(true);
            });
            //$('#noCancel').on('tap', noCancelWasPressed);
        });
    }

    /**
     * DI: blink()
     * @returns {undefined}
     */
    function insertKeyboardNumber() {
        const that = this;
        blink(that, 'btn-warning', 200);
        if (KeyboardNumbers.one === false) {
            $('#keyboard-numbers').append('<span id="table-1">' + that.innerHTML + '</span>');
            KeyboardNumbers.one = true;
        } else if (KeyboardNumbers.two === false) {
            $('#keyboard-numbers').append('<span id="table-2">' + that.innerHTML + '</span>');
            KeyboardNumbers.two = true;
        }
    }

    /**
     * DI: blink()
     * @returns {undefined}
     */
    function insertKeyboardZero() {
        const that = this;
        blink(that, 'btn-warning', 200);
        if (KeyboardNumbers.one === true && KeyboardNumbers.two === false) {
            $('#keyboard-numbers').append('<span id="table-2">' + that.innerHTML + '</span>');
            KeyboardNumbers.two = true;
        }
    }

    /**
     * DI: blink()
     * @returns {undefined}
     */
    function insertKeyboardDelete() {
        const that = this;
        blink(that, 'btn-warning', 200);
        if (KeyboardNumbers.one === true) {
            $('#table-1, #table-2').remove();
            KeyboardNumbers.two = false;
            KeyboardNumbers.one = false;
        }
    }

    /**
     * DI: blink()
     * DI: bildWorkSpace()
     * @returns {undefined}
     */
    function insertKeyboardEnter() {
        const that = this;
        blink(that, 'btn-warning', 200);
        if (KeyboardNumbers.one === true) {
            TableNumber.format();
            bildWorkSpace();
            custumizeSlider();
        }
    }

    $('#one ,#two ,#tree ,#four ,#five ,#six ,#seven ,#eight ,#nine').on('tap', insertKeyboardNumber);
    $('#delete').on('tap', insertKeyboardDelete);
    $('#zero').on('tap', insertKeyboardZero);
    $('#enter').on('tap', insertKeyboardEnter);
});