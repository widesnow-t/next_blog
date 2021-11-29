<?php
require_once __DIR__ . '/../../common/config.php';
require_once __DIR__ . '/../../common/functions.php';
require_once __DIR__ . '/../../models/User.php';

session_start();
$errors = [];

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

    // 削除するアカウントの情報取得
    $id = filter_input(INPUT_POST, 'id');
    $user = User::find($id);

    if (empty($user)) {
        redirect_alert(
            '/',
            MSG_USER_DOES_NOT_EXIST
        );
    }

    // 自分のアカウントかチェック
    if ($_SESSION['current_user']['id'] !== $user->getId()) {
        redirect_alert(
            '/',
            MSG_USER_CANNOT_BE_DELETE
        );
    }

    // 削除
    if ($user->delete()) {
        redirect_notice(
            '/',
            MSG_USER_DELETE
        );
    } else {
        redirect_alert(
            "edit.php?id={$id}",
            MSG_USER_CANT_DELETE
        );
    }
}
