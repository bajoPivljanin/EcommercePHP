<?php 
class Product{
    protected $conn;

    public function __construct(){
        global $conn;
        $this->conn = $conn;
    }
    public function fetch_all(){
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function create($name,$price,$size,$image){
        $sql ="INSERT INTO products (name, price, size, image) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss",$name,$price,$size,$image);
        $stmt->execute();
    }
    public function read($product_id){
        $sql ="SELECT * FROM products where product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    } 
    public function update($product_id,$name,$price,$size,$image){
        $sql = "UPDATE products SET name = ?, price = ?, size = ?, image = ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi",$name,$price,$size,$image,$product_id);
        $stmt->execute();
    }
    public function delete($product_id){
        $sql ="DELETE FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$product_id);
        $stmt->execute();
    }
    
}