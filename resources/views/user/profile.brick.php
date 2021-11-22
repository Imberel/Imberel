<?php

use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;

?>

<div>
    <?php
    $form = new Form('post');
    $form->add(new FormTitle('Update Profile', 'form-header'));
    $form->add(new Input($model, 'text', 'Username', 'username', 'auth-input', 'input-icon fa fa-user'));
    $form->add(new Input($model, 'text', 'Firstname', 'firstname', 'auth-input', 'input-icon fa fa-user'));
    $form->add(new Input($model, 'text', 'Lastname', 'lastname', 'auth-input', 'input-icon fa fa-user'));
    $form->add(new Input($model, 'password', 'Password', 'password', 'auth-input', 'input-icon fa fa-key'));
    $form->add(new Button('submit', 'Update', 'auth-button'));
    $form->render();
    ?>
</div>