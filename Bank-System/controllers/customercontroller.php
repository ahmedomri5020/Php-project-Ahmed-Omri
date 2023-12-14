<?php
require_once('../models/customer.php');
require_once ('../database/config.php'); 

class CustomerController extends Connexion {
    public function __construct() {
        parent::__construct();
    }
    function insert(Customer $customer){
        $query = "insert into customer(CIN, password, name, adresse, contactinfo) values(?, ?, ?, ?, ?)";
        $res = $this->pdo->prepare($query);
        $aryy = array($customer->getCIN(), $customer->getPassword(), $customer->getName(), $customer->getAdresse(), $customer->getContactinfo());
        return $res->execute($aryy);
    }
    function login($cin, $password) {
        $query = "SELECT * FROM customer WHERE CIN = ? AND password = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($cin, $password));
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($customer) {
            header("Location: user.html");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Identifiants incorrects.
                  </div>';
        }
    }
    public function liste($searchID = null) {
        $query = "SELECT * FROM customer";

        if ($searchID !== null) {
            $query .= " WHERE CIN LIKE :searchID";
        }

        $stmt = $this->pdo->prepare($query);

        if ($searchID !== null) {
            $searchID = '%' . $searchID . '%';
            $stmt->bindParam(':searchID', $searchID, PDO::PARAM_STR);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo '<table border="1" style="width: 80%; margin: 20px auto; border-collapse: collapse; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1); border-radius: 5px; overflow: hidden;">
                    <form method="GET" action="customerlist.php" style="text-align: center; margin: 20px 0;">
                        <label for="searchID">Search by Customer CIN:</label>
                        <input type="text" id="searchID" name="searchID" style="padding: 8px; border: 1px solid #ccc; border-radius: 3px;">
                        <input type="submit" value="Search" style="padding: 10px; background-color: #00539f; color: #fff; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s ease;">
                    </form>
                    <tr>
                        <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Customer CIN</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Name</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Address</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Contact Info</th>
                    </tr>';

            foreach ($results as $row) {
                echo '<tr>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['CIN'] . '</td>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['name'] . '</td>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['adresse'] . '</td>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['contactinfo'] . '</td>
                        
                    </tr>';
            }
        }
    }
    function delete($CIN) {
        $query = "DELETE FROM accounts WHERE CIN = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $CIN, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
?>
