<?php

require_once('Model.php');

class Task extends Model
{
    // プロパティ
    protected $table = 'tasks';

    // 新規作成に使用するメソッド
    public function create($data)
    {
        // DBに保存
        // このクラスのインスタンスの
        // db_managerプロパティの
        // DbManagerクラスのインスタンス
        // dbhプロパティの
        // PDOのインスタンス
        // prepareメソッドを実行
        // INSERT INTO (カラム名, ,) VALUES (値, 値, 値,)
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . ' (title, contents, created) VALUES (?, ?, ?)');
        $stmt->execute($data);
    }
    // * update()を以下に追加する
    public function update($data)
    {
        // sql
        // 更新したい項目　= title = $title
        // 更新したい項目　= title = $title, contents = $contents
        // update テーブル名　set 更新したい項目　where id = $id(どこの);

        // カラム名　= id
        // カラム名　= id, title, contents
        // select カラム名　from テーブル名　どこの;
        // どこの　= id
        // どこの　= id = $id and title = $title

        $stmt = $this->db_manager->dbh->prepare('UPDATE ' . $this->table . ' SET title = ?, contents = ? WHERE id = ?');
        // 実行する
        $stmt->execute($data);　
    }



    // * (findByTitle()を以下に追加する)
    public function findByTitle($data)
    {
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' WHERE title LIKE ?');
        $stmt->execute($data);
        $tasks = $stmt->fetchAll();
        return $tasks;
    }



}