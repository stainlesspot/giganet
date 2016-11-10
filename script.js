$(document).ready(function(){
    $('td.pointerCursor').each(function(){
        if($(this).children('span').text() != '') {
            $(this).removeClass('pointerCursor');
        }
    });
    // ================================================ Add Contract ===================================================
    var listenForClicks = false;
    $(document).click(function(event){
        if(listenForClicks && $(event.target).closest('tr.changeBackgroundColor').length == 0){
            $('.changeBackgroundColor').removeClass('changeBackgroundColor');
        }
    });
    $('.buttonAddContract').click(function (){
        var previousRow = $('.changeBackgroundColor');
        if(previousRow.length != 0)
            previousRow.removeClass('changeBackgroundColor');
        var row = $(this).closest('tr');
        row.addClass('changeBackgroundColor');
        row.after($('<tr class="dummy"><td colspan="8" class="contractContainer"></td></tr><tr></tr>'));
        $('body').append('<div id="screenMask">KON</div>');
        listenForClicks = true;
    });
    // ================================================== Delete Row ===================================================

    $(".buttonRemove").click(function(){
        var row = $(this).closest('tr');
        var rowId = parseInt(row.attr('data-id'));
        $.post("removeCustomer.php", { rowId: rowId })
            .done(function(tookAction){
                if(tookAction == true)
                    slideUpRow(row);
                else
                    alert('Failed to delete row ' + rowId);
            })
            .fail(function(){
                alert('Failed to send data to server!');
            });
    });
    // =================================================== Edit Cell ===================================================

    var value, focused = false;

    $('span.editable').click(function(){changeToInput($(this))});
    $('td.couldBeNull').click(function(){
        if($(this).children('span').text() == ''){
            $(this).removeClass('pointerCursor');
            changeToInput($(this).children('span'));
        }
    });

    $(document).on('blur','#inputCell', function(){
        var text = $(this).val().trim(), activeCell = $('.activeCell'), row = activeCell.closest('tr'),
            allowNull = $(this).attr('data-allowNull'),
            sendEditRequest = (allowNull == 'true' || text != '') && value != text;
        
        var column;
        if(activeCell.hasClass('name')) column = 'CustomerName';
        else if(activeCell.hasClass('location')) column = 'Location';
        else if(activeCell.hasClass('telephone')) {
            column = 'Telephone';
            if(text.length != 10 && text.length != 0) {
                sendEditRequest = false;
                alert('Telephone must be 10 digits!');
                if(value == '')
                    text = '';
            }
        }
        else if(activeCell.hasClass('ipAddress')){
            column = 'IpAddress';
            if(!$(this).fnIsValidFormat('ipv4')){
                sendEditRequest = false;
                alert('Ip Address is not valid!')
            }
        }
        else if(activeCell.hasClass('fee')) column = 'Fee';
        else alert('An error with column names accured!');

        var rowId = (row.attr('data-id'));
        if(sendEditRequest){
            $.post("editCustomer.php", {
                rowId: rowId,
                editedColumn: column,
                newText: text
            })  .done(function(tookAction){
                    if(tookAction)
                        activeCell.text(text);
                    else {
                        activeCell.text(value);
                        alert('Failed to edit cell!');
                    }
                })
                .fail(function(){
                    alert('Failed to send data to server!');
                });
        }
        else
            activeCell.text(value);
        if(allowNull == 'true' && text == '')
            activeCell.closest('td').addClass('pointerCursor');
        activeCell.removeClass('activeCell');
        focused = false;

    });
    $(document).on('keydown', function(event){
        if (event.which == 13 || event.keyCode == 13) {
            event.preventDefault();
            $('#inputCell').blur();
        }
    });


    // =================================================== functions ===================================================
    function slideUpRow(row){
        setTimeout(function () {
                $(row.children('td'))
                    .animate({ paddingTop: 0, paddingBottom: 0 }, 1000)
                    .wrapInner('<div />')
                    .children()
                    .slideUp(500, function() { $(this).closest('tr').remove(); });
            }, 100
        );
    }
    function changeToInput(thisElement){
        if(focused == false) {
            value = thisElement.text();
            var oldWidth =  thisElement.closest('td').width() - 1, maxWidth = 0;
            if(thisElement.hasClass('fee'))
                maxWidth = thisElement.width();

            thisElement.html('');
            thisElement.addClass('activeCell');
            var allowNull = (thisElement.hasClass('location') || thisElement.hasClass('telephone'));
            var newTag = $('<input>').attr({
                    type: 'text',
                    title: 'Редактиране',
                    id: 'inputCell',
                    'data-allowNull': allowNull,
                    value: value
                });
            if(thisElement.hasClass('fee')) {
                newTag.fnNumericInput().css('max-width', maxWidth);
                thisElement.closest('td').css('min-width', oldWidth);
            }
            else {
                newTag.css('min-width', oldWidth);
                if(thisElement.hasClass('telephone')) newTag.fnNumericInput();
                else if(thisElement.hasClass('ipAddress')) newTag.fnCustomInput(/[.0-9]/);
            }
            newTag.appendTo(thisElement);

            var length = $('#inputCell').focus().val().length;
            document.getElementById('inputCell').setSelectionRange(0, length);
            focused = true;
        }
    }
    // ========================================================|========================================================
});

