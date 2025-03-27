<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo $todo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Todos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="todos view content">
            <h3><?= h($todo->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $todo->hasValue('user') ? $this->Html->link($todo->user->email, ['controller' => 'Users', 'action' => 'view', $todo->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($todo->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Detail') ?></th>
                    <td><?= h($todo->detail) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tag') ?></th>
                    <td><?= h($todo->tag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($todo->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deadline') ?></th>
                    <td><?= h($todo->deadline) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($todo->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($todo->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>