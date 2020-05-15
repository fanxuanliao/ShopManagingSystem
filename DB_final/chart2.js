var linedata1 = new Array();
var linedata2 = new Array();
var linedata3 = new Array();

$(document).ready(function(){
    $.ajax({ 
        url: 'chart2.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        error: function(){
            alert('連線出錯');
        },
        success: function(data){
            for (var i=0; i < data[0].length; i++) {
                linedata1.push(data[0][i]);
                linedata2.push(data[1][i]);
                linedata3.push(data[2][i]);
            }
        }
    });
})

var ctx = document.getElementById('chart2').getContext('2d');
var chartLine = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['day1','day2','day3','day4','day5','day6','day7','day8','day9','day10',
        'day11','day12','day13','day14','day15','day16','day17','day18','day19','day20',
        'day21','day22','day23','day24','day25','day26','day27','day28','day29','day30','day31'], //每天
        datasets: [
        {
            label: '食品',
            fill: false,
            data: linedata1, //銷售額
            lineTension: 0,
            backgroundColor: "rgba(255,99,132,1)",
            borderColor: "rgba(255, 99, 132, 0.3)",
        },{
            label: '家電',
            fill: false,
            data: linedata2, //銷售
            lineTension: 0,
            backgroundColor: "rgba(54, 162, 235, 1)",
            borderColor: "rgba(54, 162, 235, 0.3)",
        },{
            label: '生活雜物',
            fill: false,
            data: linedata3, //銷售
            lineTension: 0,
            backgroundColor: "rgba(30, 198, 30, 1)",
            borderColor: "rgba(30, 198, 30, 0.3)",
        }]
    },
    options: {
//        responsive: true,
        tooltips: {
            mode: 'x'
        },
    }
})