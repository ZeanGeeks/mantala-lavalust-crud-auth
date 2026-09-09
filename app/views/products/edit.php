
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            font-family: Arial, sans-serif;
            background: #dcecff;
            color: #23415f;
        }

        .container {
            width: 100%;
            max-width: 600px;

            background: #dcecff;
            padding: 35px;
            border-radius: 25px;

            box-shadow:
                12px 12px 25px rgba(80, 120, 170, 0.25),
                -12px -12px 25px rgba(255, 255, 255, 0.8);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #145da0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #24527a;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px 15px;

            border: none;
            outline: none;
            border-radius: 15px;

            background: #dcecff;
            color: #23415f;
            font-size: 15px;

            box-shadow:
                inset 5px 5px 10px rgba(100, 140, 190, 0.22),
                inset -5px -5px 10px rgba(255, 255, 255, 0.8);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            box-shadow:
                inset 3px 3px 7px rgba(100, 140, 190, 0.25),
                inset -3px -3px 7px rgba(255, 255, 255, 0.8),
                0 0 0 3px rgba(37, 117, 190, 0.15);
        }

        button {
            width: 100%;
            padding: 14px;

            border: none;
            border-radius: 15px;

            background: #1976d2;
            color: white;

            font-size: 16px;
            font-weight: bold;
            cursor: pointer;

            box-shadow:
                6px 6px 12px rgba(70, 110, 160, 0.3),
                -5px -5px 10px rgba(255, 255, 255, 0.7);

            transition: 0.2s;
        }

        button:hover {
            background: #1565c0;
            transform: translateY(-2px);
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;

            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
        }

        .not-found {
            text-align: center;
            color: #64748b;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .container {
                padding: 25px 20px;
                border-radius: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Product</h1>

    <?php if (!isset($product) || empty($product)): ?>

        <div class="not-found">

            <p>Product not found.</p>

            <a href="/products" class="back">
                ← Back to Products
            </a>

        </div>

    <?php else: ?>

        <form
            action="/products/update/<?= (int) $product['id'] ?>"
            method="POST"
        >

            <div class="form-group">

                <label for="product_name">
                    Product Name
                </label>

                <input
                    type="text"
                    id="product_name"
                    name="product_name"
                    value="<?= htmlspecialchars($product['product_name'] ?? '') ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    required
                ><?= htmlspecialchars($product['description'] ?? '') ?></textarea>

            </div>

            <div class="form-group">

                <label for="price">
                    Price
                </label>

                <input
                    type="number"
                    id="price"
                    name="price"
                    step="0.01"
                    min="0"
                    value="<?= htmlspecialchars($product['price'] ?? '') ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label for="quantity">
                    Quantity
                </label>

                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    min="0"
                    value="<?= htmlspecialchars($product['quantity'] ?? '') ?>"
                    required
                >

            </div>

            <button type="submit">
                Update Product
            </button>

        </form>

        <a href="/products" class="back">
            ← Back to Products
        </a>

    <?php endif; ?>

</div>

</body>
</html>
