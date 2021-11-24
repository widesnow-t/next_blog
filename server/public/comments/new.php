<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/../common/_head.php' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <div class="wrapper">
        <?php include_once __DIR__ . '/_post.php' ?>

        <form action="create.php" method="post">
            <?php include_once __DIR__ . '/_form.php' ?>
            <div class="form-group">
                <input type="submit" class="btn" value="登録">
            </div>
        </form>
    </div>
    <?php include_once __DIR__ . '/../common/_footer.php' ?>
</body>

</html>