$(document).ready(function () {    
    $('a.avro-star').hover(function() {
        $(this).parent().find('a.avro-star').removeClass('avro-star-on avro-star-off');
        $(this).prevAll('a.avro-star').addClass('avro-star-on');
        $(this).addClass('avro-star-on');
        $(this).nextAll('a.avro-star').addClass('avro-star-off');
    });
    $('#avroStarContainer').mouseleave(function() {
        $(this).find('a.avro-star').removeClass('avro-star-on avro-star-off');
        $(this).find('a.avro-star').each(function() {
            $(this).addClass($(this).data('original'));
        });
    });
});
