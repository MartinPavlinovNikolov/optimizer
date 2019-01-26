jQuery(document).ready(function ($) {

    /**
     * 
     * @type object
     */
    let mainOrder = {
        history: []
    },
            /**
             * 
             * @type object
             */
            nomeration = {
                one: false,
                two: false
            },
            /**
             * 
             * @type object
             */
            tableNumber = {
                furstParam: 0,
                secondParam: 0
            };
    /**
     * description: REST URL constant
     * 
     * @type String
     */
    const URL = 'http://optimizer.com/json-rpc.php';
    //const URL = 'http://192.168.192.100/optimizer.com/json-rpc.php';

    /**
     * description: make animation "blink" for pressed button on main screen;
     * (this function work with "opacity"!)
     * 
     * @param that (jQuery object-button)
     * @param timing (number for miliseconds of animation)
     * @returns {undefined}
     */
    function blinketButton(that, timing) {
        $(that).css('opacity', '1').animate({
            opacity: '0'
        }, timing);
    }

    /**
     * description: this function help, when one table have more then one order
     * 
     * @param {type} someNumber
     * @returns {String}
     */
    function convertToLetter(someNumber) {
        let convertor = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        let letter = convertor[someNumber - 1];
        if (letter === undefined || letter === 'undefined') {
            letter = 'A';
        }
        return letter;
    }

    /**
     * description: this function help, when one table have more then one order
     * 
     * @param {type} someNumber
     * @returns {String}
     */
    function convertToLettersFromLetter(number) {
        let convertor = [['A'], ['A', 'B'], ['A', 'B', 'C'], ['A', 'B', 'C', 'D'], ['A', 'B', 'C', 'D', 'E'], [' A', 'B', 'C', 'D', 'E', 'F'], ['A', 'B', 'C', 'D', 'E', 'F', 'G'], ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'], ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'], ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J']];
        let arrayOfLetters = convertor[(number - 1)];
        if (number === 0 || number === '0') {
            arrayOfLetters = ['A'];
        }
        return arrayOfLetters;
    }

    /**
     * description: insert the pressed button-numbers from key-board
     * ( dependency! : blinketButton() )
     * 
     * @returns {undefined}
     */
    function keyBoardNumbers() {
        blinketButton(this, 100);
        if (nomeration.one === false) {
            $('#tableNumberHolderFirstPage').append('<h1 id="table1">' + $(this, 'h6').text() + '</h2>');
            nomeration.one = true;
        } else if (nomeration.two === false) {
            $('#tableNumberHolderFirstPage').append('<h1 id="table2">' + $(this, 'h6').text() + '</h2>');
            nomeration.two = true;
        }

    }

    /**
     * description: insert the pressed button-zero from key-board if alredy have one number
     * ( dependency! : blinketButton() )
     * 
     * @returns {undefined}
     */
    function keyBoardZero() {
        blinketButton(this, 100);
        if (nomeration.one === true) {
            $('#tableNumberHolderFirstPage').append('<h1 id="table2">' + $(this, 'h6').text() + '</h2>');
            nomeration.two = true;
        }
    }

    /**
     * description: clear the numbers from screen
     * ( dependency! : blinketButton() )
     * 
     * @returns {undefined}
     */
    function keyBoardDelete() {
        blinketButton(this, 100);
        if (nomeration.one === true) {
            $('#table1, #table2').remove();
            nomeration.two = false;
            nomeration.one = false;
        }

    }

    /**
     * description: send selcted table number via AJAX JSON-RPC,
     * take the history(if history exist) and load the rest of the app.
     * (something like main-entry point. dependency! - blinketButton() )
     * 
     * @returns {undefined}
     */
    function keyBoardEnter() {
        blinketButton(this, 100);
        if (nomeration.one === true) {

            tableNumber.furstParam = $('#table1').text();
            tableNumber.secondParam = $('#table2').text();

            let numTable = parseInt(tableNumber.furstParam + tableNumber.secondParam);
            let request = {
                jsonrpc: "2.0",
                method: "get-table-number",
                params: [numTable],
                id: 1,
            };

            $.ajax({
                url: URL,
                type: 'POST',
                data: JSON.stringify(request),
                dataType: 'json',
                headers: {
                    'Content-Type': 'application/json'
                }
            }).done(function (result) {

                let currentIndex = {}.name,
                        currentIndexStorige = [];

                if (result.length > 0) {

                    for (i = 0; i < result.length; i++) {

                        mainOrder.history[i] = {
                            items: []
                        };

                        for (j = 0; j < result[i][0].length; j++) {

                            mainOrder.history[i].items.push({
                                name: result[i][0][j].name,
                                prize: result[i][0][j].price,
                                quantity: result[i][0][j].quantity,
                                note: result[i][0][j].note,
                                location: result[i][0][j].type,
                                date: result[i][0][j].date,
                                currentIndex: result[i][0][j].current_index
                            });
                            mainOrder.history[i].items[j].currentIndex = convertToLetter(mainOrder.history[i].items[j].currentIndex);
                        }

                    }

                    if (mainOrder.history[1] === undefined) {
                        currentIndex = {
                            value: 1
                        };
                        currentIndexStorige = ['A'];

                        $('#page2').prepend('<div id="wrapTableNumberView"><h1 id="tableNumberView">' + numTable + '</h1></div>');

                    } else {

                        currentIndex = {
                            value: result[0][0][0].current_index
                        };

                        let numberOfOrders = mainOrder.history.length;
                        currentIndexStorige = convertToLettersFromLetter(numberOfOrders);

                        if (currentIndexStorige.length === 10) {
                            $('#addOrder').hide();
                        }

                        $('#page2').prepend('<div id="wrapTableNumberView"><h1 id="tableNumberView">' + numTable + ':' + mainOrder.history[0].items[0].currentIndex + '</h1></div>');

                    }

                } else {

                    currentIndex = {
                        value: 1
                    };
                    currentIndexStorige = ['A'];

                    mainOrder.history[0] = null;
                    $('#page2').prepend('<div id="wrapTableNumberView"><h1 id="tableNumberView">' + numTable + '</h1></div>');

                }

                if (currentIndexStorige[1] === undefined) {

                    $('#leftArrow').hide();

                }

                $('#rightArrow').hide();

                $('#table1, #table2').remove();
                $('#page2').show();

                let temporalOrderProxy,
                        temporalOrderProxyStorigeRest,
                        memory = [],
                        m = [],
                        //ima li gurci na masata
                        greek = false,
                        items = [],
                        q = 0,
                        //da storvam tekushtata poruchka
                        temporalOrder = [];

                /**
                 * 
                 * @returns {String|Date}
                 */
                function currentDate() {

                    //tva za datata i chasa
                    let today = new Date(),
                            dd = today.getDate(),
                            mm = today.getMonth() + 1,
                            yyyy = today.getFullYear(),
                            hours = today.getHours(),
                            min = today.getMinutes();

                    if (dd < 10) {
                        dd = '0' + dd;
                    }
                    if (mm < 10) {
                        mm = '0' + mm;
                    }
                    if (min < 10) {
                        min = '0' + min;
                    }
                    if (hours < 10) {
                        hours = '0' + hours;
                    }
                    today = '[' + hours + ':' + min + '] ' + mm + '/' + dd + '/' + yyyy;

                    return today;

                }

                /**
                 * description: library "Slick"
                 * move the pages of menu like a boss
                 * 
                 * @returns {undefined}
                 */
                function loadSlick() {

                    $('.slideMenu').slick({
                        mobileFurst: true,
                        responsive: true,
                        arrows: false,
                        speed: 300,
                        slidesToShow: 1,
                        autoPlay: true
                    });

                }

                /**
                 * description: left arrow for more then one order in current table
                 * 
                 * @returns {undefined}
                 */
                function left() {

                    if ((currentIndex.value | 0) > 1) {

                        let str = $('#tableNumberView').text().slice(-1);

                        $('#rightArrow').show();

                        switch (str) {

                            case "B":
                                $('#leftArrow').hide();
                                $('#tableNumberView').text(numTable + ':A');
                                currentIndex.value = 1;
                                break;

                            case "C":
                                $('#tableNumberView').text(numTable + ':B');
                                currentIndex.value = 2;
                                break;

                            case "D":
                                $('#tableNumberView').text(numTable + ':C');
                                currentIndex.value = 3;
                                break;

                            case "E":
                                $('#tableNumberView').text(numTable + ':D');
                                currentIndex.value = 4;
                                break;

                            case "F":
                                $('#tableNumberView').text(numTable + ':E');
                                currentIndex.value = 5;
                                break;

                            case "G":
                                $('#tableNumberView').text(numTable + ':F');
                                currentIndex.value = 6;
                                break;

                            case "H":
                                $('#tableNumberView').text(numTable + ':G');
                                currentIndex.value = 7;
                                break;

                            case "I":
                                $('#tableNumberView').text(numTable + ':H');
                                currentIndex.value = 8;
                                break;

                            case "J":
                                $('#tableNumberView').text(numTable + ':I');
                                currentIndex.value = 9;
                                break;

                            default:
                                console.log('martin...you forget for this exeption');
                                break;

                        }

                    }

                }

                /**
                 * description: right array for more then one order in current table
                 * 
                 * @returns {undefined}
                 */
                function right() {

                    if ((currentIndex.value | 0) < currentIndexStorige.length) {

                        let str = $('#tableNumberView').text().slice(-1);

                        $('#leftArrow').show();

                        switch (str) {

                            case "A":
                                $('#tableNumberView').text(numTable + ':B');
                                currentIndex.value = 2;
                                break;

                            case "B":
                                $('#tableNumberView').text(numTable + ':C');
                                currentIndex.value = 3;
                                break;

                            case "C":
                                $('#tableNumberView').text(numTable + ':D');
                                currentIndex.value = 4;
                                break;

                            case "D":
                                $('#tableNumberView').text(numTable + ':E');
                                currentIndex.value = 5;
                                break;

                            case "E":
                                $('#tableNumberView').text(numTable + ':F');
                                currentIndex.value = 6;
                                break;

                            case "F":
                                $('#tableNumberView').text(numTable + ':G');
                                currentIndex.value = 7;
                                break;

                            case "G":
                                $('#tableNumberView').text(numTable + ':H');
                                currentIndex.value = 8;
                                break;

                            case "H":
                                $('#tableNumberView').text(numTable + ':I');
                                currentIndex.value = 9;
                                break;

                            case "I":
                                $('#tableNumberView').text(numTable + ':J');
                                currentIndex.value = 10;
                                break;

                            default:
                                console.log('martin...you forget for this exeption');
                                break;

                        }

                        if (currentIndexStorige.length === (currentIndex.value | 0)) {

                            $('#rightArrow').hide();

                        }

                    }

                }

                /**
                 * description: add another order in the current order
                 * 
                 * @returns {undefined}
                 */
                function plus() {

                    if (temporalOrder.length > 0) {

                        $('#leftArrow').show();
                        $('#rightArrow').hide();

                        let str = currentIndexStorige.slice(-1) + '';

                        switch (str) {

                            case "B":
                                $('#tableNumberView').text(numTable + ':C');
                                currentIndex.value = 3;
                                currentIndexStorige.push('C');
                                break;

                            case "C":
                                $('#tableNumberView').text(numTable + ':D');
                                currentIndex.value = 4;
                                currentIndexStorige.push('D');
                                break;

                            case "D":
                                $('#tableNumberView').text(numTable + ':E');
                                currentIndex.value = 5;
                                currentIndexStorige.push('E');
                                break;

                            case "E":
                                $('#tableNumberView').text(numTable + ':F');
                                currentIndex.value = 6;
                                currentIndexStorige.push('F');
                                break;

                            case "F":
                                $('#tableNumberView').text(numTable + ':G');
                                currentIndex.value = 7;
                                currentIndexStorige.push('G');
                                break;

                            case "G":
                                $('#tableNumberView').text(numTable + ':H');
                                currentIndex.value = 8;
                                currentIndexStorige.push('H');
                                break;

                            case "H":
                                $('#tableNumberView').text(numTable + ':I');
                                currentIndex.value = 9;
                                currentIndexStorige.push('I');
                                break;

                            case "I":
                                $('#addOrder').hide();
                                $('#tableNumberView').text(numTable + ':J');
                                currentIndex.value = 10;
                                currentIndexStorige.push('J');
                                break;

                            default:
                                $('#tableNumberView').text(numTable + ':B');
                                currentIndex.value = 2;
                                currentIndexStorige.push('B');
                                break;

                        }

                    }

                }

                function blinkWithTimeout(that, someTime) {
                    $(that).removeClass('item').addClass('itemWasPresed');

                    setTimeout(function () {
                        if ($(that).hasClass('itemWasPresed')) {
                            $(that).removeClass('itemWasPresed').addClass('item');
                        }
                    }, someTime);
                }

                /**
                 * description: if item is pressed, blink and add item to order
                 * 
                 * @param {type} selectedItemFromMenu
                 * @returns {undefined}
                 */
                function addItemToTemporalOrder(selectedItemFromMenu) {

                    j = selectedItemFromMenu;

                    blinkWithTimeout($(j), 200);

                    selectedItemFromMenu = ($(j).text()).substring(3);

                    selectedItemFromMenu = selectedItemFromMenu.split('@');

                    let addedItemFromMenu = {
                        name: selectedItemFromMenu[0],
                        prize: selectedItemFromMenu[1],
                        quantity: 1,
                        location: selectedItemFromMenu[2],
                        note: false,
                        date: currentDate(),
                        currentIndex: currentIndex.value
                    };

                    if (temporalOrder.length < 1) {

                        temporalOrder.push(addedItemFromMenu);

                    } else {

                        let len = temporalOrder.length;

                        for (i = 0; i <= len; i++) {

                            if (i === len) {

                                temporalOrder.push(addedItemFromMenu);
                                temporalOrder.sort(orderByIndex);

                                return;

                            }
                            if (temporalOrder[i].name === addedItemFromMenu.name && temporalOrder[i].currentIndex === addedItemFromMenu.currentIndex) {

                                temporalOrder[i].quantity = parseInt(temporalOrder[i].quantity) + 1;

                                return;

                            }

                        }

                    }

                }
//make singleton object canvas to work with(too many nested functions heare)
                function letDrawWithCanvas() {

                    if (temporalOrder.length < 1) {

                        return;

                    } else {

                        let length = temporalOrder.length;

                        for (i = 0; i < length; i++) {

                            $('#pageCanvas').append('<span class="tempSpan temporalSpan"><h1 class="nameH1">' + temporalOrder[i].name + '</h1><h6>' + temporalOrder[i].prize + '</h6><h6>' + temporalOrder[i].location + '</h6><h1 class="quantityH1"> ' + temporalOrder[i].quantity + '</h1><h1 class="quantityH1">X</h1><h6>' + temporalOrder[i].note + '</h6><h6>' + i + '</h6></span>');

                        }

                        i = 0;

                        $('span.tempSpan').on('tap', function () {

                            drowNote(this);

                        });

                        $('#pageCanvas').show();
                        $('#page2').hide();

                    }

                }
                function cancelCanvas() {

                    $('span.temporalSpan').remove();
                    $('span.itemWasCorected').remove();
                    $('#page2').show();
                    $('#pageCanvas').hide();

                }
                function drowNote() {


                    let touchPosition = {
                        x: 0,
                        y: 0
                    },
                            fingerDown = false,
                            canvas = $('#canvasScreen'),
                            ctx = $('#canvasScreen').get(0).getContext('2d'),
                            i = $(arguments[0]),
                            j = parseInt($(i[0].lastChild).text());

                    function draw(canvas, a, b, e) {

                        touchPosition.x = e.originalEvent.touches[0].pageX;
                        touchPosition.y = e.originalEvent.touches[0].pageY;

                        if (fingerDown) {

                            ctx.beginPath();

                            ctx.moveTo(a - 28, b - 30);

                            ctx.arc(a - 28, b - 30, 25, 0, 360 * Math.PI / 180);

                            ctx.fill();

                            ctx.stroke();

                        }

                    }

                    $(i).removeClass('temporalSpan').addClass('itemWasCorected');
                    $('#canvasScreen, #cancelDrow, #cancelDrowText').show();
                    $('#cancelCanvas, #cancelCanvasText').hide();


                    //canvas risuvane s prust!
                    canvas.on('touchstart', function (e) {
                        $('#saveCanvasText, #saveCanvas').show();

                        fingerDown = true;

                        draw(canvas, touchPosition.x, touchPosition.y, e);

                    });

                    canvas.on('touchend', function (e) {
                        fingerDown = false;
                    });

                    canvas.on('touchmove', function (e) {

                        draw(canvas, touchPosition.x, touchPosition.y, e);

                    });

                    //risuvaneto prikluchi
                    $('#cancelDrowText').on('tap', function () {

                        drowNoteDone(i);

                    });



                    $('#saveCanvasText').on('tap', function () {
                        $('#saveCanvasText').off();
                        let tempImg = $('#canvasScreen').get(0).toDataURL('image/png');
                        tempImg = tempImg.replace('data:image/png;base64,', '');
                        temporalOrder[j].note = tempImg.replace(' ', '+');
                        drowNoteDone(i);
                    });

                }
                function drowNoteDone(that) {

                    $('#canvasScreen').remove();
                    $('#pageCanvas').prepend('<canvas id="canvasScreen" width="920" height="1250"></canvas>');

                    $('span.tempSpan').off();
                    $('span.tempSpan').on('tap', function () {

                        drowNote(this);

                    });

                    $('#canvasScreen, #cancelDrow, #cancelDrowText, #saveCanvas, #saveCanvasText').hide();
                    $('#cancelCanvas, #cancelCanvasText').show();

                    $(that).removeClass('itemWasCorected').addClass('temporalSpan');

                    i = 0;

                }
                
                /**
                 * @TODO: make simple functions to work with corections
                 * @returns {undefined}
                 */
                function prepeareForCorection() {
                    if (temporalOrder.length < 1) {

                        return;

                    } else {

                        temporalOrderProxy = temporalOrder.filter(function (x) {

                            return x.currentIndex == currentIndex.value;

                        });

                        temporalOrderProxyStorigeRest = temporalOrder.filter(function (x) {

                            return x.currentIndex != currentIndex.value;

                        });

                        let length = temporalOrderProxy.length;

                        for (i = 0; i < length; i++) {

                            memory.push({
                                name: 'empty',
                                prize: 'empty',
                                location: 'empty',
                                note: 'empty',
                                quantity: 'empty',
                                date: 'empty',
                                index: 'empty'
                            });

                            $('#pageCorektion').append('<span class="tempSpan temporalSpan"><h1 class="nameH1">' + temporalOrderProxy[i].name + '</h1><h6>' + temporalOrderProxy[i].prize + '</h6><h6>' + temporalOrderProxy[i].location + '</h6><h1 class="quantityH1"> ' + temporalOrderProxy[i].quantity + '</h1><h1 class="quantityH1">X</h1><h6>' + temporalOrderProxy[i].note + '</h6><h6>' + currentIndex.value + '</h6><h6>' + temporalOrderProxy[i].date + '</h6><h6>' + i + '</h6></span>');

                        }

                        i = 0;

                        spanAcsess($('.tempSpan'));

                        $('#pageCorektion').show();
                        $('#page2').hide();

                    }

                }
                function orderByIndex(x, y) {
                    return (x.currentIndex == y.currentIndex) ? 0 : (x.currentIndex > y.currentIndex) ? 1 : -1;
                }
                function spanAcsess(span) {

                    span.off();

                    span.on('tap', function () {

                        corectionElements(this);

                    });

                }
                function corectionElements() {

                    let index = parseInt($(arguments[0].lastChild).text()),
                            temporalOrderObj = {
                                name: temporalOrderProxy[index].name,
                                prize: temporalOrderProxy[index].prize,
                                location: temporalOrderProxy[index].location,
                                note: temporalOrderProxy[index].note,
                                quantity: temporalOrderProxy[index].quantity,
                                date: temporalOrderProxy[index].date,
                                currentIndex: currentIndex.value,
                                index: index
                            },
                            memoryObj = {
                                name: memory[index].name,
                                prize: memory[index].prize,
                                location: memory[index].location,
                                note: memory[index].note,
                                quantity: memory[index].quantity,
                                date: memory[index].date,
                                currentIndex: currentIndex.value,
                                index: index
                            },
                            empty = {
                                name: 'empty',
                                prize: 'empty',
                                location: 'empty',
                                note: 'empty',
                                quantity: 'empty',
                                date: 'empty',
                                index: 'empty'
                            };

                    if ($(arguments[0]).hasClass('temporalSpan')) {

                        if (temporalOrderProxy[index].quantity > 1) {

                            if (memory[index].name === 'empty') {

                                temporalOrderProxy[index].quantity--;
                                memory.splice(index, 1, temporalOrderObj);
                                memory[index].quantity = 1;

                            } else if (memory[index].name !== 'empty') {

                                memory[index].quantity++;
                                temporalOrderProxy[index].quantity--;

                            }

                        } else if (temporalOrderProxy[index].quantity === 1) {

                            if (memory[index].name === 'empty') {

                                memory.splice(index, 1, temporalOrderObj);
                                temporalOrderProxy.splice(index, 1, empty);

                            } else if (memory[index].name !== 'empty') {

                                memory[index].quantity++;
                                temporalOrderProxy.splice(index, 1, empty);

                            }

                        }

                        $('#remove').addClass('navActive');
                        $(arguments[0]).removeClass('temporalSpan').addClass('itemWasCorected');

                    } else if ($(arguments[0]).hasClass('itemWasCorected')) {

                        if (memory[index].quantity > 1) {

                            if (temporalOrderProxy[index].name === 'empty') {

                                memory[index].quantity--;
                                temporalOrderProxy.splice(index, 1, memoryObj);
                                temporalOrderProxy[index].quantity = 1;

                            } else if (temporalOrderProxy[index].name !== 'empty') {

                                temporalOrderProxy[index].quantity++;
                                memory[index].quantity--;

                            }

                        } else if (memory[index].quantity === 1) {

                            if (temporalOrderProxy[index].name === 'empty') {

                                temporalOrderProxy.splice(index, 1, memoryObj);
                                memory.splice(index, 1, empty);

                            } else if (temporalOrderProxy[index].name !== 'empty') {

                                temporalOrderProxy[index].quantity++;
                                memory.splice(index, 1, empty);

                            }

                        }

                        $(arguments[0]).removeClass('itemWasCorected').addClass('temporalSpan');
                        turnOffRemoveButton();

                    }

                }
                function turnOffRemoveButton() {

                    if ($('.itemWasCorected').length < 1) {
                        $('#remove').removeClass('navActive');
                    }

                }
                function deleteThisItemFunction() {

                    m.push({
                        name: $(this.children[0]).text(),
                        prize: $(this.children[1]).text(),
                        location: $(this.children[2]).text(),
                        quantity: 1,
                        note: $(this.children[5]).text(),
                        currentIndex: currentIndex.value,
                        date: $(this.children[7]).text(),
                        index: $(this.children[8]).text(),
                        realQuantity: $(this.children[3]).text()
                    });

                    if (parseInt($(this.children[3]).text()) > 1) {

                        $(this.children[3]).text(parseInt($(this.children[3]).text()) - 1);
                        $(this).addClass('temporalSpan').removeClass('itemWasCorected');

                    } else {

                        $(this).remove();

                    }

                }
                function deleteThisItems() {

                    if ($('#remove').hasClass('navActive')) {

                        turnOffRemoveButton();

                        $('.itemWasCorected').each(deleteThisItemFunction);

                        $('#stepBack').show();

                        $('#remove').removeClass('navActive');

                    }

                }
                function stepBackFunction() {

                    let that = m.pop(),
                            spanCounter = $('.temporalSpan'),
                            countCount = 0,
                            length = spanCounter.length;

                    for (i = 0; i < length; i++) {

                        if ($(spanCounter[i].firstChild).text() === that.name) {

                            $(spanCounter[i].children[3]).text(parseInt($(spanCounter[i].children[3]).text()) + 1);

                            countCount++;

                        }

                    }

                    if (countCount === 0) {

                        $('#pageCorektion').append('<span class="tempSpan temporalSpan"><h1 class="nameH1">' + that.name + '</h1><h6>' + that.prize + '</h6><h6>' + that.location + '</h6><h1 class="quantityH1"> ' + that.quantity + '</h1><h1 class="quantityH1">X</h1><h6>' + that.note + '</h6><h6>' + that.currentIndex + '</h6><h6>' + that.date + '</h6><h6>' + that.index + '</h6></span>');

                        temporalOrderProxy.splice(that.index, 1, {
                            name: that.name,
                            prize: that.prize,
                            location: that.location,
                            quantity: 1,
                            note: that.note,
                            date: that.date,
                            currentIndex: currentIndex.value,
                            index: that.index
                        });

                        if (memory[that.index].quantity === 0) {

                            memory.splice(that.index, 1, {
                                name: 'empty',
                                prize: 'empty',
                                location: 'empty',
                                note: 'empty',
                                quantity: 'empty',
                                date: 'empty',
                                currentIndex: 'empty',
                                index: 'empty'
                            });

                        }

                    } else if (countCount > 0) {

                        temporalOrderProxy.splice(that.index, 1, {
                            name: that.name,
                            prize: that.prize,
                            location: that.location,
                            quantity: that.realQuantity,
                            date: that.date,
                            note: that.note,
                            currentIndex: currentIndex.value,
                            index: that.index
                        });

                        memory[that.index].quantity--;

                        if (memory[that.index].quantity === 0) {

                            memory.splice(that.index, 1, {
                                name: 'empty',
                                prize: 'empty',
                                location: 'empty',
                                note: 'empty',
                                quantity: 'empty',
                                date: 'empty',
                                currentIndex: 'empty',
                                index: 'empty'
                            });

                        }

                    }

                    if (m.length < 1) {
                        $('#stepBack').hide();
                    }

                    spanAcsess($('.tempSpan'));

                }
                function doneFunction() {

                    if ($('#remove').hasClass('navActive')) {

                        i = 0;

                        let errorBtn = setInterval(function () {

                            $('.itemWasCorected').addClass('errorSpanMustBeDeleted');

                            setTimeout(function () {

                                $('.itemWasCorected').removeClass('errorSpanMustBeDeleted');
                                i++;
                                if (i > 4) {

                                    i = 0;
                                    clearInterval(errorBtn);

                                }

                            }, 80);

                        }, 160);

                    } else {

                        temporalOrderProxy = temporalOrderProxy.filter(that => {

                            return (that.name !== 'empty' && that.quantity !== 0);

                        });

                        temporalOrderProxyStorigeRest = temporalOrderProxyStorigeRest.filter(that => {

                            return (that.name !== 'empty' && that.quantity !== 0);

                        });

                        temporalOrder = temporalOrderProxy.concat(temporalOrderProxyStorigeRest);

                        temporalOrder.sort(orderByIndex);

                        temporalOrderProxy = [];
                        temporalOrderProxyStorigeRest = [];
                        memory = [];
                        m = [];

                        $('#stepBack').hide();

                        $('span.temporalSpan').remove();
                        $('span.itemWasCorected').remove();

                        turnOffRemoveButton();

                        $('#page2').show();
                        $('#pageCorektion').hide();

                    }

                }

                function checkHistoryOfThisTable() {

                    if (mainOrder.history[0] !== null) {

                        $('#page2').hide();
                        $('#mainOrder').show();

                        let len = mainOrder.history.length;

                        for (i = 0; i < len; i++) {

                            $('#mainOrder').prepend('<div id="indexHolder' + i + '" class="itemHistoryH">order:' + mainOrder.history[i].items[0].currentIndex + '</div><br><br><br>');

                            let len2 = mainOrder.history[i].items.length;

                            for (j = 0; j < len2; j++) {

                                $('#indexHolder' + i).append('<div class="itemHistory">' + mainOrder.history[i].items[j].name + '<h1 class="quantityH1">X ' + mainOrder.history[i].items[j].quantity + '</h1></div>');

                            }

                        }

                    }

                    $('#backFromHistoryText').on('tap', function () {

                        $('#page2').show();
                        $('#mainOrder').hide();
                        $('.itemHistoryH').remove();

                    });

                }

                function atentionFunction() {

                    if ($(this).hasClass('atentionOff')) {
                        $(this).removeClass('atentionOff').addClass('atentionOn');
                        greek = true;
                    } else if ($(this).hasClass('atentionOn')) {
                        $(this).removeClass('atentionOn').addClass('atentionOff');
                        greek = false;
                    }

                }

                function totalWasPressed() {

                    if (temporalOrder.length > 0 || mainOrder.history[0] !== null) {

                        if ($('#areYouShuarSendTotal').hasClass('areYouShuar1')) {
                            $('#areYouShuarSendTotal').removeClass('areYouShuar1').addClass('areYouShuar2');
                        }

                    }

                }
                function yesTotalWasPressed() {

                    let total = [],
                            t;

                    result.forEach(function (r) {

                        r[0].forEach(function (r2) {

                            t = {
                                name: r2.name,
                                prize: r2.price,
                                quantity: r2.quantity,
                                note: r2.note,
                                location: r2.type,
                                date: r2.date,
                                currentIndex: r2.current_index
                            };

                            if (t.note == '') {
                                t.note = false;
                            }

                            total.push(t);

                        });

                    });

                    temporalOrder.forEach(r => total.push(r));

                    if (greek) {
                        greek = 1;
                    } else {
                        greek = 0;
                    }

                    let request = {
                        jsonrpc: "2.0",
                        method: "make-total",
                        params: {
                            "tn": numTable,
                            "to": temporalOrder,
                            "g": greek,
                            "t": total
                        },
                        id: 3,
                    };

                    $.ajax({
                        url: URL,
                        type: 'POST',
                        data: JSON.stringify(request),
                        dataType: 'json',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).done(function () {

                        window.location.reload(true);

                    });

                }
                function noTotalWasPressed() {

                    if ($('#areYouShuarSendTotal').hasClass('areYouShuar2')) {
                        $('#areYouShuarSendTotal').removeClass('areYouShuar2').addClass('areYouShuar1');
                    }

                }

                function sendOrderWasPressed() {

                    if (temporalOrder.length < 1) {

                        return;

                    } else {

                        if ($('#areYouShuarSendOrder').hasClass('areYouShuar1')) {
                            $('#areYouShuarSendOrder').removeClass('areYouShuar1').addClass('areYouShuar2');
                        }

                    }

                }
                function yesSendOrderWasPressed() {

                    let numTable = tableNumber.furstParam + tableNumber.secondParam;

                    if (greek) {
                        greek = 1;
                    } else {
                        greek = 0;
                    }

                    let request = {
                        jsonrpc: "2.0",
                        method: "make-order",
                        params: {
                            "tn": numTable,
                            "to": temporalOrder,
                            "g": greek
                        },
                        id: 2,
                    };
                    $.ajax({
                        url: URL,
                        type: 'POST',
                        data: JSON.stringify(request),
                        dataType: 'json',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).done(function () {

                        window.location.reload(true);

                    });

                }
                function noSendOrderWasPressed() {

                    if ($('#areYouShuarSendOrder').hasClass('areYouShuar2')) {
                        $('#areYouShuarSendOrder').removeClass('areYouShuar2').addClass('areYouShuar1');
                    }

                }

                function cancelOrderWasPressed() {

                    if ($('#areYouShuarCancel').hasClass('areYouShuar1')) {
                        $('#areYouShuarCancel').removeClass('areYouShuar1').addClass('areYouShuar2');
                    }

                }
                function yesCancelWasPressed() {

                    window.location.reload(true);

                }
                function noCancelWasPressed() {

                    if ($('#areYouShuarCancel').hasClass('areYouShuar2')) {
                        $('#areYouShuarCancel').removeClass('areYouShuar2').addClass('areYouShuar1');
                    }

                }

                loadSlick();

                $('#slideMenu').on('tap', 'span.item', function (e) {

                    addItemToTemporalOrder(this);

                });

                $('#leftArrow').on('tap', left);
                $('#rightArrow').on('tap', right);
                $('#addOrder').on('tap', plus);

                $('#drowNote').on('tap', letDrawWithCanvas);

                $('#cancelCanvasText').on('tap', cancelCanvas);

                $('#corektion').on('tap', prepeareForCorection);

                $('#remove').on('tap', deleteThisItems);

                $('#stepBack').on('tap', stepBackFunction);

                $('#done').on('tap', doneFunction);

                $('#history').on('tap', checkHistoryOfThisTable);

                $('#atention').on('tap', atentionFunction);

                $('#total').on('tap', totalWasPressed);
                $('#yesSendTotal').on('tap', yesTotalWasPressed);
                $('#noSendTotal').on('tap', noTotalWasPressed);

                $('#sandOrder').on('tap', sendOrderWasPressed);
                $('#yesSendOrder').on('tap', yesSendOrderWasPressed);
                $('#noSendOrder').on('tap', noSendOrderWasPressed);

                $('#cancelOrder').on('tap', cancelOrderWasPressed);
                $('#yesCancel').on('tap', yesCancelWasPressed);
                $('#noCancel').on('tap', noCancelWasPressed);
            });

        }

    }

    $('#one, #two, #tree, #four, #five, #six, #seven, #eight, #nine').on('tap', keyBoardNumbers);

    $('#zero').on('tap', keyBoardZero);

    $('#delete').on('tap', keyBoardDelete);

    $('#enter').on('tap', keyBoardEnter);
});