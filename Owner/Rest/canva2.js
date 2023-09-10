const params = new URLSearchParams(window.location.search);
const tableWidth = Number(params.get('tw'));
const tableHeight = Number(params.get('th'));
const chairBreath = Number(params.get('cht'));
const width = Number(params.get('rtw'));
const height = Number(params.get('rth'));
const data = [];
//Math.floor(height / (tableHeight + chairBreath));
const rows = Math.floor(height / (tableHeight + chairBreath));
const cols = Math.floor(width / (tableWidth + chairBreath));
const MAX = 255;
const SQ_DIM_W = tableWidth + chairBreath;
const SQ_DIM_H = tableHeight + chairBreath;
console.log("cols " + cols + " rows: " + rows);
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
var space = Number(params.get('cht'));;

// Draw the entire board (the View)
function drawBoard() {
  for (var row = 0, rs = 1; row < rows; row++, rs++) {
    for (var cs = 1, col = 0; col < cols; cs++, col++) {
     
      ctx.fillRect(space * cs + SQ_DIM_W * col, space * rs + SQ_DIM_H * row, SQ_DIM_W, SQ_DIM_H);
      ctx.stroke();
    }
  }
  /*for (let y = 0; y < rows; y++) {
    for (let x = 0; x < cols; x++) {
      drawSquare(x, y);
    }
  }*/

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
        ctx.fillStyle = 'brown';
        //ctx.fillRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);
        //ctx.strokeRect(x * SQ_DIM_W, y * SQ_DIM_H, SQ_DIM_W, SQ_DIM_H);

      }
    }
  };

  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

// Draws a single square on the board (the View)
function drawSquare(x, y) {

  //if (y <= rows && x <= cols) {
    
    ctx.fillStyle='purple';
  ctx.fillRect(x, y, SQ_DIM_W, SQ_DIM_H);
  // ctx.strokeRect(x , y , SQ_DIM_W, SQ_DIM_H);

  //}
}

// Here's the Controller!
// Controlling the colour of the grid
function boardClicked(event) {
  let x = Math.floor(event.offsetX / SQ_DIM_W);
  let y = Math.floor(event.offsetY / SQ_DIM_H);
  data.push([x, y]);

  console.log(x + " " + y + " " + ((SQ_DIM_W * x) + space * (x + 1)) + " " + ((SQ_DIM_H * y) + space * (y + 1)));
  // Modify the model
  /*  ctx.fillStyle = 'brown';
    ctx.stroke();
    grid[y][x] = "brown";
    */

  if (y < rows && x < cols) {
    drawSquare((SQ_DIM_W * x) + space * (x + 1), (SQ_DIM_H * y) + space * (y + 1));
  }

  //drawSquare(x,y);
}

function more() {
  window.replace(`saveTable.php?data=${data}&width=${tableWidth}&length=${tableHeight}`);
  data = [];
}
