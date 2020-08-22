<?php


namespace App;


use App\Model\FullNameRule;
use App\Model\GroupRule;
use Core\Model\FormField;
use Core\Model\FormValidator;
use Core\Model\Rule\EqualsSecret;
use Core\Model\Rule\Required;
use Core\Routing\Request;

class TestController
{

    public function showTest() {
        global $renderer;
        $renderer->render('test');
    }

    public function checkTest(Request $request) {
        global $renderer;
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
            $renderer->render('test', ['passed' => true]);
        } else {
            $renderer->render('test', ['keeper' => $request->form(), 'errors' => $validator->getErrors()]);
        }
    }

}