
<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts()
    {
        return $this->db
            ->table($this->table)
            ->get_all();
    }

    public function getProduct(int $id)
    {
        return $this->db
            ->table($this->table)
            ->where('id', $id)
            ->get();
    }

    public function createProduct(array $data)
    {
        return $this->db
            ->table($this->table)
            ->insert($data);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->db
            ->table($this->table)
            ->where('id', $id)
            ->update($data);
    }

    public function deleteProduct(int $id)
    {
        return $this->db
            ->table($this->table)
            ->where('id', $id)
            ->delete();
    }
}
