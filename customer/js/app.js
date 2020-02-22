var from = null, start = 0, url = 'http://localhost/customer/controlers/chat.php';

var formm = document.getElementById('formm');

$(document).ready(function () {


    from = session;
    load();
    $(formm).submit(function (e) {
        $.post(url,{message: $('#message').val(), from: from});

        $('#message').val('');

        return false;

    });
});

function load() {
    $.get(url + '?start=' + start, function (result) {
        if(result.items){
            result.items.forEach(item => {
                start = item.id;
                $('#messages').append(renderMessage(item));
            });
            $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
        }
        load();

    })
}

function renderMessage(item) {
    let date = new Date(item.created);

    return `<div class="msg"><p>${item.from}</p>${item.message}<span>${date}</span></div>`
}


