<?php
require_once __DIR__ . '/../../common/config.php';
require_once __DIR__ . '/../../common/functions.php';
require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Post.php';

session_start();

$token = generate_token();
$alert = get_alert();
$errors = get_errors();

// ログイン判定
$current_user = get_login_user();
if (empty($current_user)) {
    redirect_alert(
        '/users/log_in.php',
        MSG_PLEASE_SIGN_IN
    );
}

$post = new Post(get_post_data());
$categories = Category::findAll();
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/../common/_head.php' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <div class="wrapper">
        <div class="form-main">
            <h2 class="title">ブログ登録</h2>
            <?php include_once __DIR__ . '/../common/_alert.php' ?>

            <form action="create.php" method="post" enctype="multipart/form-data">
                <?php include_once __DIR__ . '/_form.php' ?>
                <div class="form-group">
                    <input type="submit" class="btn" value="登録">
                </div>
            </form>
        </div>
    </div>

    <?php include_once __DIR__ . '/../common/_footer.php' ?>
</body>

</html>