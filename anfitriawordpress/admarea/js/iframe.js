function imagem(){
    
    $('#jumpMenu').change(function(){
        url = window.location;
        url = url.toString();
        logo = $(this).val();
        new_url = url.replace(/logo=\w+/,'logo='+logo);
        window.location = new_url;
    });

}