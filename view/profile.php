<?php require 'includes/header.php'; ?>
<div>
    <a href="http://mysqlintroduction.local/?page=overview">Overview</a><br>
<?php
echo 'Name: ' . $student['first_name'] . ' ' . $student['last_name'] . '<br>Email: ' . $student['email'] . '<br>Created at: ' . $student['created_at'];

?>
    <br><img width="300px" src="<?php echo $catPicture[0]['url'] ?>" alt="kitty">
    <form style="<?php echo $show ?>" action="" method="post">
        <input type="hidden" name="user" value="<?php echo $id['id'] ?>">
        <input type="submit" name="action" value="Edit">
        <input type="submit" name="action" value="Delete">
    </form>
</div>
<?php require 'includes/footer.php'; ?>