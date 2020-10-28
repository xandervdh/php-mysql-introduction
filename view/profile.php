<?php require 'includes/header.php'; ?>

<?php
echo 'Name: ' . $student['first_name'] . ' ' . $student['last_name'] . '<br>Email: ' . $student['email'] . '<br>Created at: ' . $student['created_at'];

?>
    <form style="<?php echo $show ?>" action="" method="post">
        <input type="hidden" name="user" value="<?php echo $id['id'] ?>">
        <input type="submit" name="action" value="Edit">
        <input type="submit" name="action" value="Delete">
    </form>
<?php require 'includes/footer.php'; ?>