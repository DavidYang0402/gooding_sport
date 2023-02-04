$(document).ready(function(){
    console.log('hello');
});

$(function(){    
    
    $('input:button').click(function(){
        var textVal = $(this).attr('value');
        $('#cType').val(textVal);
        // $('#changeLb').text('人數');
        // console.log($('#cType').val());
    });
    // $('#type1').click(function(){
    //     $('#changeLb').text('場地數');
    // });
    // $('#type3').click(function(){
    //     $('#changeLb').text('場地數');
    // });


    $('#check').click(function(){
        var textVal1 = $('#inCls').val();
        $('#outCls').val(textVal1);

        var textVal1 = $('#inName').val();
        $('#outName').val(textVal1);

        var textVal1 = $('#inPhNum').val();
        $('#outPhNum').val(textVal1);

        var textVal1 = $('#num').val();
        $('#nType').val(textVal1);

        var textVal = $('#time').val();
        $('#tType').val(textVal);
    });


    var $li = $('ul.tab-title li');
    $($li. eq(0) .addClass('active').find('a').attr('href')).siblings('.tab-inner').hide();

    $li.click(function(){
        $($(this).find('a'). attr ('href')).show().siblings ('.tab-inner').hide();
        $(this).addClass('active'). siblings ('.active').removeClass('active');
    });
});