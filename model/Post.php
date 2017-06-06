<?php namespace Model;

use Kernel\BaseModel;

class Post extends BaseModel {

    public function setNew($post, $user, $file) {
        extract($post); extract($file);
        $lastPost = $this->findLast();
        $lastPost->id = (int)$lastPost->id;
        $lastPost->id++;
        $this->setFile($name, $type, $size, 0, $lastPost->id, $user->id);
        $statement = "INSERT INTO posts(title, description, user_id, posted_in) VALUES(?, ?, ?, NOW())";
        return $this->pdo->prepare($statement)->execute([$title, $content, $user->id]);
    }

    private function setFile($name, $type, $size, $shared, $post_id, $user_id) {
        $statement = "INSERT INTO files(name, type, size, shared, post_id, user_id) VALUES(?, ?, ?, ?, ?, ?)";
        return $this->pdo->prepare($statement)->execute([$name, $type, $size, $shared, $post_id, $user_id]);
    }

}