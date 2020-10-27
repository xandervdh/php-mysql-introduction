<?php require 'includes/header.php'; ?>

<?php
echo 'Name: ' . $student['first_name'] . ' ' . $student['last_name'] . '<br>Email: ' . $student['email'] . '<br>Created at: ' . $student['created_at'];

?>
    <form style="<?php echo $show ?>" method="post">
        <input type="hidden" value="<?php echo $id['id'] ?>">
        <input type="submit" value="edit">
        <input type="submit" value="delete">
    </form>
<?php require 'includes/footer.php'; ?>