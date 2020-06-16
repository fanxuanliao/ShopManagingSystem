document.getElementById("date").value = getDate();
document.getElementById("start-date").value = getFirstDay();
document.getElementById("end-date").value = getDate();
const colors = ["#003f5","#bc5090","#ffa600","#374c80","#7a5195","#bc5090", "#ef5675"];
let colorIndex = 0;

const dailyForm = document.getElementById("dailyForm");
dailyForm.addEventListener("submit", onDailySubmit);
const pieCtx = document.getElementById('dailyRevenue').getContext('2d');
const pieGraph = new Chart(pieCtx, {type: "pie"});
sendDailyRequest(document.getElementById("daily-search-type").value, document.getElementById("date").value);

function sendDailyRequest(searchType, date){
    let dailyReq = new XMLHttpRequest(); 
    dailyReq.addEventListener("load", dailyReqListener);
    dailyReq.open("GET", "daily_commodity.php?date=" + date +"&daily-search-type="+searchType, true);
    dailyReq.send();
}

function onDailySubmit(event){
    event.preventDefault();
    let searchType = document.getElementById("daily-search-type").value;
    let date = document.getElementById("date").value;
    sendDailyRequest(searchType, date);
}

function dailyReqListener() {
    console.log(this.responseText);
    let responseObj = JSON.parse(this.responseText);
    let xList = responseObj.x;
    let yList = responseObj.y;
    pieGraph.data = {
            labels: xList,
            datasets: [
                {
                    label: 'Commodity Daily Sales',
                    backgroundColor: colors,
                    borderColor: colors,
                    hoverBackgroundColor: colors,
                    hoverBorderColor: '#ffffff',
                    data: yList
                }
            ]
        }
    pieGraph.update();
}



const monthlyForm = document.getElementById("monthlyForm");
monthlyForm.addEventListener("submit", onMonthlySubmit);
const lineCtx = document.getElementById('monthlyRevenue').getContext('2d');
const lineGraph = new Chart(lineCtx, {type: "line"});
const datasets = [];
sendMonthlyRequest(document.getElementById("search-type").value, document.getElementById("start-date").value, document.getElementById("end-date").value);

function onMonthlySubmit(event){
    event.preventDefault();
    datasets.length = 0;
    let searchType = document.getElementById("search-type").value;
    let startDate = document.getElementById("start-date").value;
    let endDate = document.getElementById("end-date").value;

    sendMonthlyRequest(searchType, startDate, endDate);
}

function sendMonthlyRequest(searchType, startDate, endDate){
    let categoryReq = new XMLHttpRequest();
    colorIndex = 0;
    categoryReq.open("GET", "get_set.php", true);
    categoryReq.send();
    categoryReq.onload = function(){
        let responseObj = JSON.parse(this.responseText);
        if(searchType == 'c_category'){
            responseObj.category_set.forEach((c) => 
            {
                let getURL = "monthly_commodity.php?label=" + c.category + "&start-date=" + startDate + "&end-date=" + endDate + "&search-type="+searchType;
                let monthlyReq = new XMLHttpRequest();
                monthlyReq.addEventListener("load", monthlyReqListener);
                monthlyReq.open("GET", getURL, true);
                monthlyReq.send();
            });
        }else if(searchType == 'c_name'){
            responseObj.commodity_set.forEach((c) => 
            {
                let getURL = "monthly_commodity.php?label=" + c.commodity_name+ "&start-date=" + startDate + "&end-date=" + endDate + "&search-type="+searchType;
                let monthlyReq = new XMLHttpRequest();
                monthlyReq.addEventListener("load", monthlyReqListener);
                monthlyReq.open("GET", getURL, true);
                monthlyReq.send();
            });
        }
    }
}

function monthlyReqListener(){
    let responseObj = JSON.parse(this.responseText);
    let xList = responseObj.x;
    let yList = responseObj.y;
    let label = responseObj.label;

    datasets.push({
        fill: false,
        label: label,
        backgroundColor: colors[colorIndex],
        borderColor: colors[colorIndex],
        hoverBackgroundColor: '#ff0000',
        hoverBorderColor: '#ffffff',
        data: yList
    })
    lineGraph.data = {
        labels: xList,
        datasets: datasets
    }
    lineGraph.update();
    colorIndex += 1;
}

function getDate(){
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth() + 1;
    let yyyy = today.getFullYear();
    if(dd < 10){
        dd = '0' + dd;
    }
    if(mm < 10){
        mm = '0' + mm;
    }
    let todayStr = yyyy + '-' + mm +'-' + dd;
    return todayStr;
}

function getFirstDay(){
    let today = new Date();
    let dd = '01';
    let mm = today.getMonth() + 1;
    let yyyy = today.getFullYear();
    if(mm < 10){
        mm = '0' + mm;
    }
    let todayStr = yyyy + '-' + mm +'-' + dd;
    return todayStr;
}

let promise = new Promise((resolve, reject) => {
    let request = new XMLHttpRequest();
    request.open("GET", "get_set.php", true);
    request.send();
    if(request.readyState === XMLHttpRequest.DONE && request.response === 200){
        resolve("working");
    }else{
        reject("broke");
    }
});
promise.then((test) => console.log(test)).catch((error) => {console.log(error)});
