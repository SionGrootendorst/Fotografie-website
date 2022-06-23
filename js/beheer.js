const hideDiv = document.getElementsByClassName('hidden-Div');

const btn = document.getElementsByClassName('button-Show');

for (let i = 0; i < btn.length; i++) {
    btn[i].addEventListener('click', () => {
        if (hideDiv[i].style.display === 'block') {
            hideDiv[i].style.display = 'none';
        } else {
            hideDiv[i].style.display = 'block';
        }
    });
}

$('#profiel_container').hide();
$('#donatie_container').hide();
$('#accounts_container').hide();


$('.sidenav_item').click(function () {
    // let id = $(this.id);
    let id = this.id;

    $('#profiel_container').show();
    $('#donatie_container').hide();
    $('#accounts_container').hide();

    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {'id': id},
        dataType: 'json'
    })
        .done(function show(data) {

            console.log(data)

            $('#naam').text(data.naam);
            $('#video').attr('src', data.video);

            $('#omschrijving').html(
                '<h4>omschrijving: </h4><br>' +
                '<p>' + data.omschrijving + '</p>'
            );

            $('#button_container').html(
                '<button onclick="keep(data.id)" class="button button_ja" id="' + data.id + '"><i class="fas fa-check"></i></button>' +
                '<button class="button button_nee" id="' + data.id + '"><i class="fas fa-trash-alt"></i></button>'
            )

            $('#doel_bedrag').html(
                '<h4>Doneer doel: </h4><br>' +
                '<label for="bedrag">Doneer doel: </label>' +
                '<span id="bedrag"> ' + data.doelBedrag + '</span>'
            );

            $('#gedoneerd').html(
                '<label for="bedrag">Gedoneerd: </label>' +
                '<span id="bedrag"> ' + data.gedoneerd + '</span>'
            );

            $('#tegenprestaties').html(
                '<h4>Tegenprestaties: </h4><br>'
            )
            for (let i = 0; i < data.tegenprestaties.length; i++) {
                $('#tegenprestaties').append(
                    '<p>Voor ' + data.tegenprestaties[i].bedrag + ' krijgt u ' + data.tegenprestaties[i].tegenprestatie + '</p>'
                )
            }

            $('#fotos').html(
                '<h4>Fotos: </h4><br>'
            )

            for (let i = 0; i < data.fotos.length; i++) {
                $('#fotos').append(
                    '<img class="foto" src="fotos/' + data.fotos[i].foto + '">'
                )
            }

        })
})

$('#sidenav_donatie').click(function () {
    $('#donaties').show();
    $('#goedkeuring').hide();
    $('#accounts').hide();
})

$('#sidenav_goedkeuring').click(function () {
    $('#donaties').hide();
    $('#goedkeuring').show();
    $('#accounts').hide();
})

$('#sidenav_accounts').click(function () {
    $('#donaties').hide();
    $('#goedkeuring').hide();
    $('#accounts').show();
})


$(document).on('click', '.button_ja', function () {
    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {'IDJa': this.id},
    }).done(function () {
        location.reload();
    })
});

$(document).on('click', '.button_nee', function () {
    let id = this.id;
    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {'IDNee': id},
    }).done(function (data) {
        location.reload();
    })
});

$('#alle_donaties').click(function () {
    $('#donatie_table').html(
        '<tr>' +
        ' <th>Ontvanger</th>' +
        ' <th>Donateur</th>' +
        ' <th>Email Donateur</th>' +
        ' <th>Bedrag</th>' +
        ' <th>Tegenprestatie</th>' +
        ' <th></th>' +
        '</tr>'
    );
    $('#profiel_container').hide();
    $('#donatie_container').show();
    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {'allDonations': 'allDonations'},
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
        for (let i = 0; i < data.length; i++) {

            $('#donatie_table').append(
                '<tr>' +
                '<td class="ontvanger">' + data[i].naam_student + '</td>' +
                '<td class="donateur">' + data[i].naam_donateur + '</td>' +
                '<td class="email_donateur">' + data[i].email_donateur + '</td>' +
                '<td class="bedrag">' + data[i].bedrag + '</td>' +
                '<td class="tegenprestatie">' + data[i].tegenprestatie + '</td>' +
                '</tr>'
            )
        }


    })
})

