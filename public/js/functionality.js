$(document).ready(function () {

    //HIDING MASSAGES
    $('#createSuccess').hide();
    $('#createError').hide();

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
    //var updateContact = $('#updateContact');
    //CreateItems(updateContact);

});

function CreateItems(clickedData){
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

/*
 $( document ).ready(function() {
 $('[data-toggle="tooltip"]').tooltip();

 var table = $("#table");

 //creating new database
 var create_new_database = $("#create_new_database");
 create_new_database.click(function(){
 //data.
 });

 //editing correct database
 var edit_DB = $("#edit_DB");
 edit_DB.click(function(){
 alert("456");
 });

 //deleting correct database
 var delete_DB = $("#delete_DB");
 delete_DB.click(function(){
 alert("123");
 });

 //creating new table in correct database
 var create_table = $(".create_table");
 create_table.click(function(){
 var databaseName  = $(this).attr('data-db');
 if(table.hasClass('hidden')){
 table.removeClass('hidden');
 field_types();
 }else{
 table.addClass('hidden');
 }
 $("#databaseName").val(databaseName);
 });

 //creating new table in correct database
 var edit_table = $("#edit_table");
 edit_table.click(function(){
 alert("852");
 });

 //deleting table in correct database
 var delete_table = $("#delete_table");
 delete_table.click(function(){
 alert("963");
 });


 var table_form = $("#table_form");

 var add_new_field = $("#add_new_field");
 var x = 1;
 add_new_field.click(function(){
 var maxFields = $("#maxFields").val();
 if(!maxFields){
 maxFields = 10;
 if( x < maxFields){
 table_form.append('' +
 '<div class="row" data-id="' + x + '">' +
 '<div class="col-lg-5">' +
 '<div class="form-group">' +
 '<input type="text" name="field_name_' + x + '" class="form-control input" required placeholder="Field name">' +
 '</div>' +
 '</div>' +
 '<div class="col-lg-4">' +
 '<div class="form-group">' +
 '<select name="field_type_' + x + '" class="form-control input" required>' +
 '<option value="0">Select field type</option>' +
 '<option value="INT">INT</option>' +
 '<option value="VARCHAR">VARCHAR</option>' +
 '<option value="TEXT">TEXT</option>' +
 '</select>' +
 '</div>' +
 '</div>' +
 '<div class="col-lg-3">' +
 '<div class="form-group">' +
 '<input type="number" name="field_length_' + x + '" class="form-control input" required placeholder="Field Length">' +
 '</div>' +
 '</div>' +
 '</div>');

 x++;
 }
 }else{
 for(var i = 1; i <= maxFields; i++){
 table_form.append('' +
 '<div class="row" data-id="' + i + '">' +
 '<div class="col-lg-5">' +
 '<div class="form-group">' +
 '<input type="text" name="field_name_' + i + '" class="form-control input" required placeholder="Field name">' +
 '</div>' +
 '</div>' +
 '<div class="col-lg-4">' +
 '<div class="form-group">' +
 '<select name="field_type_' + i + '" class="form-control input" required>' +
 '<option value="0">Select field type</option>' +
 '<option value="INT">INT</option>' +
 '<option value="VARCHAR">VARCHAR</option>' +
 '<option value="TEXT">TEXT</option>' +
 '</select>' +
 '</div>' +
 '</div>' +
 '<div class="col-lg-3">' +
 '<div class="form-group">' +
 '<input type="number" name="field_length_' + x + '" class="form-control input" required placeholder="Field Length">' +
 '</div>' +
 '</div>' +
 '</div>');
 }
 }
 console.log(x);
 });

 var tableField = $("#tableField");
 tableField.submit(function(e){
 e.preventDefault();
 var data = $(this).serialize();
 var url = $(this).attr('action');
 var a = true;
 table.find(".input").each(function(){
 var value = $(this).val();
 if(value && value != 0){
 $(this).parent("div").removeClass("has-error").addClass("has-success");
 }else{
 $(this).parent("div").removeClass("has-success").addClass("has-error");
 a = false

 }
 //data[$(this).attr('name')] = $(this).val();
 //console.log($(this).attr('name') + ' - ' + $(this).val())
 });
 if(!a){
 return false;
 }
 //        console.log(a);
 var count = table_form.children('div[data-id]').length;
 //        console.log(data);
 //        console.log(url);

 $.post( url, { data: data, count: count })
 .done(function( data ) {
 obj = JSON.parse(data);
 alert(obj.massage);
 })
 .fail(function() {
 alert( "error" );
 });
 });




 var databaseField = $("#databaseField");
 databaseField.submit(function(e){
 e.preventDefault();
 var data = $(this).serialize();
 var url = $(this).attr('action');
 console.log(data);
 console.log(url);
 $.post( url, { data: data })
 .done(function( data ) {
 obj = JSON.parse(data);
 alert(obj.massage);
 })
 .fail(function() {
 alert( "error" );
 });
 });
 });
 }

 //get all field types
 function field_types(){
 var field_type = $("select");
 var field_name = field_type.attr('name');
 var field_length = field_type.length;
 console.log(field_length);
 }
 */