<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .calculator {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .result {
            width: 100%;
            height: 50px;
            border: 2px solid #333;
            border-radius: 5px;
            text-align: right;
            font-size: 1.5em;
            padding: 10px;
            margin-bottom: 20px;
            background-color:#f4f4f4;
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        button {
            padding: 20px;
            font-size: 1.2em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .clear, .equal {
            background-color: #dc3545;
        }

        .clear:hover, .equal:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>

    <div class="calculator">
        <form method="POST">
            <input type="text" name="display" class="result" value="<?php echo isset($_POST['display']) ? $_POST['display'] : ''; ?>" readonly>

            <div class="button-grid">
                <!-- Number buttons -->
                <button type="submit" name="num" value="7">7</button>
                <button type="submit" name="num" value="8">8</button>
                <button type="submit" name="num" value="9">9</button>
                <button type="submit" name="operator" value="/">÷</button>

                <button type="submit" name="num" value="4">4</button>
                <button type="submit" name="num" value="5">5</button>
                <button type="submit" name="num" value="6">6</button>
                <button type="submit" name="operator" value="*">×</button>

                <button type="submit" name="num" value="1">1</button>
                <button type="submit" name="num" value="2">2</button>
                <button type="submit" name="num" value="3">3</button>
                <button type="submit" name="operator" value="-">-</button>

                <button type="submit" name="num" value="0">0</button>
                <button type="submit" name="num" value=".">.</button>
                <button type="submit" name="equal" value="=">=</button>
                <button type="submit" name="operator" value="+">+</button>

                <button type="submit" name="clear" class="clear" style="grid-column: span 4;">Clear</button>
            </div>
        </form>
    </div>

    <?php
    // PHP logic to handle calculator operations
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $display = isset($_POST['display']) ? $_POST['display'] : '';
        $num = isset($_POST['num']) ? $_POST['num'] : '';
        $operator = isset($_POST['operator']) ? $_POST['operator'] : '';
        $equal = isset($_POST['equal']) ? $_POST['equal'] : '';
        $clear = isset($_POST['clear']) ? $_POST['clear'] : '';

        // Handle clear
        if ($clear) {
            $display = '';
        }
        // Append number to display
        elseif ($num) {
            $display .= $num;
        }
        // Append operator to display
        elseif ($operator) {
            // Ensure operator is appended with spaces for proper calculation
            $display .= ' ' . $operator . ' ';
        }
        // Perform calculation when equal is pressed
        elseif ($equal) {
            // Replace ÷ and × with PHP compatible operators
            $expression = str_replace(['÷', '×'], ['/', '*'], $display);
            try {
                // Evaluate the expression safely
                $result = eval("return $expression;");
                $display = $result;
            } catch (Exception $e) {
                $display = 'Error';
            }
        }
    }
    ?>

</body>
</html>

