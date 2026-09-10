
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$products = $products ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Management</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 20px;
            font-family: Arial, sans-serif;
            background: #dcecff;
            color: #23415f;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .header {
            background: #dcecff;
            padding: 30px;
            border-radius: 25px;
            margin-bottom: 25px;

            box-shadow:
                12px 12px 25px rgba(80, 120, 170, 0.25),
                -12px -12px 25px rgba(255, 255, 255, 0.8);
        }

        h1 {
            margin: 0 0 10px;
            color: #145da0;
        }

        .welcome {
            color: #64748b;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
            color: white;
            background: #1976d2;

            box-shadow:
                5px 5px 10px rgba(70, 110, 160, 0.3),
                -5px -5px 10px rgba(255, 255, 255, 0.7);

            transition: 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            background: #1565c0;
        }

        .logout {
            background: #607d9b;
        }

        .table-card {
            background: #dcecff;
            padding: 25px;
            border-radius: 25px;

            box-shadow:
                12px 12px 25px rgba(80, 120, 170, 0.25),
                -12px -12px 25px rgba(255, 255, 255, 0.8);
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            min-width: 850px;
        }

        th {
            padding: 14px;
            text-align: left;
            color: #145da0;
        }

        td {
            padding: 15px;
            background: #dcecff;

            box-shadow:
                3px 3px 7px rgba(80, 120, 170, 0.15),
                -3px -3px 7px rgba(255, 255, 255, 0.7);
        }

        tr td:first-child {
            border-radius: 12px 0 0 12px;
        }

        tr td:last-child {
            border-radius: 0 12px 12px 0;
        }

        .edit {
            color: #1565c0;
            font-weight: bold;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete {
            color: #c62828;
            font-weight: bold;
            text-decoration: none;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .header,
            .table-card {
                padding: 20px;
                border-radius: 20px;
            }

            h1 {
                font-size: 25px;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <h1>Product Management</h1>

        <p class="welcome">
            Welcome,
            <strong><?= htmlspecialchars($_SESSION['username'] ?? '') ?></strong>
        </p>

        <div class="actions">
            <a href="/products/create" class="btn">
                + Add Product
            </a>

            <a href="/logout" class="btn logout">
                Logout
            </a>
        </div>

    </div>

    <?php if (!empty($error)): ?>
        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="table-card">

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (empty($products)): ?>

                    <tr>
                        <td colspan="7" class="empty">
                            No products found.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($products as $product): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($product['id']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($product['product_name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($product['description']) ?>
                            </td>

                            <td>
                                ₱<?= htmlspecialchars($product['price']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($product['quantity']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($product['created_at']) ?>
                            </td>

                            <td>

                                <a
                                    href="/products/edit/<?= (int) $product['id'] ?>"
                                    class="edit"
                                >
                                    Edit
                                </a>

                                <a
                                    href="/products/delete/<?= (int) $product['id'] ?>"
                                    class="delete"
                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                >
                                    Delete
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>
