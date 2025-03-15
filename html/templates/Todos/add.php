<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo $todo
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('List Todos'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="todos form content">
    <?= $this->Form->create($todo) ?>
    <fieldset>
        <legend><?= __('Add Todo') ?></legend>
        <?php
            echo $this->Form->control('user_id', [
                'options' => $users, 
                'default' => $login,
            ]);
            echo $this->Form->control('title');
            echo $this->Form->control('detail');
            echo $this->Form->control('tag');
            echo $this->Form->control('deadline');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
