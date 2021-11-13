<?php

use Imberel\Imberel\Core\Widget\Html\Link;
use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;


$form = new Form('post');
$form->add(new FormTitle('Reset Password'));
$form->add(new Input($model, 'text', 'Email Address', 'useremail'));
$form->add(new Button('submit', 'Reset'));
$form->add(new Link('/register', 'Not Yet Registered ?'));
$form->render();