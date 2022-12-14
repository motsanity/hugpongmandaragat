$(document).ready(function(){
	var records = [];
	// page, class
	ajaxTable(1, 1, 1);
	ajaxTable(1, 1, 0);
	
	$("#member-status").on("change", function(){
		var member_status = $(this).val();
		ajaxTable(1, member_status);
		ajaxTable(1, member_status, 1);
	});
	
	
	$(document).on("click", "#pagination .btn", function(event){
		var id = $(this).attr("id");
		var member_status = $("#member-status").val();

		ajaxTable(id, member_status, 1);
		ajaxTable(id, member_status, 0);

	})
	
	function updateButtons(id){	
		$("body #pagination .btn-success").removeAttr("class").attr("class", "btn btn-sm btn-outline-success");
		$("body #pagination #" + id).attr("class", "btn btn-sm btn-success");
	}
	
	function ajaxTable(id, status, action){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                records = (this.responseText);
				if (action == 1){
					$("#pages").html(records);
					updateButtons(id);
				}
				else
					$("#ajax-table tbody").html(records);
				
            }
        };
        xmlhttp.open("GET", "log_pagination.php?page=" + id + "&s=" + status + "&action=" + action, true);
        xmlhttp.send();
	};
	
	$('body').on('click', '.image-user', function(){
		var link = $(this).attr("src");
		$("#imageModal .modal-body img").attr("src", link);
		
		$("#imageModal").show();
	});
	$('body').on('click', '.action button', function() {
	    if (confirm("Continue?") == 1){
	    	location.href = $(this).attr("href");
	    }
	});
});
