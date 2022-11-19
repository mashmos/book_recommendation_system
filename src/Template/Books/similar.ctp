<style>

#cover_frame{
    font-family:'PT Sans Narrow', sans-serif;
    background-color: #5094AB;
    width:330px;
    padding:50px;
    border-radius:3px;   
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
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
}
#book_cover:hover{
    margin-right:142px;
    transform:scale(2) 

  }
</style>


<?php 
if(!isset($similar_books)){
  ?>
<div id="cover_frame" style=" margin-left: auto;
    margin-right: auto;">
            <div id="cover">
               <?php if ($book->cover)
            echo $this->Html->image($book->cover,['height'=>'300','width'=>'230','id'=>'cover_image']);
        else 
            echo $this->Html->image('/webroot/files/default-book.png',['height'=>'200','width'=>'150','id'=>'cover_image']);?>
            </div>


<div style="color:white">
<h4>Publication Year: <?=$book->pub_date->format('Y')?></h4>
<h4>ISBN: <?= $this->Html->link($book->isbn,"http://www.isbnsearch.org/isbn/".$book->isbn); ?></h4>
</div>
</div>


<?php
    echo '<h1 style="color:white;">No book is similar</h1>';

}
 else{
?>
<h1><?php echo $book->title;?></h1>




<!-- <p></p> -->


<div id="cover_frame" style=" margin-left: auto;
    margin-right: auto;">
            <div id="cover">
               <?php if ($book->cover)
            echo $this->Html->image($book->cover,['height'=>'300','width'=>'230','id'=>'cover_image']);
        else 
            echo $this->Html->image('/webroot/files/default-book.png',['height'=>'200','width'=>'150','id'=>'cover_image']);?>
            </div>


<div style="color:white">
<h4>Publication Year: <?=$book->pub_date->format('Y')?></h4>
<h4>ISBN: <?= $this->Html->link($book->isbn,"http://www.isbnsearch.org/isbn/".$book->isbn); ?></h4>
</div>
</div>

 
<h1 style="color:white;">Similar Books</h1>




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
        <th>Similarity</th>
       	 
    <!-- Here is where we iterate through our $papers query object, printing out paper info -->

    <?php  foreach ($similar_books as $similar_book):?>
    <tr>
    <td style="padding:0px;margin-left:20px">
        <?php if ($similar_book->cover)
            echo $this->Html->image($similar_book->cover,['id'=>'book_cover', 'height'=>'140','width'=>'110','url' => [ 'action' => 'view', $similar_book->id]]);
        else 
            echo $this->Html->image('/webroot/files/default-book.png',['height'=>'100','width'=>'75']);
        ?>
    </td>
        <td>
            <?php 
             echo  $this->Html->link($similar_book->title, ['action' => 'view', $similar_book->id]); 
           ?>

        </td>
        
		<td> <?=   $similar_book->author;  ?> </td>
        <!--<td> <?php echo   $book->description; ?> </td>-->
        <td> <?php echo   $similar_book->pub_date->format('Y'); ?> </td>
		<td>
            <?php echo $this->Html->link($similar_book->isbn,"http://www.isbnsearch.org/isbn/".$similar_book->isbn); ?>
        </td>
        <td>
            <?php 
            
            $prcntg=round($scores[$similar_book->id]*100);
            $sim='none';
            $color='grey';
            if($prcntg>=66){
                $sim='High';
                 $color='green';
            }
             else if($prcntg>=33){
                 $sim='Average';
                  $color='yellow';
            }
             else if($prcntg<33){
                 $sim='Low';
                $color='red';
            }
            echo $sim;
            echo '<div><div id="myProgress" 
                            style="position: relative;
                            width: 100%;
                            height: 10px;
                            background-color: #bbb;
                            ">
                <div id="myBar" 
                            style="position: absolute;
                            width: '.round($scores[$similar_book->id]*100).'%;
                            height: 100%;
                            background-color: '.$color.';
                            text-align: center;
                            line-height: 30px;
                            color: white;">
               </div>
            </div>';
             echo $this->Html->link('Why', ['action' => 'why',$book->id,$similar_book->id ]);
            ?>
        </td>
		
    </tr>
    <?php  endforeach; ?>
</table>
<?php } ?>

<script>

document.getElementById("home").style.cssText = "background: #1F8ABF";

</script>
