<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo $todo
 */
?>
<?php use App\const\Weekday; ?>
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
                        <?= $startDay->format('Y年n月') ?>
                        <a href="?ym=<?= $next->format('Y-m-d') ?>&sd=<?= $selectDayWeek ?>">&gt;</a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <?php if ($selectDayWeek == Weekday::START_SUN): ?>
                            <thead>
                                <tr>
                                    <th class="sun">日</th>
                                    <th>月</th>
                                    <th>火</th>
                                    <th>水</th>
                                    <th>木</th>
                                    <th>金</th>
                                    <th class="sat">土</th>
                                </tr>
                            </thead>
                        <?php endif ?>
                        <?php if ($selectDayWeek == Weekday::START_MON): ?>
                            <thead>
                                <tr>
                                    <th>月</th>
                                    <th>火</th>
                                    <th>水</th>
                                    <th>木</th>
                                    <th>金</th>
                                    <th class="sat">土</th>
                                    <th class="sun">日</th>
                                </tr>
                            </thead>
                        <?php endif ?>
                        <tbody>
                            <tr>
                            <?php for ($i = $first; $i < $firstDayWeek; $i++): ?>
                                <td>&nbsp;</td>
                            <?php endfor; ?>

                            <?php foreach ($period as $day): ?>
                                <?php if ($day->format('w') == $first || $day->format('N') == $first): ?>
                                    <tr>
                                <?php endif ?>
                                <?php if ($day->format('w') > $last || $day->format('N') > $last): ?>
                                    </tr>
                                <?php endif ?>
                                <?php if ($today->format('Y-m-d') == $day->format('Y-m-d')): ?>
                                    <td class="today">
                                <?php elseif ($day->format('w') == Weekday::END_SAT || $day->format('N') == Weekday::END_SAT): ?>
                                    <td class="sat">
                                <?php elseif ($day->format('w') == Weekday::START_SUN || $day->format('N') == Weekday::END_SUN): ?>
                                    <td class="sun">
                                <?php else: ?>
                                    <td>
                                <?php endif ?>

                                <?= $day->format('j'); ?>

                                <?php if (isset ($todoData[$day->format('Y-m-d')])): ?>
                                    <?php foreach ($todoData[$day->format('Y-m-d')] as $todo): ?>
                                        <br><?= $todo['title'] ?>
                                    <?php endforeach; ?>
                                <?php endif ?>

                                </td>
                            <?php endforeach; ?>

                            <?php for ($i = $lastDayWeek; $i < $last; $i++): ?>
                                <td>&nbsp;</td>
                            <?php endfor; ?>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="weekdayBox">
                        <div class="left-content">開始曜日切替え：<br></div>
                        <div class="right-content">
                            <a href="?sd=<?= Weekday::START_SUN ?>&ym=<?= $currentDate ?>" class="btn-flat-border"><?php echo '日曜' ?></a>
                            <a href="?sd=<?= Weekday::START_MON ?>&ym=<?= $currentDate ?>" class="btn-flat-border"><?php echo '月曜' ?></a>
                        </div> 
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
