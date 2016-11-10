$(document).ready(function(){
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
    $('.editable').click(function(){
        if(focused == false){
            var thisElement = $(this);
            var tableCell = thisElement.closest('td');
            value = thisElement.text();
            if(thisElement.prop('tagName') == 'TD') {
                thisElement.removeClass('editable');
                var child = thisElement.children();
                if(child.prop('tagName') == 'SPAN'){
                    thisElement = child.addClass('wasEmpty');
                }
            }
            thisElement.html('');
            thisElement.addClass('activeCell');
                $('<input>')
                    .attr({
                        'type': 'text',
                        'name': 'inputCell',
                        'title': 'Редактиране',
                        'id': 'inputCell',
                        'value': value
                    })
                    .css('width', tableCell.width())
                    .appendTo(thisElement);
            $('#inputCell').focus();
            focused = true;
        }
    });
    $(document).on('blur','#inputCell', function(){
        var text = $(this).val().trim();
        var activeCell = $('.activeCell');
        if(activeCell.hasClass('wasEmpty')){
            if(activeCell.text != '')
                activeCell.closest('td').removeClass('editable');
            activeCell.removeClass(('wasEmpty'));
        }
        if (text == '')
            activeCell.text(value);
        else{
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
    $('.testButton').click(function(){
        $('p.testable').html('width: ' + $('.editable').width() + ' css: ' + $('.editable').css('width'));
    });

});

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