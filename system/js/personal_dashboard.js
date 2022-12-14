$(document).ready(function(){
	$("#chart-2").css("display", "none");
	$("#time").on("change", function(){
		var time = $(this).val();
		if (time == 1){
			$("#chart-1").css("display", "block");	
			$("#chart-2").css("display", "none");
		}
		else {
			$("#chart-2").css("display", "block");	
			$("#chart-1").css("display", "none");
		}
	});
	
	$("#donations").text(total_donations);
	$("#withdrawals").text(total_withdrawals);
	$("#outstanding").text(outstanding);
	$("#claims").text(total_claims);
	$("#deductions").text(total_deductions);
	$("#annual-fees").text(total_annual);
	
	var records = [];
	ajaxTable(user_id, 1);
	
	$("#pagination .btn").on("click", function(event){
		var id = $(this).attr("id");
		$("#pagination .btn-success").removeAttr("class").attr("class", "btn btn-sm btn-outline-success");
		$("#pagination #" + id).attr("class", "btn btn-sm btn-success")
		ajaxTable(user_id, id);
	})
	
	function ajaxTable(user_id,id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                records = (this.responseText);
				$("#ajax-table tbody").html(records);
            }
        };
        xmlhttp.open("GET", "report_pagination.php?id=" + user_id + "&page=" + id, true);
        xmlhttp.send();
	}
	
    try {
      // YEARLY
      var ctx = document.getElementById("yearly-chart");
      if (ctx) {
        ctx.height = 100;
        var myChart = new Chart(ctx, {
          type: 'bar',
          defaultFontFamily: 'Poppins',
          data: {
            labels: yearly_year,
            datasets: [
              {
                label: "Total Donation / Year",
                data: yearly_amt,
                borderColor: "rgba(102,153,0, 0.9)",
                borderWidth: "0",
                backgroundColor: "rgba(102,153,51, 0.5)",
                fontFamily: "Poppins"
              }
            ]
          },
          options: {
            legend: {
              position: 'top',
              labels: {
                fontFamily: 'Poppins'
              }

            },
            scales: {
              xAxes: [{
                ticks: {
                  fontFamily: "Poppins"

                }
              }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  fontFamily: "Poppins"
                }
              }]
            }
          }
        });
      }

    } catch (error) {
      console.log(error);
    }
	
	try {
      // MONTHLY
      var ctx = document.getElementById("monthly-chart");
      if (ctx) {
        ctx.height = 100;
        var myChart = new Chart(ctx, {
          type: 'bar',
          defaultFontFamily: 'Poppins',
          data: {
            labels: monthly_month,
            datasets: [
              {
                label: "Total Donation / Month",
                data: monthly_amt,
                borderColor: "rgba(153,102,51, 0.9)",
                borderWidth: "0",
                backgroundColor: "rgba(153,102,0, 0.5)",
                fontFamily: "Poppins"
              }
            ]
          },
          options: {
            legend: {
              position: 'top',
              labels: {
                fontFamily: 'Poppins'
              }

            },
            scales: {
              xAxes: [{
                ticks: {
                  fontFamily: "Poppins"

                }
              }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  fontFamily: "Poppins"
                }
              }]
            }
          }
        });
      }
	  
    } catch (error) {
      console.log(error);
    }   
	
	
});
