<?php


namespace App;


use App\Model\BlogRepository;
use App\Model\FullNameRule;
use Core\AdminController;
use Core\Controller;
use Core\DB;
use Core\Files;
use Core\Model\FormField;
use Core\Model\FormValidator;
use Core\Model\Rule\Date;
use Core\Model\Rule\Email;
use Core\Model\Rule\Required;
use Core\Routing\Request;
use Core\Routing\RouteNotFound;
use PDO;

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

}