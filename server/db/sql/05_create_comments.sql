CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment VARCHAR(200) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_comments_post_id
        FOREIGN KEY (post_id)
        REFERENCES posts(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_comments_user_id
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);
/*created_atとupdate_atには，登録時に現在の日時を設定するCURENT_TIMESTAMP,update_atには更新時に現在の日時を設定する
0NUPDATE CURRENT_TIMESTAMPを指定します｡
category_idとuser_idは外部キーとなるため､FOREIGN KEYの指定をします｡
参照先のpostsテーブルとusersテーブルのデータが変更､削除された場合､commentsのデータも変更，削除するため､オプションに
ON UP DELETE CASCADE ON UPDATE CASECAEDEを指定します
ユーザーや記事が存在しないのに､関連コメントだけが残っていても､表示することがないので､今回は一緒に削除するという仕様にしてます
WEBアプリの仕様によって変わってくるので､全て今回と一緒という勘違いはしないように*/
