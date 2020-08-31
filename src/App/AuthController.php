<?php


namespace App;


use App\Model\Rule\FullNameRule;
use App\Model\Repository\UserRepository;
use App\Model\User;
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
            if ($user != null && $user->getPassword() === sha1($data['password'])) {
                $this->setupSession($user);
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

    public function checkRegister(Request $request)
    {
        $xmldata = new \SimpleXMLElement($request->body());
        $username = $xmldata['username'];

        if ($this->repository->checkUsernameExists($username)) {
            $result = 'invalid';
        } else {
            $result = 'valid';
        }
        $this->response('<check username="'.$result.'" />', 'application/xml');
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
            if ($user = $this->repository->createUser($data)) {
                $this->setupSession($user);
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
        unset($_SESSION['auth']);
        unset($_SESSION['user']);
        unset($_SESSION['user_data']);
        $this->redirect('/');
    }

    private function setupSession(User $user) {
        $_SESSION['auth'] = $user->getUsername();
        $user_data = [
            'username' => $user->getUsername(),
            'fio' => $user->getFio(),
            'email' => $user->getEmail()
        ];
        $_SESSION['user_data'] = $user_data;
        $user->clearCredentials();
        $_SESSION['user'] = $user;
    }

}