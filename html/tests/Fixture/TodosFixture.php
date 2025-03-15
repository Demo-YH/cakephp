<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TodosFixture
 */
class TodosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'detail' => 'Lorem ipsum dolor sit amet',
                'tag' => 'Lorem ipsum dolor sit amet',
                'deadline' => '2025-03-15',
                'created' => '2025-03-15 07:00:24',
                'modified' => '2025-03-15 07:00:24',
            ],
        ];
        parent::init();
    }
}
