<?php


namespace App;


use App\Model\FeedbackRepository;
use App\Model\FullNameRule;
use Core\Model\FormField;
use Core\Model\FormValidator;
use Core\Model\Rule\Date;
use Core\Model\Rule\Email;
use Core\Model\Rule\Number;
use Core\Model\Rule\PhoneNumber;
use Core\Model\Rule\Required;
use Core\Routing\Request;

class FeedbackController
{

    private $repository;

    /**
     * FeedbackController constructor.
     */
    public function __construct()
    {
        $this->repository = new FeedbackRepository();
    }

    public function showFeedback()
    {
        global $renderer;
        $renderer->render('feedback', [
            'data' => $this->repository->getAllSortedByDate()
        ]);
    }

    public function addFeedback(Request $request)
    {
        global $renderer;
        $data = $request->form();
        $validator = (new FormValidator())
            ->add('fio', new FormField('ФИО', [
                new Required(),
                new FullNameRule()
            ]))
            ->add('email', new FormField('E-mail', [
                new Required(),
                new Email()
            ]))
            ->add('message', new FormField('Сообщение', [
                new Required()
            ]));
        if ($validator->validate($data)) {
            $data['date'] = new \DateTime();
            $this->repository->addFeedback($data);
            $renderer->render('feedback', [
                'sent_success' => true,
                'data' => $this->repository->getAllSortedByDate()
            ]);
        } else {
            $renderer->render('feedback', [
                'keeper' => $request->form(),
                'errors' => $validator->getErrors(),
                'data' => $this->repository->getAllSortedByDate()
            ]);
        }
    }

    public function showUploadForm()
    {
        global $renderer;
        $renderer->render('upload_feedback');
    }

    public function uploadFeedback(Request $request)
    {
        global $renderer;
        if (filesize($_FILES['messages']['tmp_name']) == 0) {
            $success = false;
        } else {
            $success = $this->repository->replaceFile($_FILES['messages']['tmp_name']);
        }
        $renderer->render('upload_feedback', ['upload_success' => $success]);
    }

}