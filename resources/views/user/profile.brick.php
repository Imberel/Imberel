<?php

use Imberel\Imberel\Core\Widget\Html\Button;
use Imberel\Imberel\Core\Widget\Html\Form\Form;
use Imberel\Imberel\Core\Widget\Html\Form\Input;
use Imberel\Imberel\Core\Widget\Html\Form\FormTitle;

?>

<div class="card">
    <?php
    $form = new Form('post');
    $form->add(new FormTitle('Update Profile', 'form-header'));
    $form->add(new Input($model, 'text', 'Firstname', 'firstname', 'auth-input', 'input-icon fa fa-user'));
    $form->add(new Input($model, 'text', 'Lastname', 'lastname', 'auth-input', 'input-icon fa fa-user'));
    $form->add(new Input($model, 'password', 'Password', 'password', 'auth-input', 'input-icon fa fa-key'));
    $form->add(new Button('submit', 'Update', 'auth-button', 'updateProfile'));
    $form->render();
    ?>
</div>

<div class="card">
    <?php
    $form = new Form('post');
    $form->add(new FormTitle('Change Username', 'form-header'));
    $form->add(new Input($model2, 'text', 'Username', 'username', 'auth-input', 'input-icon fa fa-at'));
    $form->add(new Input($model2, 'password', 'Password', 'password', 'auth-input', 'input-icon fa fa-key'));
    $form->add(new Button('submit', 'Update', 'auth-button', 'updateUsername'));
    $form->render();
    ?>
</div>

<div class="card">
    <?php
    $form = new Form('post');
    $form->add(new FormTitle('Change Password', 'form-header'));
    $form->add(new Input($model3, 'password', 'Old Password', 'password', 'auth-input', 'input-icon fa fa-key'));
    $form->add(new Input($model3, 'password', 'New Password', 'newPassword', 'auth-input', 'input-icon fa fa-key'));
    $form->add(new Input($model3, 'password', 'Confirm New Password', 'confirmPassword', 'auth-input', 'input-icon fa fa-key'));
    $form->add(new Button('submit', 'Update', 'auth-button', 'updatePassword'));
    $form->render();
    ?>
</div>