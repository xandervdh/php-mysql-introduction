<?php require 'includes/header.php'; ?>

<?php
echo 'Name: ' . $student['first_name'] . ' ' . $student['last_name'] . '<br>Email: ' . $student['email'] . '<br>Created at: ' . $student['created_at'];
?>

<?php require 'includes/footer.php'; ?>