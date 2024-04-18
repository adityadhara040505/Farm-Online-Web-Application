<?php

class Farmer{

    public $conn;

    function __construct()
    {
        $this->conn = new mysqli("localhost","root","","farm_online");
        // $this->clear_all_non_available_crops();
    }

    function clear_all_non_available_crops(){
        if($statement = $this->conn->prepare("DELETE FROM online_crop_data WHERE current_quantity <= 0;")){
            return $statement->execute();
        }
    }

    // function __destruct()
    // {
    //     $this->conn->close();
    // }

    // Farmer sign up

    function add_farmer_reg($name, $mobileNo, $pass){
        if($statement = $this->conn->prepare("INSERT INTO `farmer_data` (`farmerName`,`farmerMbNumber`,`farmerPass`) VALUES (?,?,?)")){
            $statement->bind_param("sis",$name,$mobileNo,$pass);

            return $statement->execute();

        }
    }


    function check_farmer_existance($farmerMbNumber, $farmerPass) {
        if ($statement = $this->conn->prepare("SELECT EXISTS(SELECT 1 FROM `farmer_data` WHERE `farmerMbNumber` = ? AND `farmerPass` = ?) AS existence")) {
            $statement->bind_param("is", $farmerMbNumber, $farmerPass);
            
            if (!$statement->execute()) {
                // Error occurred while executing the statement
                echo "Error executing statement: " . $statement->error;
                return false;
            }
    
            // Bind result variable
            $statement->bind_result($existence);
    
            // Fetch result
            $statement->fetch();
    
            // Close statement
            $statement->close();
    
            return $existence;
        } else {
            // Error occurred while preparing the statement
            echo "Error preparing statement: " . $this->conn->error;
            return false;
        }
    }
    

    function get_farmer_name($farmerMbNumber){
        if($statement = $this->conn->prepare("SELECT `farmerName` FROM `farmer_data` WHERE `farmerMbNumber` = ?")){
            $statement->bind_param("i",$farmerMbNumber);

            $statement->execute();
            $result =  $statement->get_result();
            $row = $result->fetch_assoc(); 
            return $row['farmerName'];
        }
    }


    function get_all_online_crops_of_farmer(){}

    function add_farm_details($farmArea, $farmpH, $farmAddress){

        $farmerId = $_SESSION["farmerMbNumber"];

        $farm_id = 0;

        $sql = "SELECT MAX(farm_id) AS max_value FROM farm_data";

        $result = $this->conn->query($sql);

        if ($result) {
            // Fetch the result as an associative array
            $row = $result->fetch_assoc();
        
            // Store the max value in a PHP variable
            $farm_id = (int) $row['max_value'] + 1;
        
            // Free result set
            $result->free();
        }
        
        echo "<script>alert('Your Mobile number : $farmerId And Maximum value in farm id is : $farm_id');</script>";
        if($statement = $this->conn->prepare("INSERT INTO `farm_data` (`farmerId`, `farm_id`,  `farm_area`, `farm_pH`, `farm_address`) VALUES (?,?,?,?,?)")){
            $statement->bind_param("iiiis",$farmerId, $farm_id, $farmArea, $farmpH, $farmAddress);

            $_SESSION["farm_id"] = $farm_id;

            return $statement->execute();
        }

    }


    function check_farm_existance($farm_id, $farmerId){
        if ($statement = $this->conn->prepare("SELECT EXISTS(SELECT 1 FROM `farm_data` WHERE `farm_id` = ? AND `farmerId` = ?) AS existence")) {
            $statement->bind_param("ii", $farm_id,$farmerId);
            
            if (!$statement->execute()) {
                // Error occurred while executing the statement
                echo "Error executing statement: " . $statement->error;
                return false;
            }
    
                // Bind result variable
                $statement->bind_result($existence);
        
                // Fetch result
                $statement->fetch();
        
                // Close statement
                $statement->close();

                return $existence;
        
                // if($existence){
                    // if ($farmer_existance = $this->conn->prepare("SELECT EXISTS(SELECT 1 FROM `farmer_data` WHERE `farmerMbNumber` = ?) AS existence")) {
                    //     $farmer_existance->bind_param("i", $farmerId);
                        
                    //     if (!$farmer_existance->execute()) {
                    //         // Error occurred while executing the statement
                    //         echo "Error executing statement: " . $farmer_existance->error;
                    //         return false;
                    //     }
                
                    //     // Bind result variable
                    //     $farmer_existance->bind_result($existence);
                
                    //     // Fetch result
                    //     $farmer_existance->fetch();
                
                    //     // Close statement
                    //     $farmer_existance->close();
                
                    //     return $existence;
                    // } else {
                    //     // Error occurred while preparing the statement
                    //     echo "Error preparing statement: " . $this->conn->error;
                    //     return false;
                    // }
                // }
            } else {
                // Error occurred while preparing the statement
                echo "Error preparing statement: " . $this->conn->error;
                return false;
            }
        }


