$(function(){
    
    $('.lightbox-img').click(function(){
        var img = $(this).find('img');    
        $('.lightbox-img').removeClass('active');
        $(this).addClass('active');
        
        $('.lightbox .modal-content').html('<img src="' + img[0].src + '" class="img-responsive"/>');
        $('.lightbox').modal('show');
    });
    
    
function changeLightboxImg(newImg) {
    $('.lightbox .modal-content').html('<img src="' + newImg + '" class="img-responsive"/>');
}
    
    
    
document.onkeydown = checkKey;

function checkKey(e) {

    e = e || window.event;
    
    $('.profile-photos');

    if (e.keyCode == '38') {
        // up arrow
    }
    else if (e.keyCode == '40') {
        // down arrow
    }
    else if (e.keyCode == '37') {
       // left arrow
       var elem = $('.lightbox-img.active');
       var newImg = elem.prev().find('img').attr('src');
       $('.lightbox-img').removeClass('active');
       elem.prev().addClass('active');
       changeLightboxImg(newImg)
       console.log(newImg);
    }
    else if (e.keyCode == '39') {
       // right arrow
       var elem = $('.lightbox-img.active');
       var newImg = elem.next().find('img').attr('src');
       $('.lightbox-img').removeClass('active');
       elem.next().addClass('active');
       changeLightboxImg(newImg)
       console.log(newImg);
    }

}





    $('.episode-item').click(function(e){
        e.preventDefault();
        var media_id = $(this).attr('data-media-id');
        var newSrc = 'https://www.youtube.com/embed/' + media_id + '?modestbranding=1&showinfo=0&playsinline=1&autoplay=1';

        $('#episodeModal').find('iframe').attr('src',newSrc);
        $('#episodeModal').modal('show');

    });
    
    
    
    
        
});