<?php
require_once __DIR__ . '/../../common/config.php';
require_once __DIR__ . '/../../common/functions.php';
require_once __DIR__ . '/../../models/Comment.php';

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
            'comment',
            FILTER_DEFAULT,
            FILTER_REQUIRE_ARRAY
        );

    // 編集するコメントの情報取得
    $comment = Comment::find($input_params['id']);

    if (empty($comment)) {
        redirect_alert(
            '/',
            MSG_COMMENT_DOES_NOT_EXIST
        );
    }

    // 自分のコメントかチェック
    if ($current_user['id'] !== $comment->getUserId()) {
        redirect_alert(
            "/posts/show.php?id={$comment->getPostId()}",
            MSG_COMMENT_CANNOT_BE_MODIFIED
        );
    }

    // プロパティの上書き
    $comment->updateProperty($input_params);

    // バリデーション & 更新
    if ($comment->validate() && $comment->update()) {
        redirect_notice(
            "/posts/show.php?id={$comment->getPostId()}",
            MSG_COMMENT_UPDATE
        );
    } else {
        redirect_alert(
            "edit.php?id={$comment->getId()}",
            MSG_COMMENT_CANT_UPDATE,
            $input_params,
            $comment->get_errors()
        );
    }
}