    // function add_crop_details($crop_name, $crop_catagory, $date_of_sowing, $date_of_reaping, $farm_id, $crop_image){

        

    // }


    function add_customer_details($name, $mobileNo, $pass){
        if($statement = $this->conn->prepare("INSERT INTO `customer_data` (`customer_name`,`customer_mb_number`,`customer_pass`) VALUES (?,?,?)")){
            $statement->bind_param("sis",$name,$mobileNo,$pass);

            return $statement->execute();

        }
    }


    function check_customer_existance($mobileNo,$pass){
        if ($statement = $this->conn->prepare("SELECT EXISTS(SELECT 1 FROM `customer_data` WHERE `customer_mb_number` = ? AND `customer_pass` = ?) AS existence")) {
            $statement->bind_param("is", $mobileNo, $pass);
            
            if (!$statement->execute()) {
                // Error occurred while executing the statement
                echo "Error executing statement: " . $statement->error;
                return false;
            }
    
            // Bind result variable
            $statement->bind_result($existence);
    
            // Fetch result
            $statement->fetch();
    
            // Close statement
            $statement->close();
    
            return $existence;
        } else {
            // Error occurred while preparing the statement
            echo "Error preparing statement: " . $this->conn->error;
            return false;
        }
    }


    function get_customer_name($mobileNo){
        if($statement = $this->conn->prepare("SELECT `customer_name` FROM `customer_data` WHERE `customer_mb_number` = ?")){
            $statement->bind_param("i",$mobileNo);

            $statement->execute();
            $result =  $statement->get_result();
            $row = $result->fetch_assoc(); 
            return $row['customer_name'];
        }
    }


    function get_farmer_name_by_farm_id($farm_id){
        if($statement = $this->conn->prepare("SELECT farmerName FROM `farmer_data` WHERE `farmerMbNumber` = (SELECT farmerId FROM `farm_data` WHERE `farm_id` = ?)")){
            $statement->bind_param("i",$farm_id);

            $statement->execute();
            $result =  $statement->get_result();
            $row = $result->fetch_assoc(); 
            return $row['farmerName'];
        }
    }

    function move_crops_online($crop_id, $price, $quantity){



        if($statement = $this->conn->prepare("INSERT INTO online_crop_data (crop_id, crop_name, crop_catagory, farm_id, crop_image, price, current_quantity) SELECT crop_id, crop_name, crop_catagory, farm_id, crop_image, ?, ? FROM processing_crop_data WHERE crop_id = ?;")){
            $statement->bind_param("iii",$price,$crop_id,$quantity);

            if($statement->execute()){
                if($deletingColumn = $this->conn->prepare("DELETE FROM processing_crop_data WHERE crop_id = ?;")){
                    $deletingColumn->bind_param("i",$crop_id);

                    return $deletingColumn->execute();
                }
            }else{
                return false;
            }

        }

    }

