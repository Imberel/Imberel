<?php

use Imberel\Imberel\Core\Widget\Html\Link;
use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;

$form = new Form('post');
$form->add(new FormTitle('Sign Up', 'form-header'));
$form->add(new Input($model, 'text', 'Email Address', 'useremail', 'auth-input', 'input-icon fa fa-envelope'));
$form->add(new Input($model, 'text', 'Username', 'username', 'auth-input', 'input-icon fa fa-at'));
$form->add(new Input($model, 'text', 'Firstname', 'firstname', 'auth-input', 'input-icon fa fa-user'));
$form->add(new Input($model, 'text', 'Lastname', 'lastname', 'auth-input', 'input-icon fa fa-user'));
$form->add(new Input($model, 'password', 'Password', 'password', 'auth-input', 'input-icon fa fa-key'));
$form->add(new Input($model, 'password', 'Confirm Password', 'confirmpassword', 'auth-input', 'input-icon fa fa-key'));
$form->add(new Link('/login', 'Already Registered ?', 'auth-link'));
$form->add(new Button('submit', 'Sign Up', 'auth-button'));
$form->render();