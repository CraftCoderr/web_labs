<?php


namespace App;


use App\Model\FullNameRule;
use App\Model\GroupRule;
use App\Model\TestRepository;
use Core\Model\FormField;
use Core\Model\FormValidator;
use Core\Model\Rule\EqualsSecret;
use Core\Model\Rule\Required;
use Core\ProtectedController;
use Core\Routing\Request;

class TestController extends ProtectedController
{

    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new TestRepository();
    }

    public function showTest() {
        $this->render('test');
    }

    public function checkTest(Request $request) {
        $validator = (new FormValidator())
            ->add('fio', new FormField('ФИО', [
                new Required(),
                new FullNameRule()
            ]))
            ->add('group', new FormField('Группа', [
                new Required(),
                new GroupRule()
            ]))
            ->add('answer1', new FormField('Вопрос 1', [
                new Required(),
                new EqualsSecret('вероятность не допустить ошибку второго рода')
            ]))
            ->add('answer2', new FormField('Вопрос 2', [
                new Required(),
                new EqualsSecret('1')
            ]))
            ->add('answer3', new FormField('Вопрос 3', [
                new Required(),
                new EqualsSecret('выборочная совокупность – часть генеральной')
            ]));
        if ($validator->validate($request->form())) {
            $this->render('test', ['passed' => true]);
            $passed = true;
        } else {
            $this->render('test', ['keeper' => $request->form(), 'errors' => $validator->getErrors()]);
            $passed = false;
        }
        $data = $request->form();
        $data['date'] = (new \DateTime())->format('Y-m-d H:i:s');
        $data['result'] = $passed;
        $this->repository->addTestResult($data);
    }

    public function showResults()
    {
        $this->authenticate();
        $this->render('test_results', ['data' => $this->repository->getResults()]);
    }


}