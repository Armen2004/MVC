$(document).ready(function () {

    //HIDING MASSAGES
    $('#createSuccess').hide();
    $('#createError').hide();
    $('#searchResult').hide();

    //CREATE CONTACT FUNCTIONALITY
    var createContact = $('#createContact');
    CreateItems(createContact);

    //CREATE EMAIL FUNCTIONALITY
    var createEmail = $('#createEmail');
    CreateItems(createEmail);

    //CREATE PHONE NUMBER FUNCTIONALITY
    var createPhone = $('#createPhone');
    CreateItems(createPhone);

    //CREATE ADDRESS FUNCTIONALITY
    var createAddress = $('#createAddress');
    CreateItems(createAddress);

    //UPDATE CONTACT FUNCTIONALITY
    var updateContact = $('#updateContact');
    CreateItems(updateContact);

    //UPDATE EMAIL FUNCTIONALITY
    var updateEmail = $('#updateEmail');
    CreateItems(updateEmail);

    //UPDATE PHONE NUMBER FUNCTIONALITY
    var updatePhone = $('#updatePhone');
    CreateItems(updatePhone);

    //UPDATE ADDRESS FUNCTIONALITY
    var updateAddress = $('#updateAddress');
    CreateItems(updateAddress);

    //DELETE FUNCTIONALITY
    var deleteData = $('.deleteData');
    deleteData.each(function () {
        DeleteItem($(this));
    });

    //SEARCH FUNCTIONALITY
    var searchData = $('#searchData');
    SearchItem(searchData);

});

function CreateItems(clickedData) {
    clickedData.submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url, {data: data}, "json")
                .done(function (data) {
                    console.log(data);
                    obj = JSON.parse(data);
                    if (obj.status) {
                        window.location.href = window.location.origin + window.location.pathname + '?url=index/view/' + obj.uuid;
                        $('#createSuccess').show();
                        $('#createError').hide();
                        $('#createSuccess').children('strong').text(obj.massage);
                    } else {
                        $('#createSuccess').hide();
                        $('#createError').show();
                        $('#createError').children('strong').text(obj.massage);
                    }
                })
                .fail(function () {
                    alert("error");
                });
    });
}

function DeleteItem(clickedData) {
    clickedData.click(function (e) {
        e.preventDefault();
        var table = $(this).attr('data-table');
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var uuid = $(this).attr('data-uuid');
        var data = [];
        data["table"] = table;
        data["id"] = id;
        $.post(url, {id: id, table: table}, "json")
                .done(function (data) {
                    console.log(data);
                    obj = JSON.parse(data);
                    console.log(obj);
                    if (obj.status) {
                        if (table == 'contacts') {
                            window.location.href = window.location.origin + window.location.pathname + '?url=index/index/';
                        } else {
                            window.location.href = window.location.origin + window.location.pathname + '?url=index/view/' + uuid;
                        }
                        $('#createSuccess').show();
                        $('#createError').hide();
                        $('#createSuccess').children('strong').text(obj.massage);
                    } else {
                        $('#createSuccess').hide();
                        $('#createError').show();
                        $('#createError').children('strong').text(obj.massage);
                    }
                })
                .fail(function () {
                    alert("error");
                });
    });
}

function SearchItem(clickedData) {
    clickedData.submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var table = $('#selectedField :selected').attr('data-table');
        var url = $(this).attr('action');
        $.post(url, {data: data, table: table}, "json")
                .done(function (data) {
                    obj = JSON.parse(data);
                    if (obj.status) {
                        $('#createSuccess').show();
                        $('#createError').hide();
                        $('#createSuccess').children('strong').text(obj.massage);
                        $('#searchResult').show();
                        var result = JSON.stringify(JSON.parse(obj.result), undefined, 2);
                        $('#searchResult').html(result);
                    } else {
                        $('#createSuccess').hide();
                        $('#createError').show();
                        $('#createError').children('strong').text(obj.massage);
                    }
                })
                .fail(function () {
                    alert("error");
                });
    });
}