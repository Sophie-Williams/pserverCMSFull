<?php

namespace PServerCMS\Form;


use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class LoginFilter extends ProvidesEventsInputFilter {

    public function __construct( ){

        $this->add(array(
            'name'       => 'username',
            'required'   => true,
        ));

        $this->add(array(
            'name'       => 'password',
            'required'   => true,
        ));
    }
}