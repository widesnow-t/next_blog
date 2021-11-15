CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
/*create_atとupdate_atには､登録時に現在の日時を設定するCURRENT_TIMESTAMP,update_atには登録時と更新時に現在の日時を設定するCURRENT_TIMESTMPを指定します｡
上記の設定をすることで､データ登録時や更新時に､SQLで日時を設定する必要がなくなります｡