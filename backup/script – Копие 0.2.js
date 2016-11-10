$(document).ready(function(){
    $('td.pointerCursor').each(function(){
        if($(this).children('span').text() != '') {
            $(this).removeClass('pointerCursor');
        }
    });
    $(".buttonRemove").click(function(){
        var row = $(this).closest('tr');
        var rowId = parseInt(row.attr('data-id'));
        $.post("removeCustomer.php", { rowId: rowId })
            .done(function(tookAction){
                if(tookAction == true) {
                    slideUpRow(row);
                    var status = 'ok';
                }
                else
                    alert('Failed to delete row ' + rowId);
                alert("Data: " + data + "\nStatus: " + status + "\nbool: " + (data==true));
            })
            .fail(function(){
                alert('Failed to send data to server!');
            });
    });

    var value, focused = false;

    $('span.editable').click(function(){changeToInput($(this))});
    $('td.couldBeNull').click(function(){
        if($(this).children('span').text() == ''){
            $(this).removeClass('pointerCursor');
            changeToInput($(this).children('span'));
        }
    });

    $(document).on('blur','#inputCell', function(){
        var text = $(this).val().trim();
        var activeCell = $('.activeCell');
        if($('#inputCell').attr('data-allowNull') == 'true') {
            activeCell.text(text);
            if(text == '')
                activeCell.closest('td').addClass('pointerCursor');
        }
        else {
            if (text == '')
                activeCell.text(value);
            else
                activeCell.text(text);
        }
        activeCell.removeClass('activeCell');
        focused = false;
    });
    $(document).on('keydown', function(event){
        if (event.which == 13 || event.keyCode == 13) {
            event.preventDefault();
            $('#inputCell').blur();
        }
    });


    $.fn.selectRange = function(start, end) {
        if(end === undefined) {
            end = start;
        }
        return this.each(function() {
            if('selectionStart' in this) {
                this.selectionStart = start;
                this.selectionEnd = end;
            }
            else if(this.createTextRange) {
                var range = this.createTextRange();
                range.collapse(true);
                range.moveEnd('character', end);
                range.moveStart('character', start);
                range.select();
            }
            else{
                this.setSelectionRange(start, end);
            }
        });
    };
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
            var oldWidth =  thisElement.closest('td').width(), maxWidth = 0;
            if(thisElement.hasClass('fee')) {
                maxWidth = thisElement.width();
                oldWidth = 0;
            }
            thisElement.html('');
            thisElement.addClass('activeCell');
            var allowNull = false;
            if(thisElement.hasClass('location') || thisElement.hasClass('telephone'))
                allowNull = true;
            $('<input>').attr({
                    'type': 'text',
                    'name': 'inputCell',
                    'title': 'Редактиране',
                    'id': 'inputCell',
                    'data-allowNull': allowNull,
                    'value': value
                })
                .css({
                    'min-width': oldWidth,
                    'max-width': maxWidth
                })
                .appendTo(thisElement);
            //$('#inputCell').focus();
            var length = $('#inputCell').focus().val().length;
            document.getElementById('inputCell').setSelectionRange(length, length);
            //$('inputCell').selectRange(length, length);
            //alert('done');
            focused = true;
        }
    }
});

