<?php


namespace Core;


use App\Model\UserRepository;

class ProtectedController extends Controller
{
    private $authPage = '/auth';

    private $repository;

    /**
     * ProtectedController constructor.
     */
    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    protected function authenticate()
    {
        if (isset($_SESSION['auth'])) {
            $user = $this->repository->getUser($_SESSION['auth']);
            if ($user != null) {
                $user_data = [
                    'username' => $user['username'],
                    'fio' => $user['fio'],
                    'email' => $user['email']
                ];
                $_SESSION['user_data'] = $user_data;
                unset($user['password']);
                $_SESSION['user'] = $user;
                return;
            }
        }
        $this->redirect($this->authPage);
    }

    protected function user()
    {
        return $_SESSION['user'];
    }

}