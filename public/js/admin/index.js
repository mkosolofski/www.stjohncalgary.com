function getFile(){
    var file = $('#veiwToUpdate');
    var directory = 'index';
    var file = 'index';

	$.ajax({
	  type: "POST",
	  url: "ajax/index",
	  data: { sub: "index", script: "index" }
	}).done(function(partial) {
	    $('#editContent').html(partial);
	alert('did it');
	});
}

function display(){
    var text  = $('#editContent');
    var data = text.attr('value');
    $('#preview-iframe').contents().find('html').html(data);
}