$('#accounts_container').click(function () {
    $('#accounts_table').html(
        '<tr>' +
        ' <th>Ontvanger</th>' +
        ' <th>Donateur</th>' +
        ' <th>Email Donateur</th>' +
        ' <th>Bedrag</th>' +
        ' <th>Tegenprestatie</th>' +
        ' <th></th>' +
        '</tr>'
    );
    $('#profiel_container').hide();
    $('#donatie_container').hide();
    $('#accounts_container').show();

    let id = this.id;
    $.ajax({

        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {'NeeID': id},
        dataType: 'json'
    }).done(function (data) {

    })
})

$(document).on('click', '.sidenav_item1', function show () {
    let email = this.id;

    $('#donatie_table').html(
        '<tr>' +
        ' <th>Ontvanger</th>' +
        ' <th>Donateur</th>' +
        ' <th>Email Donateur</th>' +
        ' <th>Bedrag</th>' +
        ' <th>Tegenprestatie</th>' +
        ' <th></th>' +
        '</tr>'
    );

    $('#profiel_container').hide();
    $('#donatie_container').show();
    $('#accounts_container').hide();

    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {'email': email},
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
        for (let i = 0; i < data.length; i++) {

            $('#donatie_table').append(
                '<tr>' +
                '<td class="ontvanger">' + data[i].naam_student + '</td>' +
                '<td class="donateur">' + data[i].naam_donateur + '</td>' +
                '<td class="email_donateur">' + data[i].email_donateur + '</td>' +
                '<td class="bedrag">' + data[i].bedrag + '</td>' +
                '<td class="tegenprestatie">' + data[i].tegenprestatie + '</td>' +
                '<td class="verwijder"><div class="delete" id="' + data[i].id + '"><i class="fas fa-times-circle"></i></div></td>' +
                '</tr>'
            )
        }
    })
})

$(document).on('click', '.delete', function () {

    let id = this.id;

    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {deleteID: id},
    }).done(function (data) {
        console.log(data);
        location.reload();
    })
})

$('.sidenav_item2').click(function () {
    // let id = $(this.id);
    let id = this.id;

    $('#profiel_container').hide();
    $('#donatie_container').hide();
    $('#accounts_container').show();

    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {'idProfiel': id},
        dataType: 'json'
    })
        .done(function show(data) {

            console.log(data)

            $('#naam1').text(data.naam);
            $('#video1').attr('src', data.video);

            $('#omschrijving1').html(
                '<h4>omschrijving: </h4><br>' +
                '<p>' + data.omschrijving + '</p>'
            );

            $('#button_container1').html(
                '<button class="button button_nee" id="' + data.id + '"><i class="fas fa-trash-alt"></i></button>'
            )

            $('#doel_bedrag1').html(
                '<h4>Doneer doel: </h4><br>' +
                '<label for="bedrag">Doneer doel: </label>' +
                '<span id="bedrag"> ' + data.doelBedrag + '</span>'
            );

            $('#gedoneerd1').html(
                '<label for="bedrag">Gedoneerd: </label>' +
                '<span id="bedrag"> ' + data.gedoneerd + '</span>'
            );

            $('#tegenprestaties1').html(
                '<h4>Tegenprestaties: </h4><br>'
            )
            for (let i = 0; i < data.tegenprestaties.length; i++) {
                $('#tegenprestaties1').append(
                    '<p>Voor ' + data.tegenprestaties[i].bedrag + ' krijgt u ' + data.tegenprestaties[i].tegenprestatie + '</p>'
                )
            }

            $('#fotos1').html(
                '<h4>Fotos: </h4><br>'
            )

            for (let i = 0; i < data.fotos.length; i++) {
                $('#fotos1').append(
                    '<img class="foto" src="fotos/' + data.fotos[i].foto + '">'
                )
            }

        })
})

$('#save_btn').click(function() {

    let naam = $('#b_naam').val();
    let email = $('#b_email').val();

    $.ajax({
        url: 'beheerPaginaVerwerk.php',
        method: 'POST',
        data: {b_email: email, b_naam: naam},
    }).done(function (data) {
        console.log(data);
    })

})