<?php


class ContactFormExtension extends Extension {

    private static $allowed_actions = array(
        'ContactForm'
    );


    public function ContactForm() {

        $fields = new FieldList(
        TextField::create('FirstName')->setAttribute('placeholder', 'Name'),
                EmailField::create('Email')->setAttribute('placeholder', 'Email'),
                TextField::create('Phone', 'Contact Number')->setAttribute('placeholder', 'Contact Number'),
                TextField::create('Subject')->setAttribute('placeholder', 'Subject'),
                TextareaField::create('Message')->setAttribute('placeholder', 'Your Query')
        );

        $actions = new FieldList(
        FormAction::create('SubmitContactForm')
            ->setTitle('Submit')
        );

        $required = new RequiredFields(array(
            'Name', 'Email', 'Subject', 'Message'
        ));

        $controller = Page_Controller::curr();
        $form = new BootstrapForm($controller , __FUNCTION__, $fields, $actions, $required);
        $form->addExtraClass('contact-form');

        return $form;
    }

    function SubmitContactForm($data, $form) {

        $enquiry = new ContactEnquiry;
        foreach ($data as $name => $value) {
            $enquiry->$name = $value;
        }

        if ($enquiry->write()) {
            $form->sessionMessage("Your enquiry has been sent. You will receive a response soon.", 'good');
        } else {
            $form->sessionMessage("There was a problem with the form. Please try again.", 'bad');
        }

        return $this->redirectBack();
    }
}