
var count = $('.count-chars');
$('.cke_contents_ltr p').keyup(function () {

    console.log($(this).val().length);

    count.text($(this).val().length);

    if($(this).val().length > 1200)
    {
        $('.count-chars').css('color', 'red')
    }
    else
    {
        $('.count-chars').css('color', 'green')
    }
});

