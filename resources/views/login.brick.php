<?php

use Imberel\Imberel\Core\Widget\Html\Link;
use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;


$form = new Form('post');
$form->add(new FormTitle('Sign In'));
$form->add(new Input($model, 'text', 'Email Address', 'useremail'));
$form->add(new Input($model, 'password', 'Password', 'password'));
$form->add(new Link('/register', 'Not Yet Registered ?'));
$form->add(new Button('submit', 'Sign In'));
$form->add(new Link('/resetpassword', 'Forgot Password ?'));
$form->render();