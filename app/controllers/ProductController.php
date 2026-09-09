
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('ProductModel');
    }

    public function index()
    {
        $data['products'] = $this->ProductModel->getAllProducts();

        $this->call->view('products/index', $data);
    }

    public function create()
    {
        $this->call->view('products/create');
    }

    public function store()
    {
        $data = [
            'product_name' => $_POST['product_name'] ?? '',
            'description'  => $_POST['description'] ?? '',
            'price'        => $_POST['price'] ?? 0,
            'quantity'     => $_POST['quantity'] ?? 0
        ];

        $this->ProductModel->createProduct($data);

        redirect('/products');
        exit;
    }

    public function edit(int $id)
    {
        $data['product'] = $this->ProductModel->getProduct($id);

        $this->call->view('products/edit', $data);
    }

    public function update(int $id)
    {
        $data = [
            'product_name' => $_POST['product_name'] ?? '',
            'description'  => $_POST['description'] ?? '',
            'price'        => $_POST['price'] ?? 0,
            'quantity'     => $_POST['quantity'] ?? 0
        ];

        $this->ProductModel->updateProduct($id, $data);

        redirect('/products');
        exit;
    }

    public function delete(int $id)
    {
        $this->ProductModel->deleteProduct($id);

        redirect('/products');
        exit;
    }
}
