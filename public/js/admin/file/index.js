function removeImage(image){

    var path = {};
    path['file'] = image;
    
     
    if(confirm('Are you sure you want to delete ' + path['file'])){
        $.ajax({
          type: "POST",
          url: "/admin/ajax/index",
          data: { sub: "index", script: "remove_image", params: path }
        }).done(function() {
            window.location.reload();
        });
    }
}
