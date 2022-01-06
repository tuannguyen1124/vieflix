<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");
$account = new Account($con);

    if(isset($_POST["submitButton"])) {

        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        
        $success = $account->login($username, $password);

        if($success) {
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css" type="text/css">
    <title>Vieflix</title>
</head>

<body>

    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="images/logo.png">
                <h3 class="signup">Sign In</h3>
                <span>to continue to Vieflix</span>

            </div>
            <form action="" method="POST">

                <input type="text" name="username" placeholder="Username"
                    value="<?php echo getInputValue("username"); ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <?php echo $account->getError(Constants::$loginFailed);  ?>
                <input type="submit" value="Sign In" name="submitButton">


            </form>
            <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>
        </div>


    </div>


</body>

</html>