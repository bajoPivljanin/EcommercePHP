<?php 
class Cart{
    protected $conn;

    public function __construct(){
        global $conn;
        $this->conn = $conn;
    }
    public function add_to_cart($product_id,$user_id,$quantity){
        $stmt = $this->conn->prepare("INSERT INTO cart (user_id,product_id,quantity) VALUES (?,?,?)");
        $stmt->bind_param("iis",$user_id,$product_id,$quantity);
        $stmt->execute();
    }
    public function get_cart_items(){
        $stmt = $this->conn->prepare("SELECT p.product_id, p.name, p.price, p.size, p.image, c.quantity
                                    FROM cart c
                                    INNER JOIN products p 
                                    ON c.product_id = p.product_id
                                    WHERE c.user_id = ?");

        $stmt->bind_param("i",$_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function destroy_cart(){
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i",$_SESSION['user_id']);
        $stmt->execute();
    }
}