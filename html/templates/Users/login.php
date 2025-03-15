<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/signin'); ?>
<div class="users form content">
<h3>Login</h3>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('ユーザー名とメールアドレス、パスワードを入力してください') ?></legend>
        <?= $this->Form->control('name', ['required' => true]) ?>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login')); ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link("Add User", ['action' => 'add']) ?>
</div>
