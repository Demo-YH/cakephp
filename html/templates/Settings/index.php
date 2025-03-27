<?php
/**
 * @var \App\View\AppView $this
 * @var  \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Calenders'), ['controller' => 'Calenders', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Todos'), ['controller' => 'Todos', 'action' => 'index'], ['class' => 'nav-link']) ?>
            <?= $this->Html->link(__('logout'), ['action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="todos form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <?php
                    echo $this->Form->control('週の始まり選択', [
                        'options' => $weekdayList, 
                        'default' => $userSettingWeekday,
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
