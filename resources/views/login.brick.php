<?php

use Imberel\Imberel\Core\Widget\Html\Link;
use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;


$form = new Form('post');
$form->add(new FormTitle('Sign In', 'form-header'));
$form->add(new Input($model, 'text', 'Email Address', 'useremail', 'auth-input', 'input-icon fa fa-envelope'));
$form->add(new Input($model, 'password', 'Password', 'password', 'auth-input', 'input-icon fa fa-key'));
$form->add(new Link('/resetpassword', 'Forgot Password ?', 'auth-link'));
$form->add(new Button('submit', 'Sign In', 'auth-button'));
$form->render();