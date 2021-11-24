<?php

// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=next_blog;charset=utf8');
define('USER', 'blog_admin');
define('PASSWORD', 'wf9i2bp-3f');
define('MSG_BAD_REQUEST', '不正なリクエストです');
define('MSG_EMAIL_REQUIRED', 'メールアドレスを入力してください');
define('MSG_EMAIL_FORMAT', 'メールアドレスの形式が正しくありません');
define('MSG_EMAIL_MAX', 'メールアドレスは255文字以内で入力してください');
define('MSG_EMAIL_USED', 'すでにメールアドレスが登録されています');
define('MSG_PASSWORD_REQUIRED', 'パスワードを入力してください');
define('MSG_PASSWORD_FORMAT', 'パスワードは半角英数字を組み合わせた8文字以上で入力してください');
define('MSG_PASSWORD_MAX', 'パスワードは255文字以内で入力してください');
define('MSG_PASSWORD_NOT_MATCH', 'パスワードが一致しません');
define('MSG_CONFIRM_PASSWORD_REQUIRED', '確認用パスワードを入力してください');
define('MSG_USER_NAME_REQUIRED', 'ユーザー名を入力してください');
define('MSG_USER_NAME_MAX', 'ユーザー名は50文字以内で入力してください');
define('MSG_PROFILE_REQUIRED', '自己紹介を入力してください');
define('MSG_AVATAR_FORMAT', 'プロフィール画像は「jpg」、「png」、「gif」のみアップロード可能です');
define('MSG_UPLOAD_FAILED', 'ファイルのアップロードに失敗しました');
define('MSG_USER_CANT_REGISTER', 'アカウントの登録ができませんでした');
define('MSG_USER_REGISTER', 'アカウントを登録しました');
