function getFile(){
    var file = $('#veiwToUpdate');
    var path = {};
    path['file'] = file.attr('value');
    
    if(file.attr('value') != 'none')
    {    
	    $.ajax({
	      type: "POST",
	      url: "/admin/ajax/index",
	      data: { sub: "index", script: "index", params: path }
	    }).done(function(partial) {
	        $('#editContent').html(partial);
	        display();
	    });
	}
}

function display(){
    var text  = $('#editContent');
    var data = text.attr('value');
    $('#preview-iframe').contents().find('html').html(data);
}

function newtab(){
    var links=document.getElementById('help').getElementsByTagName('a'), len=links.length, i;
    for (i=len; i--;) { links[i].target='my_external_window'; }
}

function saveFile(){

    var fileAndContents = {};
    var file = $('#veiwToUpdate');
    var html = $('#editContent');
    
    fileAndContents['html'] = html.attr('value');
    fileAndContents['file'] = file.attr('value');
    
    var file = $('#veiwToUpdate');
    
    
    if(fileAndContents['file'] == 'none'){
        alert('You must have a file selected to Save');
        return false;
    }
   
    if(confirm('Are you sure you want to save this file, this will overwrite the existing contents of the fie')){
    $.ajax({
	      type: "POST",
	      url: "/admin/ajax/index",
	      data: { sub: "index", script: "admin_save_updates", params: fileAndContents }
	    }).done(function(partial) {
	        alert('File Saved!');
	    });
    }
    else
        return false;
}

function uploadImage(){
    alert('add this image please');    
}
