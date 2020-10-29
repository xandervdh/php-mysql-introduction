<?php require 'includes/header.php'; ?>

<div class="row">
<?php foreach ($students as $student) : ?>

    <div class="card col-3">
        <img class="card-img-top" src="<?php echo $student['image']; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h5>
            <p class="card-text">This profile is created at: <?php echo $student['created_at'] ?></p>
            <a href="?user= <?php echo $student['id'] ?>" class="btn btn-primary">Profile</a>
        </div>
    </div>

<?php endforeach; ?>
</div>

<?php require 'includes/footer.php'; ?>