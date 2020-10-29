<?php require 'includes/header.php'; ?>
<div>
    <a id="overview" class="btn btn-light" href="http://mysqlintroduction.local/?page=overview">Overview</a>

    <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
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
        <div id="profileButtons">
        <form style="<?php echo $show ?>" action="?edit=<?php echo $id['id'] ?>" method="post">
            <input type="submit" name="action" value="Edit">
        </form>
        <form style="<?php echo $show ?>" action="" method="post">
            <input type="submit" name="action" value="Delete">
        </form>
        </div>
    </div>

</div>
<?php require 'includes/footer.php'; ?>