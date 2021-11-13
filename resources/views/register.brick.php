<?php

use Imberel\Imberel\Core\Widget\Html\Link;
use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;

$form = new Form('post');
$form->add(new FormTitle('Sign Up'));
$form->add(new Input($model, 'text', 'Email Address', 'useremail'));
$form->add(new Input($model, 'text', 'Username', 'username'));
$form->add(new Input($model, 'text', 'Firstname', 'firstname'));
$form->add(new Input($model, 'text', 'Lastname', 'lastname'));
$form->add(new Input($model, 'password', 'Password', 'password'));
$form->add(new Input($model, 'password', 'Confirm Password', 'confirmpassword'));
$form->add(new Link('/login', 'Already Registered ?'));
$form->add(new Button('submit', 'Sign Up'));
$form->render();