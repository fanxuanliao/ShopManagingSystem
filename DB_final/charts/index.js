document.getElementById("date").value = getDate();
document.getElementById("start-date").value = getDate();
document.getElementById("end-date").value = getDate();

const dailyForm = document.getElementById("dailyForm");
dailyForm.addEventListener("submit", onDailySubmit);
const pieCtx = document.getElementById('dailyRevenue').getContext('2d');
const pieGraph = new Chart(pieCtx, {type: "pie"});

function onDailySubmit(event){
    event.preventDefault();
    let date = document.getElementById("date").value;
    let dailyReq = new XMLHttpRequest(); 
    dailyReq.addEventListener("load", dailyReqListener);
    dailyReq.open("GET", "daily_commodity.php?date=" + date, true);
    dailyReq.send();
}

function dailyReqListener () {
    console.log(this.responseText);
    let responseObj = JSON.parse(this.responseText);
    let xList = responseObj.x;
    let yList = responseObj.y;
    pieGraph.data = {
            labels: xList,
            datasets: [
                {
                    label: 'Commodity Daily Sales',
                    backgroundColor: ["#ffadad", "#ffd6a5", "#caffbf","#9bf6ff","#a0c4ff","#bdb2ff","#ffc6ff"],
                    borderColor: ["#ffadad", "#ffd6a5", "#caffbf","#9bf6ff","#a0c4ff","#bdb2ff","#ffc6ff"],
                    hoverBackgroundColor: ["#ffadad", "#ffd6a5", "#caffbf","#9bf6ff","#a0c4ff","#bdb2ff","#ffc6ff"],
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

function onMonthlySubmit(event){
    event.preventDefault();
    datasets.length = 0;
    let search = document.getElementById("analysis_type").value;
    let startDate = document.getElementById("start-date").value;
    let endDate = document.getElementById("end-date").value;

    let categoryReq = new XMLHttpRequest();
    categoryReq.open("GET", "get_set.php", true);
    categoryReq.send();
    categoryReq.onload = function(){
        let responseObj = JSON.parse(this.responseText);
        responseObj.category_set.forEach((c) => 
            {
                let getURL = "monthly_commodity.php?label=" + c.category + "&start-date=" + startDate + "&end-date=" + endDate;
                let monthlyReq = new XMLHttpRequest();
                monthlyReq.addEventListener("load", monthlyReqListener);
                monthlyReq.open("GET", getURL, true);
                monthlyReq.send();
            }
        );
    }
}

function monthlyReqListener(){
    let colors = ["#ffadad", "#ffd6a5", "#caffbf","#9bf6ff","#a0c4ff","#bdb2ff","#ffc6ff"];
    let colorIndex = Math.floor(Math.random() * colors.length);
    console.log("colorIndex: " + colorIndex);
    
    console.log(this.responseText);
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
