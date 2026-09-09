<?php
/** @var array $products */
?>

<!DOCTYPE html>

<html>
<head>
    <title>Product Management</title>


<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 40px;
    }

    .container {
        max-width: 1000px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    h1 {
        margin-top: 0;
        color: #333;
    }

    .add-button {
        display: inline-block;
        background: #333;
        color: white;
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .add-button:hover {
        background: #555;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #333;
        color: white;
        padding: 12px;
        text-align: left;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: #f8f8f8;
    }

    .edit {
        color: #333;
        text-decoration: none;
        margin-right: 8px;
    }

    .delete {
        color: #c0392b;
        text-decoration: none;
    }

    .edit:hover,
    .delete:hover {
        text-decoration: underline;
    }

    .empty {
        text-align: center;
        color: #777;
        padding: 20px;
    }
</style>


</head>

<body>

<div class="container">


<h1>Product Management</h1>

<a href="/products/create" class="add-button">
    + Add Product
</a>

<table>

    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>

    <?php if (!empty($products)): ?>

        <?php foreach ($products as $product): ?>

        <tr>

            <td><?= $product['id'] ?></td>

            <td>
                <?= htmlspecialchars($product['product_name']) ?>
            </td>

            <td>
                <?= htmlspecialchars($product['description']) ?>
            </td>

            <td>
                ₱<?= number_format($product['price'], 2) ?>
            </td>

            <td>
                <?= $product['quantity'] ?>
            </td>

            <td>
                <a
                    href="/products/edit/<?= $product['id'] ?>"
                    class="edit"
                >
                    Edit
                </a>

                <a
                    href="/products/delete/<?= $product['id'] ?>"
                    class="delete"
                    onclick="return confirm('Delete this product?')"
                >
                    Delete
                </a>
            </td>

        </tr>

        <?php endforeach; ?>

    <?php else: ?>

        <tr>
            <td colspan="6" class="empty">
                No products found.
            </td>
        </tr>

    <?php endif; ?>

</table>


</div>

</body>
</html>
