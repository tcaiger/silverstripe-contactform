<?php


class EnquiryAdmin extends ModelAdmin {

    private static $url_segment = 'contact-enquiries';
    private static $menu_title  = 'Contact Enquiries';

    private static $managed_models = array(
        'ContactEnquiry'
    );

    public function getEditForm($id = null, $fields = null) {

        $form = parent::getEditForm($id, $fields);

        $fields = $form->Fields();

        $fields->insertBefore(HeaderField::create('IntroHeader', 'Contact Submissions'), 'ContactEnquiry');

        // Tailor the gridfield
        $gridField = $fields->fieldByName('ContactEnquiry');
        $gridFieldConfig = $gridField->getConfig();

        $gridFieldConfig->removeComponentsByType('GridFieldExportButton');
        $gridFieldConfig->removeComponentsByType('GridFieldPrintButton');
        $gridFieldConfig->removeComponentsByType('GridFieldAddNewButton');

        $form->setFields($fields);

        return $form;
    }

}