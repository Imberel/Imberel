<?php

use Imberel\Imberel\Core\Widget\Html\Link;
use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;


$form = new Form('post');
$form->add(new FormTitle('Reset Password', 'form-header'));
$form->add(new Input($model, 'text', 'Email Address', 'useremail', 'auth-input', 'input-icon fa fa-envelope'));
$form->add(new Link('/register', 'Not Yet Registered ?', 'auth-link'));
$form->add(new Button('submit', 'Send Link', 'auth-button'));
$form->render();