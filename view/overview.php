<?php require 'includes/header.php'; ?>

<?php
foreach ($students as $student) {
    echo 'name: ' . $student['first_name'] . ' ' . $student['last_name'] . ' email: ' . $student['email'] . 'created at: ' . $student['created_at'] . ' <a href="?user=' . $student['id'] . '">Profile</a><br>';
}
?>

<?php require 'includes/footer.php'; ?>