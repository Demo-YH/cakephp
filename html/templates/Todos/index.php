<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo[]|\Cake\Collection\CollectionInterface $todos
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('New Todo'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('logout'), ['action' => 'logout'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
        <th scope="col"><?= $this->Paginator->sort('detail') ?></th>
        <th scope="col"><?= $this->Paginator->sort('tag') ?></th>
        <th scope="col"><?= $this->Paginator->sort('deadline') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($todos as $todo) : ?>
        <tr>
            <td><?= $this->Number->format($todo->id) ?></td>
            <td><?= $todo->hasValue('user') ? $this->Html->link($todo->user->name, ['controller' => 'Users', 'action' => 'view', $todo->user->id]) : '' ?></td>
            <td><?= h($todo->title) ?></td>
            <td><?= h($todo->detail) ?></td>
            <td><?= h($todo->tag) ?></td>
            <td><?= h($todo->deadline) ?></td>
            <td><?= h($todo->created) ?></td>
            <td><?= h($todo->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $todo->id], ['title' => __('View'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $todo->id], ['title' => __('Edit'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $todo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todo->id), 'title' => __('Delete'), 'class' => 'btn btn-danger']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
        <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
        <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>
