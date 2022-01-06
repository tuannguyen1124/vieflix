<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);



if (isset($_POST["submitButton"])){
    $firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
    $lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $confirmEmail = FormSanitizer::sanitizeFormEmail($_POST['confirmEmail']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $confirmPassword = FormSanitizer::sanitizeFormPassword($_POST['confirmPassword']);

    $success = $account->register($firstName, $lastName, $username, $email, $confirmEmail, $password, $confirmPassword);
    if($success){
        header("Location: login.php");
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
                <h3 class="signup">Sign Up</h3>
                <span>to continue to Vieflix</span>

            </div>
            <form action="" method="POST">
                <?php echo $account->getError(Constants::$firstNameCharacters);  ?>
                <input type="text" name="firstName" placeholder="First Name"
                    value="<?php echo getInputValue("firstName"); ?>" required>

                <?php echo $account->getError(Constants::$lastNameCharacters);  ?>
                <input type="text" name="lastName" placeholder="Last Name"
                    value="<?php echo getInputValue("lastName"); ?>" required>

                <?php echo $account->getError(Constants::$usernameCharacters);  ?>
                <?php echo $account->getError(Constants::$usernameTaken);  ?>
                <input type="text" name="username" placeholder="Username"
                    value="<?php echo getInputValue("username"); ?>" required>

                <?php echo $account->getError(Constants::$emailInvalid);  ?>
                <?php echo $account->getError(Constants::$emailTaken);  ?>
                <input type="text" name="email" placeholder="Email" value="<?php echo getInputValue("email"); ?>"
                    required>
                <?php echo $account->getError(Constants::$emailsDontMatch);  ?>
                <input type="text" name="confirmEmail" placeholder="Confirmed Email"
                    value="<?php echo getInputValue("confirmEmail"); ?>" required>

                <?php echo $account->getError(Constants::$passwordLenght);  ?>
                <input type="password" name="password" placeholder="Password" required>
                <?php echo $account->getError(Constants::$passwordsDontMatch);  ?>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <input type="submit" value="Sign Up" name="submitButton">


            </form>
            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        </div>


    </div>


</body>

</html>