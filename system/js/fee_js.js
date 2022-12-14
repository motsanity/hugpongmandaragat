$(function(){

	$("form").on("submit", function(event){
		if (confirm("Continue?") != 1){
			event.preventDefault();
		}
	});

	var claim_amt = 0;
	$("#fee_classification").on("change", function(){
		var fee = $(this).val();
		ajaxFee(fee);
	});
	function ajaxFee(fee){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                fee_amt = (this.responseText);
				
				$("#fee_submit").prop("disabled", false);
				$("#fee").val(fee_amt);
			
            }
        };
        xmlhttp.open("GET", "fee_calculator.php?fee=" + fee);
		
        xmlhttp.send();
	}
	
	
})
	