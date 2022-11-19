<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    // public function index()
    // {
    //     $this->set('users', $this->paginate($this->Users));
    //     $this->set('_serialize', ['users']);
    // }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {

                $this->Flash->success(__('Your Registeration Was Successful.'));
                return $this->redirect(['controller'=>'Users','action' => 'login']);
            } else {
                $this->Flash->error(__('Registeration Was Unsuccessful, Please Try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));


        if ($this->request->is(['patch', 'post', 'put'])) {
           
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Profile updated.'));
                return $this->redirect(['controller'=>'Users','action' => 'profile']);
            } else {
                $this->Flash->error(__('Profile was not updataed. Please try again.'));
            }
        }



        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $user = $this->Users->get($id);
    //     if ($this->Users->delete($user)) {
    //         $this->Flash->success(__('The user has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    //     }
    //     return $this->redirect(['action' => 'index']);
    // }
	public function beforeFilter(Event $event)
	{
    parent::beforeFilter($event);
    // Allow users to register and logout.
    // You should not add the "login" action to allow list. Doing so would
    // cause problems with normal functioning of AuthComponent.
    //$this->Auth->allow(['add', 'logout']);
	}

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

    // public function signup()
    // {
        
    //     return $this->redirect(['controller'=>'Users','action' => 'add']);
          
    // }

    public function profile()
    {
        $user=$this->Auth->User();
        $this->set('user', $user);    
    }

    public function user($userid = null){
        $this->loadModel('Users');
        $user = $this->Users->find('all',[ 'conditions' => ['Users.id' => $userid]]);
        $this->set('user',$user);

    }

    public function messages(){
        
        
    }

	public function logout()
	{  
        $this->Auth->logout();
		return $this->redirect(['action' => 'login']);
		
	}
    public function similar(){
        $this->loadModel('Reviews');
        $scores=array();
        $reviews=$this->Reviews->find('all')->distinct(['user_id']);
        foreach ($reviews as $review)
             $reviewers_ids[]=$review->user_id;        
        $others=$this->Users->find('all',['conditions' => ['Users.id IN' => $reviewers_ids,'Users.id !=' => $this->Auth->user('id')]]);
        
        foreach($others as $other){
            $score=$this->getCorrelation($this->Auth->user('id'),$other->id);
            if($score>0)
                $scores[$other->id]=$score;
            }
        arsort($scores);
        $similar_ids=array_keys($scores);
        $a=strval(implode('","',$similar_ids));

        if(!empty($similar_ids)){
        $similar_users=$this->Users->find('all',['conditions' => ['Users.id IN' => $similar_ids], 'order' => array('FIELD(Users.id, "'.$a.'")')]);


        $this->set('similar_users', $similar_users);  
        }  
        $this->set('user', $this->Auth->user('id'));  
        
        $this->set('scores', $scores);    

    }
     public function why($userId1,$userId2)
    {
        $this->loadModel('Reviews');
        $this->loadModel('Books');
        $user1_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $userId1)));
        $user2_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $userId2)));
        $reviews=array();
        $reviews[0]=[['','']];
        $i=1;
        foreach($user1_revs as $user1_rev)
            foreach($user2_revs as $user2_rev)
                if($user1_rev->book_id==$user2_rev->book_id){
                    $reviews[$i]=[$this->Books->get($user1_rev->book_id)->title,$user1_rev->rating,$user2_rev->rating];
                    $i++;
                }
        $this->set('count',count($reviews));
        $this->set('reviews',$reviews);
        //debug($reviews);exit;
        $user1 = $this->Users->get($userId1)->lname;
        $user2 = $this->Users->get($userId2)->lname;
        $this->set('user1',$user1);
        $this->set('user2',$user2);
            
    }

}
    
