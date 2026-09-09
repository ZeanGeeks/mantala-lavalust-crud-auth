<!DOCTYPE html>

<html>
<head>
    <title>Add Product</title>


<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 40px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    h1 {
        color: #333;
        margin-top: 0;
    }

    label {
        font-weight: bold;
        color: #444;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    textarea {
        height: 100px;
        resize: vertical;
    }

    button {
        background: #333;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #555;
    }

    .back {
        display: inline-block;
        margin-top: 15px;
        color: #333;
        text-decoration: none;
    }

    .back:hover {
        text-decoration: underline;
    }
</style>


</head>

<body>

<div class="container">


<h1>Add Product</h1>

<form action="/products/store" method="POST">

    <label>Product Name</label><br>
    <input
        type="text"
        name="product_name"
        required
    >

    <br><br>

    <label>Description</label><br>
    <textarea name="description"></textarea>

    <br><br>

    <label>Price</label><br>
    <input
        type="number"
        name="price"
        step="0.01"
        required
    >

    <br><br>

    <label>Quantity</label><br>
    <input
        type="number"
        name="quantity"
        required
    >

    <br><br>

    <button type="submit">
        Save Product
    </button>

</form>

<a href="/products" class="back">
    ← Back to Products
</a>

</div>

</body>
</html>
