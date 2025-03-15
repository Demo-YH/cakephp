<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Todos Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Todo newEmptyEntity()
 * @method \App\Model\Entity\Todo newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Todo> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Todo get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Todo findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Todo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Todo> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Todo|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Todo saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Todo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Todo>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Todo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Todo> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Todo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Todo>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Todo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Todo> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TodosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('todos');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('detail')
            ->maxLength('detail', 255)
            ->requirePresence('detail', 'create')
            ->notEmptyString('detail');

        $validator
            ->scalar('tag')
            ->maxLength('tag', 255)
            ->requirePresence('tag', 'create')
            ->notEmptyString('tag');

        $validator
            ->date('deadline')
            ->requirePresence('deadline', 'create')
            ->notEmptyDate('deadline');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
