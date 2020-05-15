var piedata=[];

$(document).ready(function(){
	$.ajax({ 
        url: 'chart1.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        error: function(){
            alert('連線出錯');
        },
        success: function(data){
            console.info(data);
            for (var i=0; i < data.length; i++) {
            	piedata.push(data[i]);
            }
        }
    });
})

var ctx = document.getElementById('chart1').getContext('2d');
var chartCircle = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['食品','家電','生活雜物'],
        datasets: [{
            fill: true,
            spanGaps: false,
            label: ['#'],
            data: piedata, //銷售額
            backgroundColor: [
            'rgba(255, 99, 132, 0.3)', //食品
            'rgba(54, 162, 235, 0.3)', //家電
            'rgba(30, 198, 30, 0.3)', //生活
            ],
            borderColor: [
            '#fff',
            ],
            borderWidth: 5,
            
        }]
    },
})
