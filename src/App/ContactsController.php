<?php


namespace App;


use App\Model\FullNameRule;
use Core\Controller;
use Core\Model\FormField;
use Core\Model\FormValidator;
use Core\Model\Rule\Date;
use Core\Model\Rule\Email;
use Core\Model\Rule\Number;
use Core\Model\Rule\PhoneNumber;
use Core\Model\Rule\Required;
use Core\Routing\Request;

class ContactsController extends Controller
{

    public function showPage()
    {
        global $renderer;
        $renderer->render('contacts');
    }

    public function sendMessage(Request $request)
    {
        $validator = (new FormValidator())
            ->add('fio', new FormField('ФИО', [
                new Required(),
                new FullNameRule()
            ]))
            ->add('gender', new FormField('Пол', [
                new Required()
            ]))
            ->add('age', new FormField('Возраст', [
                new Required(),
                new Number(14)
            ]))
            ->add('dob', new FormField('Дата рождения', [
                new Required(),
                new Date()
            ]))
            ->add('phone', new FormField('Номер телефона', [
                new Required(),
                new PhoneNumber()
            ]))
            ->add('email', new FormField('E-mail', [
                new Required(),
                new Email()
            ]))
            ->add('message', new FormField('Сообщение', [
                new Required()
            ]));
        if ($validator->validate($request->form())) {
            $this->render('contacts', ['sent_success' => true]);
        } else {
            $this->render('contacts', ['keeper' => $request->form(), 'errors' => $validator->getErrors()]);
        }
    }

}