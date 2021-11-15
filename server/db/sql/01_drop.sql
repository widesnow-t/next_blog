DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

    /*IF EXISTS句は､｢テーブルが存在する場合｣という意味になります｡ 
    IF EXISTSをつけづに実行すると､初回はテーブルが存在しないため､存在しないテーブルを削除しようとしてエラーが発生します｡
    */