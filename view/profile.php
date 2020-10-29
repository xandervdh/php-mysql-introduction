<?php require 'includes/header.php'; ?>
<div>

    <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
        <a href="http://mysqlintroduction.local/?page=overview">Overview</a>
        <div class="row panel">
            <div class="col-md-8  col-xs-12">
                <img alt="profile picture" src="<?php echo $student['image'] ?>" class="img-thumbnail picture hidden-xs" />
                <div class="header">
                    <h1><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h1>
                    <h4>Email: <?php echo $student['email']; ?></h4>
                    <span>Created at: <?php echo $student['created_at']; ?>"</span>
                </div>
            </div>
        </div>
        <form style="<?php echo $show ?>" id="profileButtons" action="" method="post">
            <input type="hidden" name="user" value="<?php echo $id['id'] ?>">
            <input type="submit" name="action" value="Edit">
            <input type="submit" name="action" value="Delete">
        </form>
    </div>

</div>
<?php require 'includes/footer.php'; ?>