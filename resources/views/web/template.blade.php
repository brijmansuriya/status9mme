<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabric.js Drawing App</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }

        #canvas-container {
            position: relative;
        }

        canvas {
            border: 1px solid #ccc;
        }

        #toolbar {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div id="canvas-container">
        <div id="toolbar">
            <button id="pen">Pen</button>
            <button id="eraser">Eraser</button>
        </div>
        <canvas id="c" width="800" height="600"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.6.0/fabric.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = new fabric.Canvas('c');

            // Load background image
            fabric.Image.fromURL('https://example.com/background.jpg', function(img) {
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                    scaleX: canvas.width / img.width,
                    scaleY: canvas.height / img.height
                });
            });

            // Pen tool
            document.getElementById('pen').addEventListener('click', () => {
                canvas.isDrawingMode = true;
                canvas.freeDrawingBrush = new fabric.PencilBrush(canvas);
                canvas.freeDrawingBrush.width = 5;
                canvas.freeDrawingBrush.color = '#000000';
            });

            // Eraser tool
            document.getElementById('eraser').addEventListener('click', () => {
                canvas.isDrawingMode = true;
                canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
                canvas.freeDrawingBrush.width = 10;
            });

            // Initialize canvas settings
            canvas.isDrawingMode = true;
            canvas.freeDrawingBrush = new fabric.PencilBrush(canvas);
            canvas.freeDrawingBrush.width = 5;
            canvas.freeDrawingBrush.color = '#000000';
        });
    </script>
</body>

</html>
