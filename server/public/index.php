<?php
require_once __DIR__ . '/../common/functions.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';

session_start();

$alert = get_alert();
$notice = get_notice();
$current_user = get_login_user();

$categories = Category::findAll();

$category_id = filter_input(INPUT_GET, 'category_id') ?? '';
$page = filter_input(INPUT_GET, 'page') ?? 1;

$posts = Post::findIndexView($category_id, $page);
$total_count = Post::findIndexViewCount($category_id);
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/common/_head.php' ?>

<body>
    <?php include_once __DIR__ . '/common/_header.php' ?>
    <div class="wrapper">
        <?php include_once __DIR__ . '/common/_alert.php' ?>
        <?php include_once __DIR__ . '/common/_notice.php' ?>

        <?php if ($current_user['id']) : ?>
            <div class="mobile-area">
                <a href="/posts/new.php" class="btn btn-block btn-new">ブログを書く</a>
            </div>
        <?php endif; ?>
        <div class="post-index-main">
            <article class="post-index-group">
                <?php foreach ($posts as $p) : ?>
                    <section class="post-index-list">
                        <div class="image-trim">
                            <a href="/posts/show.php?id=<?= h($p->getId()) ?>">
                                <img src="<?= h($p->getImagePath()) ?>" alt="">
                            </a>
                        </div>
                        <h3 class="post-index-title"><?= h($p->getTitle()) ?></h3>
                        <p>
                            <?= mb_substr(h($p->getBody()), 0, 50) ?><span><a href="/posts/show.php?id=<?= h($p->getId()) ?>">続きを読む</a></span>
                        </p>
                        <div class="post-index-detail">
                            <div class="post-index-user">
                                <img src="<?= $p->getUser()->getAvatarPath() ?>" alt="">
                                <h4 class="post-index-user-name"><?= $p->getUser()->getName() ?></h4>
                            </div>
                            <div class="post-index-meta">
                                <p class="post-index-date"><?= $p->getCreatedAt() ?></p>
                                <div class="post-index-comment">
                                    <i class="fa fa-comments-o fa-icon"></i>
                                    <?= $p->getCommentsCount() ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
            </article>
            <aside class="log-in-user-area">
                <?php if ($current_user['id']) : ?>
                    <div class="log-in-user-group">
                        <div class="log-in-user">
                            <img src="<?= h($current_user['avatar']) ?>" alt="">
                            <h4 class="log-in-user-name">
                                <?= h($current_user['name']) ?>
                            </h4>
                        </div>
                        <a href="/posts/new.php" class="btn btn-block btn-new">ブログを書く</a>
                    </div>
                <?php else : ?>
                    <div class="user-btn-group">
                        <a href="/users/new.php" class="btn btn-block btn-new">アカウント登録</a>
                        <a href="/users/log_in.php" class="btn btn-block">ログイン</a>
                    </div>
                <?php endif; ?>
                <div class="category">
                    <h3 class="category-title">CATEGORIES</h3>
                    <ul class="category-list">
                        <li><a href="/">全て</a></li>
                        <?php foreach ($categories as $c) : ?>
                            <li><a href="/?category_id=<?= $c->getId() ?>"><?= $c->getName() ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
        <?= create_pager($page, $total_count, $category_id) ?>
    </div>

    <?php include_once __DIR__ . '/common/_footer.php' ?>
</body>

</html>