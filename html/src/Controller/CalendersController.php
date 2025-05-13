<?php
declare(strict_types=1);

namespace App\Controller;
use App\Constants\Weekday;
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
        $selectDayWeek = $this->getRequest()->getQuery('sd');

        if (!isset($ym)) {
            $ym = $this->getRequest()->getQuery('ym', $today->format('Y-m-d'));
        }

        $currentDate = new DateTime($ym . '-01');

        $loginId = $this->getRequest()->getSession()->read('Auth.id');
        $UsersTable = $this->fetchTable('Users')->find()->where(['id' => $loginId])->first();

        if (!isset($selectDayWeek)) {
            $selectDayWeek = $UsersTable->first_day_week;
        }

        $firstDay = new DateTime('first day of' . $currentDate->format('Y-m-d'));
        $lastDay = new DateTime('last day of' . $currentDate->format('Y-m-d'));

        $prev = (clone $firstDay)->modify('-1 month');
        $next = (clone $firstDay)->modify('+1 month');

        $weekdays = Weekday::DAY_WEEK_ISO_LIST;
        $weekRange = Weekday::START_END_WEEKS[Weekday::ISO_MON];
        $first = $weekRange['first'];
        $last = $weekRange['last'];

        if ($selectDayWeek == Weekday::SUN) {
            $weekdays = Weekday::DAY_WEEK_LIST;
            $weekRange = Weekday::START_END_WEEKS[Weekday::SUN];
            $first = $weekRange['first'];
            $last = $weekRange['last'];
        }

        $period = $this->generateCalendar($firstDay, $lastDay, (string)$selectDayWeek);

        $loginId = $this->getRequest()->getSession()->read('Auth.id');
        $todosTable = $this->fetchTable('Todos')->find()->where(['user_id' => $loginId])->all();

        $todoData = [];

        foreach ($todosTable as $todo) {
            $deadline = $todo->deadline->format('Y-m-d');
            $todoData[$deadline][] = $todo;
        }

        $this->set(compact('ym', 'today', 'weekdays', 'firstDay', 'first', 'last', 'prev' ,'next' ,'period' ,'todoData' ,'selectDayWeek' ,'currentDate'));

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

    /**
     * カレンダー表示期間を生成する
     *
     * @param Datetime $firstDate
     * @param DateTime $lastDate
     * @param string $selectDayWeek
     * @return DatePeriod
     */
    private function generateCalendar(Datetime $firstDate, DateTime $lastDate, string $selectDayWeek): DatePeriod
    {
        $firstDateClone = clone $firstDate;
        $lastDateClone = clone $lastDate;

        $firstInterval = $firstDateClone->format('w');
        if ($selectDayWeek == Weekday::ISO_MON && $firstDateClone->format('N') != Weekday::ISO_MON) {
            $firstInterval = $firstDateClone->format('N') - Weekday::ISO_MON;
        }

        $firstDateClone->sub(new DateInterval('P' . $firstInterval . 'D'));

        $lastInterval = Weekday::SAT - $lastDateClone->format('w');
        if ($selectDayWeek == Weekday::ISO_MON && $lastDateClone->format('N') != Weekday::ISO_SUN) {
            $lastInterval = Weekday::ISO_SUN - $lastDateClone->format('N');
        }

        if ($selectDayWeek == Weekday::ISO_MON && $lastDateClone->format('N') == Weekday::ISO_SUN) {
            $lastInterval = $lastDateClone->format('N') - 7;
        }

        $lastDateClone->add(new DateInterval('P' . $lastInterval . 'D'));
        $interval = new DateInterval('P1D');

        return new DatePeriod($firstDateClone, $interval, $lastDateClone, DatePeriod::INCLUDE_END_DATE);
    }

}
