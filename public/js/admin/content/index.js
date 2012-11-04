function getFile(){
    $('#revertFiles').val('none', 'selected');
    
    var file = $('#veiwToUpdate');
    var path = {};
    path['file'] = file.attr('value');
    path['editableFile'] = 'TRUE';
    
    if(file.attr('value') != 'none')
    {    
	    $.ajax({
	      type: "POST",
	      url: "/admin/ajax/index",
	      data: { sub: "index", script: "index", params: path }
	    }).done(function(partial) {
	        $('#editContent').html(partial);
	        display(1);
	    });
	}
	else
	{
	    	$('#editContent').html('choose a file to begin');
	        display(0);
	}
	    
}


function getRevertFile(){
    $('#veiwToUpdate').val('none', 'selected');

    var file = $('#revertFiles');
    var path = {};
    path['file'] = file.attr('value');
    path['editableFile'] = 'FALSE';
    
    if(file.attr('value') != 'none')
    {    
	    $.ajax({
	      type: "POST",
	      url: "/admin/ajax/index",
	      data: { sub: "index", script: "index", params: path }
	    }).done(function(partial) {
	        $('#editContent').html(partial);
	        display(0);
	    });
	}
	else
	{
	    	$('#editContent').html('choose a file to begin');
	        display(0);
	}
	    
}

function display(boolCookie){
    
    setTimeout(function(){
    var text  = $('#editContent');
    var data = text.attr('value');

    if(boolCookie == 1)
        setCookie('editedTextarea',data,365);
    
    $('#preview-iframe').contents().find('html').html(data);},
    1000);
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
    
    
    if(fileAndContents['file'] == 'none'){
        alert('You must have a file selected to Save');
        return false;
    }
    
    if(html == ''){
        alert('There is no content to save');
        return false;
    }
   
    if(confirm('Are you sure you want to save this file, this will overwrite the existing contents of the file')){
    $.ajax({
	      type: "POST",
	      url: "/admin/ajax/index",
	      data: { sub: "index", script: "admin_save_updates", params: fileAndContents }
	    }).done(function(partial) {
	        window.location.reload();
	        alert('File Saved!');
	    });
    }
    else
        return false;
}

function refresh() {

    if(confirm('Are you sure you want to refresh the page, you will lose any changes?')){
        window.location.reload();
	}
}

function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
  {
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
var filename = $('#veiwToUpdate').attr('value');
exdate.setDate(exdate.getDate() + exdays);

var c_value= JSON.stringify({'test':value, 'filename':filename});
document.cookie=c_name + "=" + c_value;

}

function checkCookie()
{
var data=getCookie("editedTextarea");
var file = $('#veiwToUpdate');

if (data!=null && data!="")
  {
    data = JSON.parse(data);  
    $('#editContent').html(data.test);
    file.val(data.filename, 'selected');
  }
else 
  {
      $('#editContent').html('Choose a file to get started');
  }
}



