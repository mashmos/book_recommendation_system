<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class UsersTable extends Table
{


 public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->hasMany('Reviews', [
            'className' => 'Reviews',
            'foreignKey' => 'user_id'
        ]);
        
    }
    public function validationDefault(Validator $validator)
    {
        return $validator
          ->notEmpty('fname', 'First name is required')
            ->notEmpty('lname', 'Last Name is required')
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('password2', 'A password is required')
            ->notEmpty('email', 'An email is required');
          // ->notEmpty('org', 'An organiazation is required')
           // ->notEmpty('field', 'A field is required');    
    }
    public function buildRules(RulesChecker $rules)
    {

    $rules->add($rules->isUnique(['username']));
    $rules->add($rules->isUnique(['email']));


    return $rules;
}


}