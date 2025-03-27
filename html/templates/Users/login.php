<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create() ?>
            <fieldset>
            <legend><?= __('ユーザー名とパスワードを入力してください') ?></legend>
            <?= $this->Form->control('email', ['required' => true]) ?>
            <?= $this->Form->control('password', ['required' => true]) ?>
            </fieldset>
            <?= $this->Form->button(__('Login')) ?>
            <?= $this->Form->end() ?>
            <?= $this->Html->link("Add User", ['action' => 'add']) ?>
        </div>
    </div>
</div>