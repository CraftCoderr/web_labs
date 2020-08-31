<?php


namespace App;


use App\Model\Repository\BlogRepository;
use Core\AdminController;
use Core\Files;
use Core\Model\FormField;
use Core\Model\FormValidator;
use Core\Model\Rule\Required;
use Core\Routing\Request;
use Core\Routing\RouteNotFound;
use lib\JsHttpRequest;

class BlogController extends AdminController
{
    private static $PAGE_SIZE = 5;

    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new BlogRepository();
    }

    public function show($page) {
        $count = $this->repository->getCount();
        if (($page > ceil($count / self::$PAGE_SIZE) && $page != 1) || $page < 1 ) {
            throw new RouteNotFound();
        }
        $posts = $this->repository->getPosts($page, self::$PAGE_SIZE);
        $this->render('blog', ['posts' => $posts, 'pages' => $count]);
    }

    public function postForm()
    {
        $this->checkAdmin();

        $this->render('blog_form');
    }

    public function makePost(Request $request)
    {
        $this->checkAdmin();

        $validator = (new FormValidator())
            ->add('title', new FormField('Заголовок', [
                new Required()
            ]))
            ->add('text', new FormField('Текст', [
                new Required()
            ]));
        $data = $request->form();
        if ($validator->validate($data)) {
            $date = new \DateTime();
            if (filesize($_FILES['image']['tmp_name']) != 0) {
                $filename = Files::uploaded($date->getTimestamp());
                move_uploaded_file($_FILES['image']['tmp_name'], $filename);
                $data['image'] = $date->getTimestamp();
            }
            $data['date'] = $date->format('Y-m-d H:i:s');
            $success = $this->repository->createPost($data);
        } else {
            $success = false;
        }
        $this->render('blog_form', ['errors' => $validator->getErrors(), 'post_success' => $success]);
    }

    public function import() {
        $this->checkAdmin();

        $success = false;
        if (filesize($_FILES['posts']['tmp_name']) !== 0) {
            if (($handle = fopen($_FILES['posts']['tmp_name'], "r")) !== FALSE) {
                while (($row = fgetcsv($handle, 1000)) !== FALSE) {
                    if (count($row) == 4) {
                        $data = [
                            'title' => $row[0],
                            'text' => $row[1],
                            // ignored $row[2]
                            'date' => $row[3]
                        ];
                        $validator = (new FormValidator())
                            ->add('title', new FormField('Заголовок', [
                                new Required()
                            ]))
                            ->add('text', new FormField('Текст', [
                                new Required()
                            ]))
                            ->add('date', new FormField('Дата', [
                                new Required()
                            ]));
                        if ($validator->validate($data)) {
                            $this->repository->createPost($data);
                        }
                    }
                }
                fclose($handle);
                $success = true;
            }
        }
        $this->render('blog_form', ['import_success' => $success]);
    }

    public function editPost(Request $request)
    {
        $this->checkAdmin();

        new JsHttpRequest("utf-8");
        $postData['title'] = $_REQUEST['title'];
        $postData['text'] = $_REQUEST['text'];
        $validator = (new FormValidator())
            ->add('title', new FormField('Заголовок', [
                new Required()
            ]))
            ->add('text', new FormField('Текст', [
                new Required()
            ]));

        if ($validator->validate($postData)) {
            $postData['post_id'] = $_REQUEST['post_id'];
            if ($this->repository->updatePost($postData)) {
                $result = $postData;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        $GLOBALS['_RESULT'] = [
            'result' => $result,
            'errors' => $validator->getErrors()
        ];
    }

    public function makeComment(Request $request)
    {
        $this->authenticate();

        new JsHttpRequest("utf-8");
        $commentData['text'] = $_REQUEST['text'];
        $validator = (new FormValidator())
            ->add('text', new FormField('Текст комментария', [
                new Required()
            ]));

        if ($validator->validate($commentData)) {
            $commentData['post_id'] = $_REQUEST['post_id'];
            $commentData['date'] = (new \DateTime())->format('Y-m-d H:i:s');
            $commentData['user_id'] = $this->user()->getId();
            $comment = $this->repository->createComment($commentData);
            if ($comment) {
                $result = [
                    'user_id' => $comment->getUserId(),
                    'post_id' => $comment->getPostId(),
                    'date' => $comment->getDate(),
                    'text' => $comment->getText()
                ];
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        $GLOBALS['_RESULT'] = [
            'result' => $result,
            'username' => $this->user()->getUsername(),
            'errors' => $validator->getErrors()
        ];

    }

}