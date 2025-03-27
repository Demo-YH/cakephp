<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Todo> $todos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Calenders'), ['controller' => 'Calenders', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('logout'), ['action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="todos index content">
        <?= $this->Html->link(__('New Todo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <div class="column column-95">
            <h3><?= __('Todos') ?></h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('user_id') ?></th>
                            <th><?= $this->Paginator->sort('title') ?></th>
                            <th><?= $this->Paginator->sort('detail') ?></th>
                            <th><?= $this->Paginator->sort('tag') ?></th>
                            <th><?= $this->Paginator->sort('deadline') ?></th>
                            <th><?= $this->Paginator->sort('created') ?></th>
                            <th><?= $this->Paginator->sort('modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($todos as $todo): ?>
                        <tr>
                            <td><?= $this->Number->format($todo->id) ?></td>
                            <td><?= $todo->hasValue('user') ? $this->Html->link($todo->user->email, ['controller' => 'Users', 'action' => 'view', $todo->user->id]) : '' ?></td>
                            <td><?= h($todo->title) ?></td>
                            <td><?= h($todo->detail) ?></td>
                            <td><?= h($todo->tag) ?></td>
                            <td><?= h($todo->deadline) ?></td>
                            <td><?= h($todo->created) ?></td>
                            <td><?= h($todo->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $todo->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $todo->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['action' => 'delete', $todo->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $todo->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
            </div>
        </div>
    </div>
</div>