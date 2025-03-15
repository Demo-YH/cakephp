<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo $todo
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Todo'), ['action' => 'edit', $todo->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Todo'), ['action' => 'delete', $todo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todo->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Todos'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New Todo'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="todos view large-9 medium-8 columns content">
    <h3><?= h($todo->title) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $todo->hasValue('user') ? $this->Html->link($todo->user->name, ['controller' => 'Users', 'action' => 'view', $todo->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($todo->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Detail') ?></th>
                <td><?= h($todo->detail) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Tag') ?></th>
                <td><?= h($todo->tag) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($todo->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Deadline') ?></th>
                <td><?= h($todo->deadline) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($todo->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($todo->modified) ?></td>
            </tr>
        </table>
    </div>
</div>
