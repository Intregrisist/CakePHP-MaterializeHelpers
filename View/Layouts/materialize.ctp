<?php

echo $this->M->html5($this->fetch('title'), $this->fetch('description'), 'en');
    echo $this->M->css(array(
        '//cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css'
    ));


echo $this->M->body();
    echo $this->element('Layouts/header');

    echo '<main>';
    echo $this->fetch('content');
    echo '</main>';

    echo $this->element('Layouts/footer');

    echo $this->M->script(array(
        '//code.jquery.com/jquery-2.1.4.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js',
        'main'
    ));

echo $this->M->end();