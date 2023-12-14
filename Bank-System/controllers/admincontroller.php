<?php
require_once('../models/admin.php');
require_once ('../database/config.php'); 

class AdminController extends Connexion {
    public function __construct() {
        parent::__construct();
    }
function insert(Admin $admin){
    $query="insert into admin(CIN, password, name, adresse, contactinfo) values(?, ?, ?, ?, ?)";
    $res=$this->pdo->prepare($query);
    $aryy = array($admin->getCIN(), $admin->getPassword(), $admin->getName(), $admin->getAdresse(), $admin->getContactinfo());
    return $res->execute($aryy);
}
function login($cin, $password) {
    $query = "SELECT * FROM admin WHERE CIN = ? AND password = ?";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(array($cin, $password));
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        header("Location: admin.html");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Identifiants incorrects.
              </div>';
    }
}
public function liste($searchID = null) {
    $query = "SELECT * FROM admin";

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
                <form method="GET" action="adminlist.php" style="text-align: center; margin: 20px 0;">
                    <label for="searchID">Search by Admin CIN:</label>
                    <input type="text" id="searchID" name="searchID" style="padding: 8px; border: 1px solid #ccc; border-radius: 3px;">
                    <input type="submit" value="Search" style="padding: 10px; background-color: #00539f; color: #fff; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s ease;">
                </form>
                <tr>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Admin CIN</th>
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

        echo '</table>';
    } else {
        echo "No admins found.";
    }
}



}
?>
