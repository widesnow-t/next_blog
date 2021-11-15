CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    profile TEXT NOT NULL,
    avatar VARCHAR(100),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
/*created_atとupdated_atには､登録時に現在の日時を設定するCURRENT_TIMESTAMP,updated_atには登録時と更新時に現在の日時設定する
CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMPを指定します