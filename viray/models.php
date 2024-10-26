function insertNewUser($pdo, $username, $password) {

    $checkUserSql = "SELECT * FROM usr_pass WHERE username = ?";
    $checkUserSqlStmt = $pdo -> prepare($checkUserSql);
    $checkUserSqlStmt -> execute([$username]);

    if ($checkUserSqlStmt -> rowCount() == 0) {

        $sql = "INSERT INTO usr_pass (username, password) VALUES (?,?)";
        $stmt = $pdo -> prepare($sql);
        $executeQuery = $stmt -> execute([$username, $password]);
        
        if ($executeQuery) {
            $_SESSION['message'] = "User successfully inserted";
            return true;
        }

        else {
            $_SESSION['message'] = "An error occured from the query";
        }
    }
    else {
        $_SESSION['message'] = "User already exists";
    }
}