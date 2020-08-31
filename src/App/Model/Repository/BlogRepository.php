<?php


namespace App\Model\Repository;


use App\Model\CachedCommentsHolder;
use App\Model\CachedUserHolder;
use App\Model\Comment;
use App\Model\Post;
use Core\DB;
use PDO;

class BlogRepository
{

    private $userRepository;

    /**
     * BlogRepository constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }


    public function getCount()
    {
        $stmt = DB::connect()->prepare('SELECT count(*) FROM blog_post');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function getPosts($page, $pageSize)
    {
        $stmt = DB::connect()->prepare('SELECT * FROM blog_post ORDER BY date DESC LIMIT ?, ?');
        $stmt->bindValue(1, $pageSize * ($page - 1), PDO::PARAM_INT);
        $stmt->bindValue(2, $pageSize, PDO::PARAM_INT);
        $stmt->execute();
        $posts = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $postData) {
            $posts[] = (new Post($postData['post_id'], $postData['date'], $postData['title'], $postData['image'], $postData['text']))
                                ->setComments(new CachedCommentsHolder($this, $postData['post_id']));
        }
        return $posts;
    }

    public function createPost($postData)
    {
        $stmt = DB::connect()->prepare('INSERT INTO blog_post(date, title, image, text) VALUES (?, ?, ?, ?)');
        $stmt->bindValue(1, $postData['date']);
        $stmt->bindValue(2, $postData['title']);
        $stmt->bindValue(3, $postData['image']);
        $stmt->bindValue(4, $postData['text']);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }

    public function getComments($postId)
    {
        $stmt = DB::connect()->prepare('SELECT * FROM post_comment WHERE post_id = ?');
        $stmt->bindValue(1, $postId);
        $stmt->execute();
        $comments = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $commentData) {
            $comments[] = (new Comment(
                $commentData['user_id'],
                $commentData['post_id'],
                $commentData['date'],
                $commentData['text']))
                    ->setUser(new CachedUserHolder($this->userRepository, $commentData['user_id']));
        }
        return $comments;
    }

    public function createComment($commentData)
    {
        $stmt = DB::connect()->prepare('INSERT INTO post_comment(user_id, post_id, date, text) VALUES (?, ?, ?, ?)');
        $stmt->bindValue(1, $commentData['user_id']);
        $stmt->bindValue(2, $commentData['post_id']);
        $stmt->bindValue(3, $commentData['date']);
        $stmt->bindValue(4, $commentData['text']);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return (new Comment($commentData['user_id'], $commentData['post_id'], $commentData['date'], $commentData['text']))
                ->setUser(new CachedUserHolder($this->userRepository, $commentData['user_id']));
        }
        return null;
    }

}