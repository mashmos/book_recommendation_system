<?php
// src/Controller/MessagesController.php

namespace App\Controller;

use App\Controller\AppController;


class MessagesController extends AppController {

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Reviews');
         $this->loadModel('Users');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

   


    public function index(){

    }

    public function inbox(){
        $this->loadModel('Users');
        $to_user=$this->Auth->User();
        

        $inbox_messages = $this->Messages->find('all',[ 'conditions' => ['Messages.to_id' => $to_user['id']],  'order' => "id DESC"]);

       

        $users = $this->Users->find('all');
        $this->set('inbox_messages',$inbox_messages);
        $this->set('users',$users);
        $this->set('to_user',$to_user);
    }

    public function outbox(){
        $this->loadModel('Users');
        $current_user=$this->Auth->User();
        

        $outbox_messages = $this->Messages->find('all',[ 'conditions' => ['Messages.from_id' => $current_user['id']],  'order' => "id DESC"]);


        $users = $this->Users->find('all');

   



        $this->set('outbox_messages',$outbox_messages);
        $this->set('users',$users);
        $this->set('current_user',$current_user);

       
    }

     public function send($to_id = null){

        $this->loadModel('Users');
        $from_user=$this->Auth->User();

        $to_user = $this->Users->find('all',[ 'conditions' => ['Users.id' => $to_id]]);

        $message = $this->Messages->newEntity();

        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {


                $this->Messages->save($message);
                $this->Flash->success(__('Message '.'has been sent.'));
                return $this->redirect(['action' => 'outbox']);
            }
            $this->Flash->error(__('Unable to send the message.'));
        }
        foreach($to_user as $to)
            $to_name = $to->fname .' '. $to->lname;
        $this->set('to_id',$to_id);
        $this->set('from_id',$from_user['id']);
        $this->set('to_name',$to_name);
    }

  
}