<?php
// src/Model/Table/MessagesTable.php

namespace App\Model\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class MessagesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        // $this->hasMany('Reviews', [
        //     'className' => 'Reviews',
        //     'foreignKey' => 'book_id'
        // ]);
    }
	public function validationDefault(Validator $validator)
    {
        return $validator;
    }
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }
}