<?php
	class Fask extends Feed  {

		private static $db = array(

	    );

	    private static $has_one = array( 
	        'Fanswer' => 'Fanswer',
	    );

        private static $summary_fields = array(
          'ID',
          'Text'
        );

	    public function getFanswerForm() {
           
            
            $fask = $this; 
            $star = $fask->Star();
            $starPage = $star->StarPage();
            $fanswer = $fask->Fanswer();

            if($fanswer){
                $textFanswer = $fanswer->Text;
                $giarisposto = _t('Page.GIARISPOSTO', '<p>Hai già risposto a questa Fask. Vuoi modificare la tua risposta?</p>');
                $text = LiteralField::create("literalfield", $giarisposto);
            } else {
                $textFanswer = "";
                $text = LiteralField::create("literalfield", "");
            }

            

            // if($star->BookTimer){
            //     return null;
            // }

            $fields = new FieldList(
                new hiddenField('StarPage', 'StarPage', Director::absoluteBaseURL() . $starPage->URLSegment),
                $text,
                HiddenField::create('FaskID','FaskID',$this->ID),
                HiddenField::create('StarID','StarID',$star->ID),
                HiddenField::create('FileID'),
                TextareaField::create('Text','Text', $textFanswer)->setAttribute('class', 'form-control mb15')
                
            );

            $actions = new FieldList( 
                FileField::create('VideoUpload')->setAttribute('capture', 'camcorder')->setAttribute('accept', 'video/*')->setFolderName('Uploads/star')->addExtraClass('custom-file-input'),
                FileField::create('AudioUpload')->setAttribute('capture', 'microphone')->setAttribute('accept', 'audio/*')->setFolderName('Uploads/star')->addExtraClass('custom-file-input'),
                FileField::create('PictureUpload')->setAttribute('capture', 'cam')->setAttribute('accept', 'image/*')->setFolderName('Uploads/star')->addExtraClass('custom-file-input'),
                FormAction::create('SendFileForm', 'Send')->setAttribute('class', 'btn btn-red c-white')
            );
            $form = Form::create($starPage, 'yourFanswer', $fields, $actions)->setEncType('multipart/form-data');

            return $form;
         
        }

        
}