let dailyReq = new XMLHttpRequest(); 
dailyReq.addEventListener("load", dailyReqListener);
dailyReq.open("GET", "daily_commodity.php?order_date=2020-05-26", true);
dailyReq.send();

function dailyReqListener () {
    console.log(this.responseText);
    let responseObj = JSON.parse(this.responseText);
    let xList = responseObj.x;
    let yList = responseObj.y;
    let colors = ['#92c028','#e4ff7f','#f78914','#86ee56','#ffa33f'];
    let pieCtx = document.getElementById('dailyRevenue').getContext('2d');
    let pieGraph = new Chart(pieCtx, {
        type: "pie",
        data: {
            labels: xList,
            datasets: [
                {
                    label: 'Commodity Daily Sales',
                    backgroundColor: ['#92c028','#e4ff7f','#f78914','#86ee56','#ffa33f'],
                    borderColor: ['#92c028','#e4ff7f','#f78914','#86ee56','#ffa33f'],
                    hoverBackgroundColor: ['#92c028','#e4ff7f','#f78914','#86ee56','#ffa33f'],
                    hoverBorderColor: '#ffffff',
                    data: yList
                }
            ]
        }
    });
}



let monthlyReq = new XMLHttpRequest();
monthlyReq.addEventListener("load", monthlyReqListener);
monthlyReq.open("GET", "monthly_commodity.php", true);
monthlyReq.send();

function monthlyReqListener(){
    console.log(this.responseText);
    let responseObj = JSON.parse(this.responseText);
    let xList = responseObj.x;
    let yList = responseObj.y;
    let lineCtx = document.getElementById('monthlyRevenue').getContext('2d');
    let lineGraph = new Chart(lineCtx, {
        type: "line",
        data: GetLineChartData(xList, yList)
    })
}

function GetLineChartData(xList, yList){
    let colors = ['#92c028','#e4ff7f','#f78914','#86ee56','#ffa33f'];
    let datasets = [];
    for(let i=0; i<yList.length; i++){
        datasets.push(
            {
                fill: false,
                label: yList[i].label,
                borderColor: colors[i],
                hoverBorderColor: '#bbbbbb',
                data: yList[i].dataList
            }
        );
    }

    let chartdata = {
        labels: xList,
        datasets: datasets
    };
    return chartdata;
}

