<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Exchange Rates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
        }

        .exchange-rate {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Currency Exchange Rates</h1>

    <p><strong>Base currency:</strong> <?php echo $data['base']; ?></p>
    <p><strong>Amount:</strong> <?php echo $data['amount']; ?></p>

    <h2>Exchange Rates:</h2>
    <?php foreach ($data['rates'] as $currency => $rate): ?>
        <p class="exchange-rate">1 <?php echo $data['base']; ?> = <?php echo $rate; ?> <?php echo $currency; ?></p>
    <?php endforeach; ?>
</div>
</body>
</html>