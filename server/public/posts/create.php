<?php
require_once __DIR__ . '/../../common/config.php';
require_once __DIR__ . '/../../common/functions.php';
require_once __DIR__ . '/../../models/Post.php';

session_start();

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    // トークンの検証
    $token = filter_input(INPUT_POST, 'token');
    if (empty($_SESSION['token']) || $_SESSION['token'] !== $token) {
        redirect_alert(
            '/',
            MSG_BAD_REQUEST
        );
    }

    // ログイン判定
    $current_user = get_login_user();
    if (empty($current_user)) {
        redirect_alert(
            '/users/log_in.php',
            MSG_PLEASE_SIGN_IN
        );
    }

    $input_params =
        filter_input(
            INPUT_POST,
            'post',
            FILTER_DEFAULT,
            FILTER_REQUIRE_ARRAY
        );
    // ログインユーザーと画像ファイルの情報もセット
    $input_params['current_user'] = $current_user;
    $input_params['image_tmp'] = $_FILES['image'];

    $post = new Post(Post::setParams($input_params));

    // バリデーション & 登録
    if ($post->validate() && $post->insert()) {
        redirect_notice(
            "show.php?id={$post->getId()}",
            MSG_POST_REGISTER
        );
    } else {
        redirect_alert(
            'new.php',
            MSG_POST_CANT_REGISTER,
            $input_params,
            $post->get_errors()
        );
    }
}
