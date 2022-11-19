<!-- File: src/Template/Books/add.ctp -->
<style>
body{
       background-color:#63B9D6;
    }

#cover_frame{
    font-family:'PT Sans Narrow', sans-serif;
    background-color: #757575;
    width:250px;
    padding:30px;
    border-radius:3px;   
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

#cover{
    background-color: white;
    opacity: 1;
    margin-bottom: 30px;
    border: 1px solid #A6A6A6;
    border-radius: 3px;
    text-align: center;
    text-transform: uppercase;

    font-size:16px;
    font-weight:bold;
    color:#7f858a;
}


#cover_frame ul{
    list-style:none;
    margin:0 -30px;
    border-top:1px solid #2b2e31;
    border-bottom:1px solid #3d4043;
}


</style>

<h1 style="color:white">Add Book</h1>


 <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                 <div class="row">
                        <div class="col-sm-5." >
                            
                            
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>New Book</h3>
                                        <p>Enter new book information and upload a book cover</p>
                                    </div>
                                    <div class="form-top-right">
                                 <?php echo $this->Html->image('book2.png', array('alt' => 'book','width'=>'100;')); ?> 
                                    </div>
                                </div>
                                <div class="form-bottom">
                                   
                                     <?= $this->Form->create($book, ['type' => 'file']); ?>   
                                            <?= $this->Form->input('title',array('id'=>'a','label'=>'','placeholder'=>'Book title...','class'=>'form-username form-control','style'=>'color:black;font-size:18px;font-weight:500;')) ?>
                                            <?= $this->Form->input('author',array('id'=>'a','label'=>'','placeholder'=>'Author...','class'=>'form-username form-control','style'=>'color:black;font-size:18px;font-weight:500;')) ?>
                                            <?= $this->Form->input('description',array('id'=>'a','label'=>'','placeholder'=>'Description... ','class'=>'form-username form-control','style'=>'color:black;font-size:18px;font-weight:500;')) ?>

                                            <?= $this->Form->input('isbn',array('id'=>'a','label'=>'','placeholder'=>'ISBN... ','class'=>'form-username form-control','style'=>'color:black;font-size:18px;font-weight:500;')) ?>
                                            <p></p>
                                              <label style='color:white; font-weight: 500'>Publishing date</label>
                                            <?= $this->Form->input('pub_date',array('id'=>'a','label'=>'','placeholder'=>'Publishing date ','class'=>'form-username form-control','minYear' => 1000,'maxYear' => date('Y'))) ?>
                                            <p></p> 
                                            <label style='color:white; font-weight: 500'>Book cover</label>
                                             <?=$this->Form->file('file') ?>
                                            
                                        <p></p>
                                      <?= $this->Form->button(__('Save Book'),array('id'=>'login_button','class'=>'btn')); ?>

                                   
                                    
                                        
                                       <?= $this->Form->end(); ?>
                                </div>
                           
                        
                            
                            
                        </div>
                        
             
                            
                       
                    </div>
                    
                </div>
            </div>
            
        </div>