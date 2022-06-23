// Loop voor tegenprestaties
for (let i = 0; i < 8; i++) {

    if (i !== 0) {
        $('#' + i).hide();
    }
    $('#tp_btn_' + i).click(function () {

        let bedrag = $('#tp_bedrag_' + i).val();
        let text = $('#tp_text_' + i).val();

        $('.tp').append(
            '<p><b>Tegenprestatie ' + (i + 1) + ':</b><br>Voor €' + bedrag + ' Krijgt u ' + text +
            '<input type="hidden" name="bedrag[]" value="' + bedrag + '">' +
            '<input type="hidden" name="tegenprestatie[]" value="' + text + '"></p>'
        )

        let id = i + 1;
        $('#' + id).show();
        $('#' + i).hide();
        $('#' + i).children('input').val('');
    })
}

// Script voor profiel pagina breadcrum
let itemIndex = 0;

// Alle item containers
let ItemsArray = [
    'naam_container',
    'videoURL_container',
    'profielFoto_container',
    'doneerDoel_container',
    'tegenprestatie_container',
    'omschrijving_container',
    'fotos_container'
];

for (let i = 0; i < 7; i++) {
    $('#bc_' + i).click(() => {

        //breadcrum updaten
        $('.active').removeClass('active');
        $('#bc_' + i).addClass('active');

        // Alle items verbergen
        hideAll();

        $('#' + ItemsArray[i]).show();

        itemIndex = i;
    })
}

// breadcrum items laten zien
$('.next_item').click(() => {
    $('#' + ItemsArray[itemIndex]).hide();
    $('.active').removeClass('active');

    itemIndex += 1;

    $('#' + ItemsArray[itemIndex]).show();
    $('#bc_' + itemIndex).addClass('active');
})

// Vorige item laten zien
$('.prev_item').click(() => {
    $('#' + ItemsArray[itemIndex]).hide();
    $('.active').removeClass('active');

    itemIndex += -1;

    $('#' + ItemsArray[itemIndex]).show();
    $('#bc_' + itemIndex).addClass('active');
})

function hideAll() {
    for (let i = 0; i < 7; i++) {
        $('#' + ItemsArray[i]).hide();
    }
}

//profiel foto updaten
window.addEventListener("load", event => {
    let image = $('.profiel_img');
    let isLoaded = image.complete && image.naturalHeight !== 0;

    if (isLoaded === undefined) {
        $('.profiel_img').attr('src', 'img/default.jpg')
    }

});



