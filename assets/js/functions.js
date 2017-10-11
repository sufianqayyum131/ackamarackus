// ADD TABLE CLASS
var AddTableRow = {
	add:function(tableID) {
		var $row = $("#" + tableID).find('tr:last');
  		$row.clone().insertBefore($row).show();
	},
	del:function(tableID,row) {
	  	$("#" + tableID + " tbody").find('input[name="delRow"]').each(function(){
	    	if($(this).is(":checked")){
	        	$(this).parents("tr").remove();
	        }
	    });
	}
};

// Image Upload UI PLugin INIT
function initImageFileUploadUI() {
	$(".profileImageInput").fileinput({
	    overwriteInitial: true,
	    maxFileSize: 1500,
	    showClose: true,
	    showCaption: false,
	    browseLabel: '',
	    removeLabel: '',
	    browseIcon: '<i class="fa fa-folder-open fa-fw"></i>',
	    removeIcon: '<i class="fa fa-close fa-fw"></i>',
	    removeTitle: 'Cancel or reset changes',
	    elErrorContainer: '#kv-avatar-errors-1',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img src="assets/images/default_avatar_male.jpg" alt="Your Avatar">',
	    layoutTemplates: {main2: '{preview} {browse}'},
	    allowedFileExtensions: ["jpg", "png", "gif"],
	    
	});
	$(".imageFileinput").fileinput({
		showUpload: false
	});
}

// Show Response Message From Server To Alert Box 
function showResponseMessage(a,b,c,d) {
	swal({
	  	title: a,
	  	text: b,
	  	type: c,
	  	confirmButtonText: d,
	  	animation: false,
  		customClass: 'animated zoomIn'
	});
}

// Change Text To Icon On Button During Ajax Call
function textToIconButton() {
	if ($("#submit").hasClass("submit")) {
		$("#submit").html("SUBMIT <i class='fa fa-spinner fa-spin fa-fw'></i>");
		$("#submit").removeClass("submit");
	}
	else {
		$("#submit").html("");
		$("#submit").html("SUBMIT");
		$("#submit").addClass("submit");
	}
		
}

$(document).ready(function() {
	$('.icheckButtons').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue'
	});
});
