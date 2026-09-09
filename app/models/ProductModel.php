<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primary_key = 'id';
    protected $fillable = [];
    protected $guarded = ['id'];

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts()
    {
        return $this->all();
    }

    public function getProduct(int $id)
    {
        return $this->find($id);
    }

    public function createProduct(array $data)
    {
        return $this->insert($data);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteProduct(int $id)
    {
        return $this->delete($id);
    }
}