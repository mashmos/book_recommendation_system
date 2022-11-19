<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Booki Recommender 1.0';
?>
<!DOCTYPE html> 
<html>
<head>
    <?= "";//$this->Html->css('styles.css') ?>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
    color:white;
}

.active {
    background-color: #0F6785;
}



#logout{
  background-color:#9E0000;
  color:white;
}

</style>
<style>
/* Remove margins and padding from the list, and add a black background color */
ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

/* Float the list items side by side */
ul.topnav li {float: left;}

/* Style the links inside the list items */
ul.topnav li a {
    display: inline-block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.topnav li a:hover {background-color: #111;}

/* Hide the list item that contains the link that should open and close the topnav on small screens */
ul.topnav li.icon {display: none;}


/* When the screen is less than 680 pixels wide, hide all list items, except for the first one ("Home"). Show the list item that contains the link to open and close the topnav (li.icon) */
@media screen and (max-width:680px) {
  ul.topnav li:not(:first-child) {display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
}

/* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens */
@media screen and (max-width:680px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
  }

  
}
@media screen and (min-width:800px) {
#logout{
float:right;
margin-right:100px;

  }

#recent_books{
margin-left:100px;
}
}

</style>
<style>



</style>
<script>
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");

}
</script>



    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
       
    </title>
    <?= $this->Html->meta('icon'); ?>

<!--///////////////////////////////// -->
  
 

<!--Login & Signup -->
<?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Roboto:400,100,300,500');?>
<?php echo $this->Html->css('assets/bootstrap/css/bootstrap.min.css');?>
<?php echo $this->Html->css('assets/font-awesome/css/font-awesome.min.css');?>
<?php echo $this->Html->css('assets/css/form-elements.css');?>
<?php echo $this->Html->css('assets/css/style.css');?>

<?php echo $this->Html->script('assets/js/jquery-1.11.1.min.js');?>
<?php echo $this->Html->script('assets/bootstrap/js/bootstrap.min.js');?>
<?php echo $this->Html->script('assets/js/jquery.backstretch.min.js');?>
<?php echo $this->Html->script('assets/js/scripts.js');?>

<!--Top menue -->
<?php ;//echo $this->Html->css('menu.css');?>

<!-------------------------------->




 
<!-------------------------------->
<?php if($this->request->session()->read('Auth.User.id')!=null) { ?>
</head>
<div id="top_menu">
<ul class="topnav">
  <li id="recent_books"><?php  echo $this->Html->link(__('Home'), ['controller'=>'Books','action' => 'index']) ; ?></li>
  <li id="recommended_books"><?php    echo $this->Html->link(__('Recommended Books'), ['controller'=>'Books','action' => 'recommendations']) ;?></li>
  <li id="similar_readers"><?php    echo $this->Html->link(__('Similar Readers'), ['controller'=>'Users','action' => 'similar']) ;?></li>
  <li id="messages"><?php    echo $this->Html->link(__('Messages'), ['controller'=>'Messages','action' => 'inbox']) ; ?>
  </li>
  <li id="profile"><?php    echo $this->Html->link(__('Profile'), ['controller'=>'Users','action' => 'profile']) ; ?></li>
  <li style="background:#9E0000" id="logout"><?php  echo $this->Html->link(__('Logout'), ['controller'=>'Users','action' => 'logout']);?></li>
<li class="icon">
    <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  </li>
</ul>
</div>
<?php   }
        else{
            //echo logo
        }
        ?>


<!-------------------------------->

<!--<div id='cssmenu'>
<ul>
   <li><a href='#'>Home</a></li>
   <li ><a href='#'>Books</a></li>
      <ul >
         <li class='has-subd'><a href='#'>Latest</a>
         </li>
         <li class='has-sub' ><a href='#'>All</a>
            <ul>
               <li><a href='#'>By Friends</a></li>
               <li><a href='#'>By History</a></li>
            </ul>
      </ul>
   </li>
   <li><a href='#'>Friends</a></li>
   <li ><a href='#'>About</a></li>
   <li><a href='#'>Contact Us</a></li>
</ul>
</div>-->



<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
   
       
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer style="margin-top:80px;">
      <!--<div style="background-color:#048EBD; padding: 0.03em;">-->
      
    </div>
    
<p>Powered by <b>Monty</b> Recommender System</p>
<p>ICS411 - 152.</p>
 
  </footer>
</body>
</html>




