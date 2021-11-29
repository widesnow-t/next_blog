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

    // 入力内容の受け取り
    $input_params =
        filter_input(
            INPUT_POST,
            'post',
            FILTER_DEFAULT,
            FILTER_REQUIRE_ARRAY
        );
    // 画像ファイルの情報もセット
    $input_params['image_tmp'] = $_FILES['image'];

    // 編集するブログの情報取得
    $post = Post::find($input_params['id']);

    if (empty($post)) {
        redirect_alert(
            '/',
            MSG_POST_DOES_NOT_EXIST
        );
    }

    // 自分のブログかチェック
    if ($current_user['id'] !== $post->getUserId()) {
        redirect_alert(
            "show.php?id={$post->getId()}",
            MSG_POST_CANNOT_BE_MODIFIED
        );
    }

    // プロパティの上書き
    $post->updateProperty($input_params);

    // バリデーション & 更新
    if ($post->validate() && $post->update()) {
        redirect_notice(
            "show.php?id={$post->getId()}",
            MSG_POST_UPDATE
        );
    } else {
        redirect_alert(
            "edit.php?id={$post->getId()}",
            MSG_POST_CANT_UPDATE,
            $input_params,
            $post->get_errors()
        );
    }
}
