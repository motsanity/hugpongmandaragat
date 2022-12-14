$(function(){

	$("#claim-submit").on("click", function(event){
		if (confirm("Continue?") != 1){
			event.preventDefault();
		}
	});

	var claim_amt = 0;
	$("#claim-classification").on("change", function(){
		var claim = $(this).val();
		if (mode){
			if ($("#user-name").val() != ""){
				var user_id = $("#user-name").val();
				ajaxClaim(claim, user_id, mode);
			}
		}
		else 
			ajaxClaim(claim, 0, mode);
	});
	
	$("#user-name").on("change", function(){
		var user_id = $(this).val();
		if (mode){
			if ($("#claim-classification").val() != 0){
				var claim = $("#claim-classification").val();
				ajaxClaim(claim, user_id, mode);
			}
		}
		else 
			ajaxClaim(claim, 0, mode);
	});
	
	function ajaxClaim(claim, user_id, mode){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                claim_amt = (this.responseText);
				if (claim_amt == "x"){
					alert("Member not found.");
					$("#claim-submit").prop("disabled", true);
				}
				else if (claim_amt == "y"){
					alert("No eligible contributors.");
					$("#claim-submit").prop("disabled", true);
				}
				else {
					$("#claim-submit").prop("disabled", false);
					$("#claim").val(claim_amt);
				}
            }
        };
		if (user_id != 0)
        	xmlhttp.open("GET", "claim_calculator.php?id=" + user_id + "&class=" + claim + "&mode=" + mode, true);
		else
			xmlhttp.open("GET", "claim_calculator.php?class=" + claim + "&mode=" + mode, true);
        xmlhttp.send();
	}
	
	
})
	