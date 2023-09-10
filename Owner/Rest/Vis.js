var w, h;

var xmlhttp = new XMLHttpRequest();
var url = "Rest/RestProp.php";
xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        var value = data;
        let x = value[0];
        let y = value[1];
        w = parseInt(x);
        h = parseInt(y);
        console.log(w+" "+h)
        init();

    }
};
xmlhttp.open("GET", url, true);
xmlhttp.send();


function init() {

    const width = w * 100;//Rest Width take from db
    const height = h * 100;//Rest Height
    console.log("w= "+width + " " + height)
    const tableWidth = 30//Table width
    const tableHeight = 25//Table heigth
    const chairBreath = 6//chair breath
    const data = [];//save coordinates of chosen squares on board
    var rows = Math.floor(height / (tableHeight + chairBreath));
    const cols = Math.floor(width / (tableWidth + chairBreath));
    const MAX = 255;
    const SQ_DIM = 10;
    const SQ_DIM_W = tableWidth + chairBreath;
    const SQ_DIM_H = tableHeight + chairBreath;
    let grid = [];
    let ctx;
    // Get the HTML canvas and context
    let boardCanvas = document.getElementById("canvas");
    boardCanvas.height=height;
    boardCanvas.width=width;
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

    // Draw the entire board (the View)
    function drawBoard() {
        for (let y = 0; y < rows; y++) {
            for (let x = 0; x < cols; x++) {
                drawSquare(x, y);
            }
        }
        //AJAX
        var xmlhttp = new XMLHttpRequest();
        var url = "Rest/tableFromDB.php";
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
        if (y < rows && x < cols) {
            //let c = grid[0][0];
            ctx.lineWidth = chairBreath;
            ctx.strokeStyle = "white";
            ctx.fillStyle = "black";
            ctx.fillRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);
            //ctx.fillRect(x * SQ_DIM, y * SQ_DIM, SQ_DIM, SQ_DIM);
            ctx.strokeRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);
        }
    }
}