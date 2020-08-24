<?php


namespace App;


use App\Model\FullNameRule;
use App\Model\UserRepository;
use Core\Controller;
use Core\Model\FormField;
use Core\Model\FormValidator;
use Core\Model\Rule\Email;
use Core\Model\Rule\Length;
use Core\Model\Rule\Required;
use Core\Routing\Request;

class AuthController extends Controller
{

    private $repository;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    public function showLoginForm()
    {
        $this->render('auth');
    }

    public function login(Request $request)
    {
        $validator = (new FormValidator())
            ->add('username', new FormField('Имя пользователя', [
                new Required()
            ]))
            ->add('password', new FormField('Пароль', [
                new Required()
            ]));
        $data = $request->form();
        if ($validator->validate($data)) {
            $user = $this->repository->getUser($data['username']);
            if ($user != null && $user['password'] === sha1($data['password'])) {
                session_start();
                $_SESSION['user'] = $user['username'];
                $this->redirect('/');
            } else {
                $validator->error('login', 'Неправильное имя пользователя или пароль');
            }
        }

        $keeper = $request->form();
        unset($keeper['password']);
        $this->render('auth', ['keeper' => $keeper, 'errors' => $validator->getErrors()]);
    }

    public function showRegisterForm()
    {
        $this->render('register');
    }

    public function register(Request $request)
    {
        $validator = (new FormValidator())
            ->add('fio', new FormField('ФИО', [
                new Required(),
                new FullNameRule()
            ]))
            ->add('email', new FormField('E-mail', [
                new Required(),
                new Email()
            ]))
            ->add('username', new FormField('Имя пользователя', [
                new Required(),
                new Length(3, 255)
            ]))
            ->add('password', new FormField('Пароль', [
                new Required(),
                new Length(6, 4096)
            ]));
        $data = $request->form();
        if ($validator->validate($data)) {
            $data['password'] = sha1($data['password']);
            if ($this->repository->createUser($data)) {
                $_SESSION['user'] = $data['username'];
                $this->redirect('/');
            } else {
                $validator->error('register', 'Пользователь с таким именем пользователя или e-mail уже зарегистрирован');
            }
        }

        $keeper = $request->form();
        unset($keeper['password']);
        $this->render('register', ['keeper' => $keeper, 'errors' => $validator->getErrors()]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->redirect('/');
    }

}