<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo $todo
 */
?>
<?php use App\Constants\Weekday; ?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Todos'), ['controller' => 'Todos', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Settings'), ['controller' => 'Settings', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('logout'), ['action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="calenders form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <?php echo $this->Html->css('calender'); ?>
                <div class="card-header">
                    <h5 class="month">
                        <a href="?ym=<?= $prev->format('Y-m-d') ?>&sd=<?= $selectDayWeek ?>">&lt;</a>
                        <?= $firstDay->format('Y年n月') ?>
                        <a href="?ym=<?= $next->format('Y-m-d') ?>&sd=<?= $selectDayWeek ?>">&gt;</a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <?php if ($selectDayWeek == Weekday::SUN): ?>
                            <thead>
                                <tr>
                                <?php foreach ($weekdays as $weekday): ?>
                                    <?php if ($weekday == Weekday::DAY_WEEK_LIST[Weekday::SUN]): ?>
                                        <th class='sun'><?= $weekday ?></th>
                                    <?php elseif ($weekday == Weekday::DAY_WEEK_LIST[Weekday::SAT]): ?>
                                        <th class="sat"><?= $weekday ?></th>
                                    <?php else: ?>
                                        <th><?= $weekday ?></th>
                                    <?php endif ?>
                                <?php endforeach; ?>
                                </tr>
                            </thead>
                        <?php endif ?>
                        <?php if ($selectDayWeek == Weekday::ISO_MON): ?>
                            <thead>
                                <tr>
                                <?php foreach ($weekdays as $weekday): ?>
                                    <?php if ($weekday == Weekday::DAY_WEEK_ISO_LIST[Weekday::ISO_SUN]): ?>
                                        <th class='sun'><?= $weekday ?></th>
                                    <?php elseif ($weekday == Weekday::DAY_WEEK_ISO_LIST[Weekday::ISO_SAT]): ?>
                                        <th class="sat"><?= $weekday ?></th>
                                    <?php else: ?>
                                        <th><?= $weekday ?></th>
                                    <?php endif ?>
                                <?php endforeach; ?>
                                </tr>
                            </thead>
                        <?php endif ?>

                        <tbody>
                            <?php foreach ($period as $index => $day): ?>
                                <?php if ($index % 7 == 0): ?>
                                    <tr>
                                <?php endif ?>
                                <?php
                                    $tdClass = '';
                                    if ($day->format('Y-m-d') === $today->format('Y-m-d')) {
                                        $tdClass .= 'today';
                                    }
                                    if ($day->format('w') == Weekday::SAT || $day->format('N') == Weekday::ISO_SAT) {
                                        $tdClass .= ' sat';
                                    } elseif ($day->format('w') == Weekday::SUN || $day->format('N') == Weekday::ISO_SUN) {
                                        $tdClass .= ' sun';
                                    }
                                ?>
                                <td class="<?= $tdClass ?>">

                                <?php if ($day->format('n') == $currentDate->format('n')): ?>
                                    <?= $day->format('j') ?>
                                    <?php if (isset ($todoData[$day->format('Y-m-d')])): ?>
                                        <?php foreach ($todoData[$day->format('Y-m-d')] as $todo): ?>
                                            <br><?= $todo['title'] ?>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                <?php else: ?>
                                    <?php if ($selectDayWeek == Weekday::ISO_MON && $day->format('n') == $next->format('n') && (($index + 1) % 7 == 0)): ?>
                                        <?php break; ?>
                                    <?php endif ?>
                                <?php endif ?>
                                </td>

                                <?php if (($index +1) % 7 == 0): ?>
                                    </tr>
                                <?php endif ?>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="weekdayBox">
                        <div class="left-content">開始曜日切替え：<br></div>
                        <div class="right-content">
                            <a href="?sd=<?= Weekday::SUN ?>&ym=<?= $currentDate->format('Y-m-d') ?>" class="btn-flat-border"><?= Weekday::START_DAY_WEEK_NAMES[Weekday::SUN] ?></a>
                            <a href="?sd=<?= Weekday::ISO_MON ?>&ym=<?= $currentDate->format('Y-m-d') ?>" class="btn-flat-border"><?= Weekday::START_DAY_WEEK_NAMES[Weekday::ISO_MON] ?></a>
                        </div> 
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
