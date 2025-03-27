<?php
declare(strict_types=1);

namespace App\Controller;
use App\Const\Weekday;
use DateTime;
use DateInterval;
use DatePeriod;
use Cake\ORM\TableRegistry;

/**
 * Calenders Controller
 *
 */
class CalendersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $today = new DateTime();
        $currentDate =  $this->getRequest()->getQuery('ym', $today->format('Y-m-d'));
        $selectDayWeek = $this->getRequest()->getQuery('sd');

        $loginId = $this->getRequest()->getSession()->read('Auth.id');
        $UsersTable = $this->fetchTable('Users')->find()->where(['id' => $loginId])->first();
        $userSettingWeekday = $UsersTable->first_day_week;

        if (!isset($selectDayWeek)) {
            $selectDayWeek = $userSettingWeekday;
        }

        $startDay = new DateTime('first day of' . $currentDate);
        $lastDay = new DateTime('last day of' . $currentDate);

        $prev = (clone $startDay)->modify('-1 month');
        $next = (clone $startDay)->modify('+1 month');

        if ($selectDayWeek == Weekday::START_SUN) {
            $firstDayWeek = $startDay->format('w');
            $lastDayWeek = $lastDay->format('w');
            $first = Weekday::START_DAY_WEEK_SUN['first'];
            $last = Weekday::START_DAY_WEEK_SUN['last'];

        } else {
            $firstDayWeek = $startDay->format('N');
            $lastDayWeek = $lastDay->format('N');
            $first = Weekday::START_DAY_WEEK_MON['first'];
            $last = Weekday::START_DAY_WEEK_MON['last'];
        }

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($startDay, $interval, $lastDay, DatePeriod::INCLUDE_END_DATE);

        $loginId = $this->getRequest()->getSession()->read('Auth.id');
        $todosTable = $this->fetchTable('Todos')->find()->where(['user_id' => $loginId])->all();

        $todoData = [];

        foreach ($todosTable as $todo) {
            $deadline = $todo->deadline->format('Y-m-d');
            $todoData[$deadline][] = $todo;
        }

        $this->set(compact('today', 'startDay', 'firstDayWeek', 'lastDayWeek', 'first', 'last', 'prev' ,'next' ,'period' ,'todoData' ,'selectDayWeek' ,'currentDate'));

    }

    /**
     * logout method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful logout.
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

}
