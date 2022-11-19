<?php
// src/Model/Table/CommentsTable.php

namespace App\Model\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class ReviewsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
 
        $this->belongsTo('Books', [
          'foreignKey' => 'book_id',
        ]);
		    $this->belongsTo('Users', [
        'foreignKey' => 'user_id',
        ]);
    }
	public function validationDefault(Validator $validator)
    {
        //$validator->notEmpty('body');
        return $validator;
    }
    public function buildRules(RulesChecker $rules)
    {

   // $rules->add($rules->isUnique(['paper_id','reviewer_id']));

  
    return $rules;
    }
}