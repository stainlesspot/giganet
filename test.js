$(document).ready(function(){
    /*$('.tester').click(function(e){
        alert('clicked' + $(this).prop('tagName'));
        e.stopPropagation();
    });*/
    $('div.tester').click(function(){

    });
    $('.konnectikut').click(function (){
        $('.testerous').toggleClass('animate');
    });
    $('#testButton').click(function(){
        insertText('DRAFTED');
    });
    var value = "1234";
    $('.buttonTest').click(function(){
        $('<input>').attr({
            type: 'text',
            id: 'inputCell',
            value: value
        }).fnCustomInput(/[0-9]/).appendTo($('.popup'));
    });
    $('.testIP').click(function(){
        alert($('#test').fnIsValidFormat('ipv4') ? 'VALID!' : 'NOT VALID IPv4!' + ' - ' + $('#test').val());
    });
    function insertText(text) {
        var textarea = document.getElementById("test");
        var val = textarea.value;
        var start = textarea.selectionStart, end = textarea.selectionEnd;

        textarea.value = val.slice(0, start) + text + val.slice(end);
        textarea.focus();
        var caretPos = start + text.length;
        textarea.setSelectionRange(caretPos, caretPos);
    }
    $.fn.extend({
        editable: function () {
            $(this).each(function () {
                var $el = $(this),
                    $edittextbox = $('<input type="text"></input>').css('min-width', $el.width()),
                    submitChanges = function () {
                        if ($edittextbox.val() !== '') {
                            $el.html($edittextbox.val());
                            $el.show();
                            $el.trigger('editsubmit', [$el.html()]);
                            $(document).unbind('click', submitChanges);
                            $edittextbox.detach();
                        }
                    },
                    tempVal;
                $edittextbox.click(function (event) {
                    event.stopPropagation();
                });

                $el.dblclick(function (e) {
                    tempVal = $el.html();
                    $edittextbox.val(tempVal).insertBefore(this)
                        .bind('keypress', function (e) {
                            var code = (e.keyCode ? e.keyCode : e.which);
                            if (code == 13) {
                                submitChanges();
                            }
                        }).select();
                    $el.hide();
                    $(document).click(submitChanges);
                });
            });
            return this;
        }
    });
    $('#demoTest').editable();
});