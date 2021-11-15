<?php

//データベース接続用関数を定義してるファイルを読み込む
require_once __DIR__ . '/../common/functions.php';

//ブログのタイトル，本文､コメントを投稿する際に使用するランダムな文字列をRAND_VALUEという定数で定義
define('RAND_VALUE', '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

//ターミナルに実行確認メッセージを表示
echo "データベースをSET UPしますか? [YES] or [NO]" . PHP_EOL;

//上記で入力された内容を取得
$answer = trim(fgets(STDIN));

//yes以外の時は処理終了
if ($answer !== 'yes') exit;

try {
    //データベースに接続
    $dbh = connectDb();

    //外部キー制約を無効化
    $dbh->query('SET foreign_key_check = 0');

    //テーブルの削除 & categoriesテーブルのSET UP
    $sql_dir = __DIR__ . '/sql/';
    //sqlディレクトリ内にある､sqlファイルをすべて読み込み､1件づつ処理していきます
    foreach (glob($sql_dir . "*.sql") as $file) {
        $sql = file_get_contents($file);
        $dbh->exec($sql);
    }
    echo '---- テーブル削除完了 ----' . PHP_EOL;
    echo '---- categoriesテーブル SET UP完了 ----' . PHP_EOL;

    //外部キー制約有効化
    $dbh->query('SET foreign_key_checks = 1');

    //セットアップ完了メッセージの表示
    echo '---- データベース SET UP 完了 ----' . PHP_EOL;
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

