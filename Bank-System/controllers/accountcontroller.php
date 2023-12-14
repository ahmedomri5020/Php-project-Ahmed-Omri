<?php
require_once('../database/config.php');
require_once('../models/account.php');

class AccountController extends Connexion {
    public function __construct() {
        parent::__construct();
    }
    function insert(Account $account){
        $query="insert into accounts(balance,customerCIN)values(?, ?)";
        $res=$this->pdo->prepare($query);
        $aryy =array($account->getBalance(),$account->getCustomerCIN());
        //var_dump($aryy);
        return $res->execute($aryy);
        }
        function withdraw($customerCIN, $montant) {
            $query = "SELECT balance FROM accounts WHERE customerCIN = ? AND balance >= ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($customerCIN, $montant));
            $result = $stmt->fetch();
        
            if ($result) {
                $updateQuery = "UPDATE accounts SET balance = balance - ? WHERE customerCIN = ?";
                $updateStmt = $this->pdo->prepare($updateQuery);
                $updateStmt->execute(array($montant, $customerCIN));
                if ($updateStmt->rowCount() > 0) {
                    return "Withdrawal successful.";
                } else {
                    return "Failed to withdraw amount.";
                }
            } else {
                return "Insufficient balance for withdrawal.";
            }
        }
        function deposit($customerCIN, $montant) {
            $query = "SELECT balance FROM accounts WHERE customerCIN = ? ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($customerCIN));
            $result = $stmt->fetch();
        
            if ($result) {
                $updateQuery = "UPDATE accounts SET balance = balance + ? WHERE customerCIN = ?";
                $updateStmt = $this->pdo->prepare($updateQuery);
                $updateStmt->execute(array($montant, $customerCIN));
                if ($updateStmt->rowCount() > 0) {
                    return "deposit successful.";
                } else {
                    return "Failed to deposit amount.";
                }
            } else {
                return "Insufficient balance for deposit.";
            }
        }
        
        function liste($searchID = null) {
            $query = "SELECT * FROM accounts";
        
            if ($searchID !== null) {
                $query .= " WHERE customerCIN LIKE :searchID";
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
                        <form method="GET" action="accountlist.php" style="text-align: center; margin: 20px 0;">
                            <label for="searchID">Search by Customer CIN:</label>
                            <input type="text" id="searchID" name="searchID" style="padding: 8px; border: 1px solid #ccc; border-radius: 3px;">
                            <input type="submit" value="Search" style="padding: 10px; background-color: #00539f; color: #fff; border: none; border-radius: 3px; cursor: pointer; transition: background-color 0.3s ease;">
                        </form>
                        <tr>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Account ID</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Balance</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Customer CIN</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Actions</th>
                        </tr>';
        
                foreach ($results as $row) {
                    echo '<tr>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['accountID'] . '</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['balance'] . '</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['customerCIN'] . '</td>
                            <td class="action-icons" style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">
                                <form method="post" action="delete-action.php">
                                    <input type="hidden" name="accountID" value="' . $row['accountID'] . '">
                                    <button type="submit" class="btn btn-danger" style="background-color: #d9534f; color: #fff; border: none; border-radius: 3px; padding: 8px 12px;"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </td>
                        </tr>';
                }
        
                echo '</table>';
            } else {
                echo "No accounts found.";
            }
        }                                           
           function deleteAccount($accountID) {
                        $query = "DELETE FROM accounts WHERE accountID = ?";
                        $stmt = $this->pdo->prepare($query);
                        $stmt->bindParam(1, $accountID, PDO::PARAM_INT);
                        $stmt->execute();
                
                        if ($stmt->rowCount() > 0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
            public function balance($searchID = null) {
                if(isset($_POST['cin'])) {
                    $searchID = $_POST['cin'];
                }
                $query = "SELECT * FROM accounts";
                if ($searchID !== null) {
                    $query .= " WHERE customerCIN = ?";
                }
                $stmt = $this->pdo->prepare($query);
            
                if ($searchID !== null) {
                    $stmt->bindParam(1, $searchID, PDO::PARAM_STR);
                }
            
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                if ($results) {
                    echo '<table border="1" style="width: 80%; margin: 20px auto; border-collapse: collapse; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1); border-radius: 5px; overflow: hidden;">
                            <tr>
                                <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Account ID</th>
                                <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Balance</th>
                                <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left; background-color: #00539f; color: #fff;">Customer CIN</th>
                            </tr>';
                    foreach ($results as $row) {
                        echo '<tr>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['accountID'] . '</td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['balance'] . '</td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">' . $row['customerCIN'] . '</td>
                                </td>
                            </tr>';
                    }
                    echo '</table>';
                } else {
                    echo "No accounts found.";
                }
            }        
        }
        
    