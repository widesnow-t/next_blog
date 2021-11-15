CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    image VARCHAR(255),
    comments_count INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_posts_category_id
        FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT fk_posts_user_id
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);
/*created_atとupdated_atには､登録時に現在の日時を設定するCURRENT_TIMESTAMP､updated_atには更新時に現在の日時を設定する
oncategory_idとuser_idは外部キーとなるため､FOREINGN KEYに指定をします｡

FOREINGN KEYを指定する際のSQLは以下の通りです｡
ONDELETEやON UPDATEオプションを指定すると､参照元のデータを削除，更新した時の動きを指定することが可能です｡オプションなので
ON DELETEやON UPDATEは省略可能です｡キーの名前は他とかぶらないようにしながら､自分で考えます｡
CONSTRAIN キーの名前
    FOREIGN KEY 外部キーとなるカラム名
    REFERENCES 参照先テーブル 参照先テーブルのカラム
    ON DELETE オプション ON UPDATE オプション
