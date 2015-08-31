<?php
    $options = array('M' => 'Male', 'F' => 'Female');
    $animals = array('c'=>'Cat','d'=>'Dog','e'=>'Elephant','f'=>'Frog');
    $attributes = array();

    $this->validationErrors = array(
        'User' => array(
            'first_name' => array('Please enter a valid first name.','Twice'),
            'bio' => 'You must enter something for your bio.',
            'remember' => array('You must check me.')
        )
    );

?>
<div class="container">
    <?php
        echo $this->MForm->create('User');
        echo $this->M->tag('h3','MForm - User Form');
        // Text (VERIFIED)
        echo $this->MForm->input('first_name', array('icon'=>'mdi-editor-mode-edit'));
        echo $this->MForm->input('last_name', array('length'=>'10'));
        // Textarea (VERIFIED)
        echo $this->MForm->input('bio',array('type'=>'textarea', 'icon'=>'mdi-editor-mode-edit'));
        // Radio (VERIFIED)
        echo $this->MForm->radio('gender', $options, array('inline'=>false,'legend'=>false));
        echo $this->MForm->input('gender2', array('type'=>'radio','options'=>$options,'gap'=>true,'inline'=>false,'legend'=>false));
        // Checkbox (VERIFIED)
        echo $this->MForm->input('remember', array('type'=>'checkbox'));
//        echo $this->MForm->checkbox('remember2');
        // Single Select
        echo $this->MForm->input('animal', array('type'=>'select','options'=>$animals));
        // File
        echo $this->MForm->file('image');
    ?>
</div>

