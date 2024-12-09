const canvas2 = document.getElementById('chart2');
const context2 = canvas2.getContext('2d');

// Rectangle
context2.fillStyle = '#ff0000';
context2.fillRect(50, 50, 100, 80);

// Triangle
context2.strokeStyle = '#0000ff';
context2.lineWidth = 2;
context2.beginPath();
context2.moveTo(200, 50);
context2.lineTo(300, 130);
context2.lineTo(300, 70);
context2.lineTo(200, 50);
context2.stroke();
context2.closePath();

// Circle
context2.fillStyle = '#00ff00';
context2.beginPath();
context2.arc(350, 50, 30, 0, 2 * Math.PI);

context2.fill();
context2.closePath();

// Half Circle
context2.fillStyle = '#ff0000';
context2.beginPath();
context2.arc(350, 150, 30, 0, Math.PI);

context2.fill();
context2.closePath();