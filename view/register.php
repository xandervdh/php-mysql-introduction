<?php require 'includes/header.php' ?>

<div id="form">
    <span class="required">* = required</span>
    <form method="post" action="">
        <label for="firstName">First name</label><br>
        <input type="text" name="firstName" id="firstName"
               value="<?php echo $firstName ?>" <?php echo $firstNameError; ?>><br>
        <span class="required">* <?php echo $firstNameErrorMessage; ?></span><br>

        <label for="lastName">Last name</label><br>
        <input type="text" name="lastName" id="lastName"
               value="<?php echo $lastName ?>" <?php echo $lastNameError; ?>><br>
        <span class="required">* <?php echo $lastNameErrorMessage; ?></span><br>

        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" value="<?php echo $email ?>" <?php echo $emailError; ?>><br>
        <span class="required">* <?php echo $emailErrorMessage; ?></span><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"
            <?php echo $passwordError; ?>><br>
        <span class="required">* <?php echo $passwordErrorMessage; ?></span><br>

        <label for="passwordConfirm">Confirm password</label><br>
        <input type="password" name="passwordConfirm" id="passwordConfirm"
            <?php echo $passwordConfirmError; ?>><br>
        <span class="required">* <?php echo $passwordConfirmErrorMessage; ?></span><br>

        <input type="submit" value="Submit">
    </form>
</div>

<?php require 'includes/footer.php' ?>
