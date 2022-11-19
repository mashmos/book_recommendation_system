

<!---------------------------------------------------------------------------------------------------------->

    <style>
        body{
                background-color:#63B9D6;
            }

         #top_menu{
            display:none;
        }
    </style>
    <?= $this->Form->create($user) ?>
     <?php echo $this->Form->hidden('role',['value'=>'user']); ?> 
    <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign up</h3>
                                        <p>Fill in the form below to create your own profile</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="" method="post" class="registration-form">

                                            
                                            <?php echo $this->Form->input('fname',['label'=>'','class'=>'form-first-name form-control','placeholder'=>'First name...','style'=>'color:black;font-size:18px;font-weight:500;']); ?>
  
                                            <?php  echo $this->Form->input('lname',['label'=>'','class'=>'form-first-name form-control','placeholder'=>'Last name...','style'=>'color:black;font-size:18px;font-weight:500;']);  ?>
              
                                            <?php echo $this->Form->input('about',[ 'label'=>'','class'=>'form-first-name form-control','placeholder'=>'About...','style'=>'color:black;font-size:18px;font-weight:500;']); ?>
                                            <p></p>
                                            <label style='color:white;font-weight:500;font-size:18px;;'>Birth date</label>
                                            <?php  echo $this->Form->input('bdate',['label'=>'','class'=>'form-first-name form-control','placeholder'=>'Birth date...','style'=>'color:black;font-size:18px;font-weight:500;','minYear' => 1900,'maxYear' => date('Y')]);  ?>

                                        
                                            <?php echo $this->Form->input('username',['label'=>'','class'=>'form-first-name form-control','placeholder'=>'Username...','style'=>'color:black;font-size:18px;font-weight:500;']);  ?>
                                        
         
                                            <?php echo $this->Form->input('password',['label'=>'', 'value'=>'','id'=>'p1','onkeyup'=>'val()','class'=>'form-first-name form-control','placeholder'=>'Password...','style'=>'color:black;font-size:18px;font-weight:500;']);  ?>
                  
                                           
                                            <?php echo $this->Form->input('password2',['label'=>'', 'value'=>'','id'=>'p2','onkeyup'=>'val()','class'=>'form-first-name form-control','placeholder'=>'Repeat password...','style'=>'color:black;font-size:18px;font-weight:500;']);  ?>

                                          <?php
                    echo "<p id='message' style='color:white;font-size:15px;'></p>";
        ?>


                                            <?php echo $this->Form->input('email',['label'=>'','class'=>'form-first-name form-control','placeholder'=>'E-mail...','style'=>'color:black;font-size:18px;font-weight:500;']); ?>
                                            <p></p>
                                        <?= $this->Form->button(__('Sign Up'),['id'=>'btn','class'=>'btn','style'=>'margin-top:15px;']) ?>
                                    </form>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>











<!---------------------------------------------------------------------------------------------------------->



<script>


      function val(){
            p1 = document.getElementById("p1");
            p2 = document.getElementById("p2");

         

             if(p1.value !== p2.value){
                document.getElementById("message").innerHTML = "Passwords do not match";
                document.getElementById("btn").disabled = true;
            }
           else{
                document.getElementById("message").innerHTML = "";
                document.getElementById("btn").disabled = false;
            }
        
    }


</script>
