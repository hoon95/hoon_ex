const canvas = document.getElementById('chart1');
const context = canvas.getContext('2d');

// Rectangle
context.fillStyle = '#ff0000';
context.fillRect(50, 50, 100, 80);

// Triangle
context.strokeStyle = '#0000ff';
context.lineWidth = 2;
context.beginPath();
context.moveTo(200, 50);
context.lineTo(300, 130);
context.lineTo(300, 70);
context.lineTo(200, 50);
context.stroke();
context.closePath();

// Circle
context.fillStyle = '#00ff00';
context.beginPath();
context.arc(350, 50, 30, 0, 2 * Math.PI);

context.fill();
context.closePath();

// Half Circle
context.fillStyle = '#ff0000';
context.beginPath();
context.arc(350, 150, 30, 0, Math.PI);

context.fill();
context.closePath();