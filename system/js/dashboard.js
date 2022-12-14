$(document).ready(function(){
	$("#users .text .data").text(total_users);
	$("#donations .text .data").text(total_donations);
	$("#withdrawals .text .data").text(total_withdrawals);
	$("#outstanding .text .data").text(outstanding);
	$("#claims .text .data").text(total_claims);
	$("#membership .text .data").text(membership);
	$("#annual .text .data").text(annual);
	
	var records = [];
	ajaxTable(1);
	$("#pagination .btn").on("click", function(event){
		var id = $(this).attr("id");
		$("#pagination .btn-success").removeAttr("class").attr("class", "btn btn-sm btn-outline-success");
		$("#pagination #" + id).attr("class", "btn btn-sm btn-success")
		ajaxTable(id);
	})
	
	function ajaxTable(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                records = (this.responseText);
				$("#ajax-table tbody").html(records);
            }
        };
        xmlhttp.open("GET", "report_pagination.php?page=" + id, true);
        xmlhttp.send();
	}
	
	
    try {

      // Donation vs Withdrawal Graph
      const bd_brandProduct2 = 'rgba(0,181,233,0.9)'
      const bd_brandService2 = 'rgba(0,173,95,0.9)'
      const brandProduct2 = 'rgba(0,181,233,0.2)'
      const brandService2 = 'rgba(0,173,95,0.2)'

      var ctx = document.getElementById("recent-fin-rep-chart");
      if (ctx) {
        ctx.height = 325;
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: donation_month,
            datasets: [
              {
                label: 'Donations',
                backgroundColor: brandService2,
                borderColor: bd_brandService2,
                pointHoverBackgroundColor: '#fff',
                borderWidth: 0,
                data: donation_amt

              },
              {
                label: 'Withdrawals',
                backgroundColor: brandProduct2,
                borderColor: bd_brandProduct2,
                pointHoverBackgroundColor: '#fff',
                borderWidth: 0,
			    data: wd_amt

              }
            ]
          },
          options: {
            maintainAspectRatio: true,
            legend: {
              display: true
            },
            responsive: true,
            scales: {
              xAxes: [{
                gridLines: {
                  drawOnChartArea: true,
                  color: '#f2f2f2'
                },
                ticks: {
                  fontFamily: "Poppins",
                  fontSize: 12
                }
              }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  maxTicksLimit: 5,
				  stepSize: Math.ceil(max_value / 5),
                  max: max_value,
                  fontFamily: "Poppins",
                  fontSize: 12
                },
                gridLines: {
                  display: true,
                  color: '#f2f2f2'
                }
              }]
            },
            elements: {
              point: {
                radius: 2,
                hitRadius: 5,
                hoverRadius: 4,
                hoverBorderWidth: 3
              },
              line: {
				  tension: 0
              }
            }
          }
        });
      }

    } catch (error) {
      console.log(error);
    }
	
});
