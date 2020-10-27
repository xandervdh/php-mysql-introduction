<?php require 'includes/header.php'; ?>

<div id="form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" <?php echo $emailError; ?>><br>
        <span class="required"><?php echo $emailErrorMessage; ?></span><br>

        <label for="password">Password</label><br>
        <input type="text" name="password" id="password" <?php echo $passwordError; ?>><br>
        <span class="required"><?php echo $passwordErrorMessage; ?></span><br>

        <input type="submit" value="Submit">
    </form>
</div>

<?php require 'includes/footer.php'; ?>