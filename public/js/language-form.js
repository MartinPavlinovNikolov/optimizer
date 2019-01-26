jQuery(document).ready(function ($) {
    const URL = 'http://optimizer.com/json-rpc.php';

    $('#language').change(function () {
        let param = $('option:selected', this).attr('data-lang');
        let request = {
            jsonrpc: '2.0',
            method: 'switch-language',
            params: [param],
            id: 5
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
    });
});