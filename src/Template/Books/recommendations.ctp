<style>
body{
            background-color:#63B9D6;
        }

@import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

body {
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}

.table-title h3 {
   color: #fafafa;
   font-size: 30px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}


/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  /*background:#424242;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;*/
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  /*background:#424242; */
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
  }

#book_cover{
    transition: 0.5s;
position:relative;
}
#book_cover:hover{
    margin-right:204px;
    transform:scale(2.0) translate(19px,0px);

z-index: 4;

}
</style>
<script>
document.getElementById("recommended_books").style = "background:#0F6785";
</script>
<?php 
if(!isset($books))
   echo '<h1 style="color:white;">No book is recommended</h1>'; 
else{
?>
<h1 style="color:white">Books that may intrest you</h1>

<br/>

<table>
   

    <tr>
        <th>Cover</th>
        <th>Title</th>
         <!-- <th>Rating</th> -->
     <th>Author</th>
        <!-- <th>Description</th>-->
         <th>Publication</th>
        <th>ISBN</th>
        <th>Predicted Rating</th>
         
    </tr>

    <?php

    foreach ($ranking as $key => $value){
     ?>
    <?php  foreach ($books as $book){
      if($key == $book->id){
      ?>
    <tr>
    <td style="padding:0px;margin-left:20px">
        <?php if ($book->cover)
 echo $this->Html->image($book->cover,['id'=>'book_cover','height'=>'140','width'=>'110','url' => [ 'action' => 'view', $book->id]]);        
 else 
            echo $this->Html->image('/webroot/files/default-book.png',['height'=>'100','width'=>'75']);
        ?>
    </td>
        <td>
            <?php 
             echo  $this->Html->link($book->title, ['action' => 'view', $book->id]); 
           ?>

        </td>
        
    <td> <?=   $book->author;  ?> </td>
        <!--<td> <?php echo   $book->description; ?> </td>-->
        <td> <?php echo   $book->pub_date->format('Y'); ?> </td>
    <td>
            <?php echo $this->Html->link($book->isbn,"http://www.isbnsearch.org/isbn/".$book->isbn); ?>
        </td>
        <td style="text-align:center;font-size:21px;font-weight:400;">
            <?php echo round($ranking[$book->id],2); ?>
        </td>
    
    </tr>
 <?php 

  }
  } 
 } 
}?>
</table>
  
<script>

document.getElementById("home").style.cssText = "background: #1F8ABF";

</script>