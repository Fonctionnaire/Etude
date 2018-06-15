var count = $('.count-chars');

$('#contact_texte').keyup(function () {

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