$(function(){
    $('.avatar').on('click',function() {
        $('.avatar').css('transition','all 1s ease-in-out 0.3s');
        $('.avatar').css('transform','rotate(360deg)');
        $('.dropDown').slideToggle('slow');
        return false
    })
})
