const params = new URLSearchParams(window.location.search);
const tableWidth = Number(params.get('tw'));//Table width
const tableHeight = Number(params.get('th'));//Table heigth
const chairBreath = Number(params.get('cht'));//chair breath
const width = Number(params.get('rtw'));//Rest Width
const height = Number(params.get('rth'));//Rest Height
const data = [];//save coordinates of chosen squares on board
const rows = Math.floor(height / (tableHeight + chairBreath));
const cols = Math.floor(width / (tableWidth + chairBreath));
const MAX = 255;
const SQ_DIM = 10;
const SQ_DIM_W = tableWidth + chairBreath;
const SQ_DIM_H = tableHeight + chairBreath;
let grid = [];
let ctx;
function init() {
    // Get the HTML canvas and context
    let boardCanvas = document.getElementById("canvas");
    ctx = boardCanvas.getContext("2d");
    // Setup an initial grid of white
    for (let x = 0; x < rows; x++) {
        grid[x] = [];
        for (let y = 0; y < cols; y++) {
            grid[x][y] = MAX;
        }
    }
    // Draw the board
    drawBoard();
}
// Draw the entire board (the View)
function drawBoard() {
    for (let y = 0; y < rows; y++) {
        for (let x = 0; x < cols; x++) {
            drawSquare(x, y);
        }
    }
    //AJAX
    var xmlhttp = new XMLHttpRequest();
    var url = "tableFromDB.php";
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            //Draw the exisiting tables from database
            for (i = 0; i < data.length; i++) {
                var value = data[i];
                let x = value[0];
                let y = value[1];
                if(y < rows && x < cols){
                drawSquare(x, y);
                ctx.lineWidth = chairBreath;
                ctx.strokeStyle = "whitesmoke";
                ctx.fillStyle = "green";
                ctx.fillRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);
                //ctx.fillRect(x * SQ_DIM, y * SQ_DIM, SQ_DIM, SQ_DIM);
                ctx.strokeRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);
                }
            }
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
// Draws a single square on the board (the View)
function drawSquare(x, y) {
    if(y < rows && x < cols){
    ctx.lineWidth = chairBreath;
    ctx.strokeStyle = "whitesmoke";
    ctx.fillRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);
    //ctx.fillRect(x * SQ_DIM, y * SQ_DIM, SQ_DIM, SQ_DIM);
    ctx.strokeRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);
    }
}
// Here's the Controller!
// Controlling the colour of the grid
function boardClicked(event) {
    let x = Math.floor(event.offsetX / SQ_DIM_W);
    let y = Math.floor(event.offsetY / SQ_DIM_H);
    //if(y<rows && x<cols){
    data.push([x, y]);
    console.log(data);
    // Modify the model
    ctx.fillStyle = "green";
    ctx.stroke();
    grid[0][0] = "green";
    drawSquare(x, y);
    //}
}
function sendData() {
    data.push(tableWidth);
    data.push(tableHeight);
    data.push([width, height]);
    var xhr = new XMLHttpRequest();
    //👇 set the PHP page you want to send data to
    xhr.open("POST", "AddToDB.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    //👇 what to do when you receive a response
    /*xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            //alert(xhr.responseText);
        }
    };*/
    //👇 send the data
    xhr.send(JSON.stringify(data));
}
function sendDataAndFinish(){
    data.push(tableWidth);
    data.push(tableHeight);
    data.push([width, height]);
    var xhr = new XMLHttpRequest();
    //👇 set the PHP page you want to send data to
    xhr.open("POST", "AddRest.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    //👇 what to do when you receive a response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
           // alert(xhr.responseText);
        }
    };
    //👇 send the data
    xhr.send(JSON.stringify(data));
}
/*if (document.getElementById("moreTables") != null) {
    data.push(SQ_DIM_W);
    data.push(SQ_DIM_H);
    data.push([width, height]);
    document.getElementById("moreTables").onclick = function () {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "AddToDB.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                window.location.href = "AddToDB.php";
            }
        };
        xhr.send("data=" + JSON.stringify(data));
    };
}*/
/*function more() {
    data.push(SQ_DIM_W);
    data.push(SQ_DIM_H);
    data.push([width, height]);
    document.getElementById("moreTables").onclick = function () {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "AddToDB.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                window.location.href = "AddToDB.php";
            }
        };
        xhr.send("data=" + JSON.stringify(data));
    };
    /*data.push(SQ_DIM_W);
    data.push(SQ_DIM_H);
    data.push([width, height]);

    $.ajax({
        type: "POST",
        url: "AddToDB.php",
        data: { myData: JSON.stringify(data) },
        success: function (response) {
            console.log(response);
        }
    });
*/
    /*alert('Calles');
    $.ajax({
        type: "POST",
        url: "AddToDB.php",
        data: { myData: data },
        success: function () {
            alert('Success');
        },
        error: function () {
            alert('There was some error performing the AJAX call!');
        }
    });*/
    /*var myData = JSON.stringify(data);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "AddToDB.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // handle the response from the PHP file
            console.log(this.responseText);
        }
    };
    xhttp.send(myData);*/
//}
/*function end() {
    data.push(SQ_DIM_W);
    data.push(SQ_DIM_H);
    data.push([width, height]);
    $.ajax({
        type: "POST",
        url: "AddRest.php",
        data: { myData: data },
        success: function (response) {
            console.log(response);
        }
    });*/
    /*var myData = JSON.stringify(data);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "AddRest.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // handle the response from the PHP file
            console.log(this.responseText);
        }
    };
    xhttp.send(myData);*/
//}