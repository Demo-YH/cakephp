<?php
declare(strict_types=1);

namespace App\Controller;
use App\Const\Weekday;
use Cake\ORM\TableRegistry;

/**
 * Settings Controller
 *
 */
class SettingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $weekdayList = Weekday::START_DAY_WEEK_LIST;

        $loginId = $this->getRequest()->getSession()->read('Auth.id');
        $UsersTable = $this->fetchTable('Users')->find()->where(['id' => $loginId])->first();
        $userSettingWeekday = $UsersTable->first_day_week;

        if (!isset($newSelectDayWeek)) {
            $newSelectDayWeek = $userSettingWeekday;
        }

        $newSelectDayWeek = $this->request->getData('週の始まり選択'); 
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($UsersTable) { // $UsersTable が null でないことを確認
                $UsersTable->first_day_week = $newSelectDayWeek; // ユーザーエンティティのプロパティを更新
                if ($this->fetchTable('Users')->save($UsersTable)) { // $UsersTable を保存
                    $this->Flash->success(__('The setting has been saved.'));
                } else {
                    // 保存エラーの処理
                    $errors = $UsersTable->getErrors();
                    $this->Flash->error(__('The setting could not be saved. Please, try again.'));
                }
            }
        }

        $this->set(compact('weekdayList', 'userSettingWeekday', 'newSelectDayWeek'));

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