    function delete_crop_from_online_crop_data($crop_id){
        if($farmDeletion = $this->conn->prepare("DELETE FROM farm_data WHERE farm_id IN (SELECT farm_id FROM online_crop_data WHERE crop_id = ?);")){
            $farmDeletion->bind_param("i",$crop_id);
            if($statement = $this->conn->prepare("DELETE FROM online_crop_data WHERE crop_id = ?;")){
                $statement->bind_param("i",$crop_id);
                if($statement->execute()){
                    return $farmDeletion->execute();
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function buy_crop($customerMbNumber, $crop_id, $ordered_quantity){ 

        // $order_id = 0;

        // $date = date("Y-m-d");

        // $sql = "SELECT MAX(farm_id) AS max_value FROM customer_orders_in_process";

        // $result = $this->conn->query($sql);

        // if ($result) {
        //     // Fetch the result as an associative array
        //     $row = $result->fetch_assoc();
        
        //     // Store the max value in a PHP variable
        //     $order_id = (int) $row['max_value'] + 1;
        
        //     // Free result set
        //     $result->free();
        // }
        // if($statement = $this->conn->prepare("INSERT INTO `customer_orders_in_process` (`order_id`, `order_date`, `ordered_crop_id `, `customer_id `, `crop_name`, `crop_catagory`, `crop_image`, `price`, `ordered_quantity`, `provider_name`) VALUES (?,?,?,?,?,?,?,?,?,?)")){
        //     $statement->bind_param("isiissbiis",$order_id, $date, $crop_id, $customerMbNumber,);
        // }

        if($getCropInfo = $this->conn->prepare("SELECT * from online_crop_data WHERE crop_id = ?")){

            $getCropInfo->bind_param("i",$crop_id);

            if($info = $getCropInfo->execute()){

                $result = $getCropInfo->get_result();

                // Fetch the result as an associative array
                $data = mysqli_fetch_assoc($result);

                // Free the result set
                $result->free();

                $order_id = 0;

                $date = date("Y-m-d");

                $sql = "SELECT MAX(`order_id`) AS max_value FROM customer_orders_in_process";

                $result = $this->conn->query($sql);

                if ($result) {
                    // Fetch the result as an associative array
                    $row = $result->fetch_assoc();
                
                    // Store the max value in a PHP variable
                    $order_id = (int) $row['max_value'] + 1;
                
                    // Free result set
                    $result->free();
                }

                $farmerName = $this->get_farmer_name_by_farm_id($data["farm_id"]);

                if($statement = $this->conn->prepare("INSERT INTO `customer_orders_in_process` (`order_id`, `order_date`, `ordered_crop_id`, `customer_id`, `crop_name`, `crop_catagory`, `crop_image`, `price`, `ordered_quantity`, `provider_name`) VALUES (?,?,?,?,?,?,?,?,?,?)")){
                    $statement->bind_param("isiissbiis",$order_id, $date, $crop_id, $customerMbNumber, $data["crop_name"], $data["crop_catagory"], $data["crop_image"], $data["price"], $ordered_quantity, $farmerName);
                    
                    if($statement->execute()){

                        if($updateData = $this->conn->prepare("UPDATE online_crop_data SET `current_quantity` = `current_quantity` - ? WHERE `crop_id` = ?")){
                            $updateData->bind_param("ii",$ordered_quantity,$crop_id);

                            return $updateData->execute();

                        }

                    }else{
                        return false;
                    }

                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    function place_order($order_id){

        if($fetchData = $this->conn->prepare("SELECT * FROM customer_orders_in_process WHERE order_id = ?")){
            $fetchData->bind_param("i",$order_id);
            if($fetchData->execute()){

                $date = date("Y-m-d");

                $order_id_to_set = 0;

                $sql = "SELECT MAX(`order_id`) AS max_value FROM customer_orders_placed";

                $result = $this->conn->query($sql);

                if ($result) {
                    // Fetch the result as an associative array
                    $row = $result->fetch_assoc();
                
                    // Store the max value in a PHP variable
                    $order_id_to_set = (int) $row['max_value'] + 1;
                
                    // Free result set
                    $result->free();
                }

                $result = $fetchData->get_result();
                $row = mysqli_fetch_assoc($result);

                if($statement = $this->conn->prepare("INSERT INTO `customer_orders_placed` (`order_id`, `date_arrived`, `ordered_crop_id`, `customer_id`, `crop_name`, `crop_catagory`, `crop_image`, `price`, `ordered_quantity`, `provider_name`) VALUES (?,?,?,?,?,?,?,?,?,?);")){
                    $statement->bind_param("isiissbiis",$order_id_to_set, $date, $row["ordered_crop_id"], $row["customer_id"], $row["crop_name"], $row["crop_catagory"], $row["crop_image"], $row["price"], $row["ordered_quantity"], $row["provider_name"]);

                    if($statement->execute()){
                        if($delete = $this->conn->prepare("DELETE FROM customer_orders_in_process WHERE order_id = ?")){
                            $delete->bind_param("i", $order_id);

                            return $delete->execute();

                            
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
            return false;
        }else{
            return false;
        }
    }


}

?>