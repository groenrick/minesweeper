<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        :root {
            --rows: 18;
            --columns: 18;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f0f0;
            display: grid;
            place-items: center;
            width: 100vw;
            height: 100vh;
        }

        #board {
            position: relative;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            height: 600px;
            background: #fff;
        }

        .tile {
            height: calc(100% / var(--rows, 0));
            width: calc(100% / var(--columns, 0));
            position: absolute;
            left: calc(100% / var(--columns, 50) * var(--column, 50));
            top: calc(100% / var(--rows, 50) * var(--row, 50));

            /*// minesweeper tile style*/
            background: #ccc;
            border-width: 3px;
            border-style: solid;
            border-bottom-color: #999;
            border-right-color: #999;
            border-top-color: #fff;
            border-left-color: #fff;

            display: grid;
            place-items: center;
            font-size: 1.2rem;
            font-weight: bolder;
            font-family: sans-serif;
        }

        .tile[data-value="1"] {
            color: blue;
        }

        .tile[data-value="2"] {
            color: green;
        }

        .tile[data-value="3"] {
            color: red;
        }

        .tile[data-value="4"] {
            color: purple;
        }

        .tile[data-value="5"] {
            color: maroon;
        }

        .tile[data-value="6"] {
            color: turquoise;
        }

        .tile[data-value="7"] {
            color: black;
        }

        .tile[data-value="8"] {
            color: gray;
        }

        .tile::after {
            content: attr(data-value);
        }

        .tile:not(.tile--revealed):not(.tile--flagged):hover {
            background: #999;
            cursor: pointer;
        }

        .tile:not(.tile--revealed):not(.tile--flagged)::after {
            content: '';
        }

        .tile--revealed {
            background: #aaa;
            border: 1px solid #888;
            border-bottom-width: 0;
            border-right-width: 0;
        }
    </style>
</head>
<body>
    <div id="board"></div>
    <script src="/js/app.js"></script>
</body>
</html>