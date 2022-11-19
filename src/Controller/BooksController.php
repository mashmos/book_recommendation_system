<?php
// src/Controller/BooksController.php

namespace App\Controller;

use App\Controller\AppController;


class BooksController extends AppController {

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Reviews');
         $this->loadModel('Users');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function add(){
        $book = $this->Books->newEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->data);
            if ($this->Books->save($book)) {

                if ($this->request->data['file']['tmp_name']){
                move_uploaded_file($this->request->data['file']['tmp_name'], WWW_ROOT . 'files' . '/' . $book->id.'-'.$this->request->data['file']['name']);
                $book->cover= ('/'.'webroot'.'/'.'files' . '/' . $book->id.'-'.$this->request->data['file']['name']);
                }
                else{
                     $book->cover= ('/'.'webroot'.'/'.'files' . '/' . 'default-book.png');
                }



                $this->Books->save($book);
                $this->Flash->success(__($book->title.'has been added.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the book.'));
        }
        $this->set('book', $book);
    }

    public function normalizePath($path) {
    
       return str_replace('\\', '/', $path);

    }



    public function index(){

       $this->set('books',$this->Books->find('all',[
       'order' => ['Books.id' => 'DESC']]));

       if(!$this->Auth)
            $this->set('role','guest');
       else
            $this->set('role',$this->Auth->user('role'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The Book  been deleted.'));
            return $this->redirect(['action' => 'index']);
        }
    }

public function search(){
	
	if ($this->request->is(['patch', 'post', 'put'])) {
		$term = '%'.$this->request->data['search_term'].'%';
$books = $this->Books->find('all', array('conditions'=>array('OR'=>array('Books.title LIKE'=>$term,'Books.author LIKE'=>$term))));


$this->set('books',$books);

        }
	
	}

    public function edit($id = null) {  
        $book = $this->Books->get($id);
    

        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->data);
            $book->user_id = $this->Auth->user('id');
            if ($this->Books->save($book)) {
               if(!empty($this->request->data['file']['name'])){
                move_uploaded_file($this->request->data['file']['tmp_name'], WWW_ROOT . 'files' . '/' . $book->id.'-'.$this->request->data['file']['name']);
                $book->cover= ('/'.'webroot'.'/'.'files' . '/' . $book->id.'-'.$this->request->data['file']['name']);
            }
                $this->Books->save($book);
                $this->Flash->success(__('The book has been modified.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to modify the Book.'));
        }
        $this->set('book', $book);
    }

    public function view($id = null)
    {
        $this->loadModel('Users');
        $this->loadModel('Reviews');
        $book=$this->Books->get($id);
        $this->set('book',$book);
        $reviews = $this->Reviews->find('all',[ 'conditions' => ['Reviews.book_id' => $id]]);
        $all_users = $this->Users->find('all',[]);
        $this->set('reviews',$reviews);
        foreach ($reviews as $review){
             $reviewers_ids[]=$review->user_id;
        }
        if(!empty($reviewers_ids)){
        $this->set('reviewers', $this->Users->find()->where(['Users.id IN' => $reviewers_ids])->all());
        }
       
            $review= $this->Reviews->find('all',[ 'conditions' => ['Reviews.user_id' => $this->Auth->user('id'),'Reviews.book_id' => $book->id]])->first();

            

            if($review==null){
            $review = $this->Reviews->newEntity();
            }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->data);
            if ($this->Reviews->save($review)) {

                $this->Reviews->save($review);
                $this->Flash->success(__('Your '.$review->rating." star rating has been submitted"));
                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('Unable to rate the book'));
        }

        $this->set('users_reviews',$reviews);
        $this->set('Book',$book);
         $this->set('review',$review);
        $this->set('user_id', $this->Auth->user('id'));
        $this->set('loggedin_id',$this->Auth->user('id'));
        $this->set('loggedin_user',$this->Auth);
        $this->set('all_users',$all_users);
         //$topMatches=$this->getSimilarUsers($this->Auth->user('id'));
         //$this->getRecommendations($this->Auth->user('id'));
        
    }
  
    public function recommendations(){
        $totals=array();
        $scoreSums=array();

        //find all reviewers ids
        $reviews=$this->Reviews->find('all')->distinct(['user_id']);
        foreach ($reviews as $review)
             $reviewers_ids[]=$review->user_id;  

         //find all reviewers objects except the current user
        $others=$this->Users->find('all',['conditions' => ['Users.id IN' => $reviewers_ids,'Users.id !=' => $this->Auth->user('id')]]);

        //find all already rated books
        $user_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $this->Auth->user('id'))));   
        foreach ($user_revs as $u_rev)
            $rated_ids[]=$u_rev->book_id;

        //iterate through all other users
        foreach($others as $other){
                $score=$this->getCorrelation($this->Auth->user('id'),$other->id);

               //$score=$this->getDistance($this->Auth->user('id'),$other->id);        
            //ignore others with no relation or negative relation to the user
            if($score<=0)
                continue;
            //find all book ids by other that have not been rated by user yet
            $other_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.user_id' => $other->id,'Reviews.book_id NOT IN' => $rated_ids)));   
            foreach ($other_revs as $other_rev){
                if(!isset($totals[$other_rev->book_id])){
                     $totals[$other_rev->book_id]=$other_rev->rating*$score;
                  $scoreSums[$other_rev->book_id]=$score;
                  continue;
                }
                $totals[$other_rev->book_id]= $totals[$other_rev->book_id] + $other_rev->rating*$score;
                $scoreSums[$other_rev->book_id]=$scoreSums[$other_rev->book_id] + $score;
            }
        }
        $ranking=array();
        $books_id=array_keys($totals);

        //
        for($i=0;$i<count($books_id);$i++){
            $ranking[$books_id[$i]]=+$totals[$books_id[$i]]/$scoreSums[$books_id[$i]];
        }   
        arsort($ranking);
        $this->set('ranking', $ranking);
        $a=strval(implode('","',$ranking));
        if(!empty($books_id)){ 
            $books=$this->Books->find('all',['conditions' => ['Books.id IN' => $books_id],'order' => array('FIELD(Books.id, "'.$a.'")')]);



            $this->set('books', $books);


        }


    }
    public function getBookCorrelation($book1Id,$book2Id){
        $book1_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.book_id' => $book1Id)));
        $book2_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.book_id' => $book2Id)));
            
        $n= 0; //mutual reviews
        $sum1 = 0;
        $sum2 = 0;
        $sum1Sq = 0;
        $sum2Sq = 0;
        $pSum = 0;
           
        foreach($book1_revs as $book1_rev){
            foreach($book2_revs as $book2_rev){
                if($book1_rev->user_id==$book2_rev->user_id){
                    $sum1 = $sum1 + $book1_rev->rating;
                    $sum1Sq = $sum1Sq + pow($book1_rev->rating,2);
                    $sum2 = $sum2 + $book2_rev->rating;
                    $sum2Sq = $sum2Sq + pow($book2_rev->rating,2);
                    $pSum= $pSum + ($book1_rev->rating*$book2_rev->rating);
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
    public function similar($bookId){
        $this->loadModel('Reviews');
        $scores=array();
        //getting all reviewed books ids by all the users
        $reviews=$this->Reviews->find('all')->distinct(['book_id']);
        foreach ($reviews as $review)
             $books_ids[]=$review->book_id;

        //getting all book objects except the book itself         
        $books=$this->Books->find('all',['conditions' => ['Books.id IN' => $books_ids,'Books.id !=' => $bookId]]);
        //debug($books->all());exit;
        foreach($books as $book){
            $score=$this->getBookCorrelation($bookId,$book->id);
            if($score>0)
                $scores[$book->id]=$score;
            }
        arsort($scores);
        $similar_ids=array_keys($scores);
        if(!empty($similar_ids)){
            $a=strval(implode('","',$similar_ids));
        $similar_books=$this->Books->find('all',['conditions' => ['Books.id IN' => $similar_ids], 'order' => array('FIELD(Books.id, "'.$a.'")')]);
        $this->set('similar_books', $similar_books);  
        }  
        $this->set('scores', $scores); 
        $book = $this->Books->get($bookId);
        $this->set('book', $book); 

    }
     public function why($bookId1,$bookId2)
    {
        $book1_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.book_id' => $bookId1)));
        $book2_revs = $this->Reviews->find('all',array('conditions' => array('Reviews.book_id' => $bookId2)));
        $reviews=array();
        $reviews[0]=[['','']];
        $i=1;
        foreach($book1_revs as $book1_rev)
            foreach($book2_revs as $book2_rev)
                if($book1_rev->user_id==$book2_rev->user_id){
                //$reviews[$this->Users->get($book1_rev->user_id)->lname]=[$book1_rev->rating,$book2_rev->rating];
                $reviews[$i]=[$this->Users->get($book1_rev->user_id)->fname . ' ' .$this->Users->get($book1_rev->user_id)->lname,$book1_rev->rating,$book2_rev->rating];
                $i++;
               
              }
         $this->set('count',count($reviews));
        $book1 = $this->Books->get($bookId1)->title;
         $book2 = $this->Books->get($bookId2)->title;
        $this->set('reviews',$reviews);
        $this->set('book1',$book1);
        $this->set('book2',$book2);
            
    }

    

  
}