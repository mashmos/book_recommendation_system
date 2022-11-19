<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initializatxion code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();	
		$this->loadComponent('Flash');
        $this->loadComponent('Auth', [
			'authorize' => ['Controller'], // Added this line
            'loginRedirect' => [
                'controller' => 'Books',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
        ]);
    }
	 public function beforeFilter(Event $event)
    {
      $this->Auth->allow([ 'display','login','add']);
    }
	public function isAuthorized($user)
{
    // Admin can access every action
    if (isset($user)) {
        return true;
    }

    // Default deny
    return false;
}
   
   public function getCorrelation($person1Id,$person2Id){
        $user1_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $person1Id)));
        $user2_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $person2Id)));
            
        $n= 0; //mutual reviews
        $sum1 = 0;
        $sum2 = 0;
        $sum1Sq = 0;
        $sum2Sq = 0;
        $pSum = 0;
           
        foreach($user1_revs as $u1_rev){
            foreach($user2_revs as $u2_rev){
                if($u1_rev->book_id==$u2_rev->book_id){
                    $sum1 = $sum1 + $u1_rev->rating;
                    $sum1Sq = $sum1Sq + pow($u1_rev->rating,2);
                    $sum2 = $sum2 + $u2_rev->rating;
                    $sum2Sq = $sum2Sq + pow($u2_rev->rating,2);
                    $pSum= $pSum + ($u1_rev->rating*$u2_rev->rating);
                    $n++;
                }
            }
        }

        if($n==0)
            return 0; //no similarity
        else{
            $num=$pSum-(($sum1*$sum2)/$n);
            $den=sqrt(($sum1Sq-pow($sum1,2)/$n)*($sum2Sq-pow($sum2,2)/$n));
            if ($den==0) 
                return 0;
            else 
                return $num/$den;
        }
    }
     public function getDistance($person1Id,$person2Id){
        $user1_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $person1Id)));
        $user2_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $person2Id)));

        $n= 0; //mutual reviews
        $sumSq = 0;
        foreach($user1_revs as $u1_rev){
            foreach($user2_revs as $u2_rev){
                if($u1_rev->book_id==$u2_rev->book_id){
                    $n++;
                    $sumSq = $sumSq + pow($u1_rev->rating-$u2_rev->rating,2);
                }
            }
        }
        if($n==0)
            return 0;
        else
            return 1/(1+$sumSq);
    }
 

    

}
