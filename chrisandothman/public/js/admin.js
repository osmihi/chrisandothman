$(function() {

	$('#adminKeyBtn').click(adminKeyBtnClick);	
});

function adminKeyBtnClick() {
	$.ajax({
		url : "http://api.chrisandothman.com/?authorize=true",
		type : "POST",
		data : 'adminKey=' + $('#adminKey').val(),
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		error : function(response, textStatus, errorThrown) {},
		success : function(r) {
			$('#adminForm').hide();
			$('#adminArea').html('<p>Authorized.</p>');
		}
	});	
}

function showAdminControl