<?php require 'includes/header.php' ?>
<span>Registration succesfull!</span>
<div id="form">
    <form method="post" action="?user=<?php echo $id['id'] ?>">
        <input type="submit" value="Go to profile">
    </form>
</div>

<?php require 'includes/footer.php' ?>
