<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");

    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

    function getInputValue($name) {
        if (isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<html>
<head>
    <title>Welcome to Spootify!</title>
</head>
<body>
    <div id="InputContainer">
    <form id="loginForm" action="register.php" method="POST">
        <h2>Login to your account</h2>
        <p>
            <label for="loginUsername">Username</label>
            <input id="loginUsername" type="text" name="loginUsername" placeholder="e.g. JohnWick" required/>
        </p>
        <p>
            <label for="loginPassword">Password</label>
            <input id="loginPassword" type="password" name="loginPassword" required/>
        </p>
        <p>
            <input type="submit" name="Login" />
        </p>
    
    </form>

    <form id="registerForm" action="register.php" method="POST">
        <h2>Create your free account</h2>
        <p>
            <?php echo $account->getError(Constants::$usernameCharacters); ?>
            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="e.g. JohnWick" value="<?php getInputValue('username') ?>" required/>
        </p>
        <p>
            <?php echo $account->getError(Constants::$firstNameCharacters); ?>
            <label for="firstName">First Name</label>
            <input id="firstName" type="text" name="firstName" placeholder="e.g. John" value="<?php getInputValue('firstName') ?>" required/>
        </p>
        <p>
            <?php echo $account->getError(Constants::$lastNameCharacters); ?>
            <label for="lastName">Last Name</label>
            <input id="lastName" type="text" name="lastName" placeholder="e.g. Wick" value="<?php getInputValue('lastName') ?>" required/>
        </p>
        <p>
            <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
            <?php echo $account->getError(Constants::$emailInvalid); ?>
            <?php echo $account->getError(Constants::$emailTaken); ?>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="e.g. john@wick.com" value="<?php getInputValue('email') ?>" required/>
        </p>
        <p>
            <label for="email2">Confirm Email</label>
            <input id="email2" type="email" name="email2" placeholder="e.g. john@wick.com" value="<?php getInputValue('email2') ?>" required/>
        </p>
        <p>
            <?php echo $account->getError(Constants::$passwordCharacters); ?>
            <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
            <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Your Password" required/>
        </p>
        <p>
            <label for="password2">Confirm Password</label>
            <input id="password2" type="password" name="password2" required/>
        <p>
            <input type="submit" name="Sign Up" />
        </p>
    
    </form>
    </div>
</body>
</html>