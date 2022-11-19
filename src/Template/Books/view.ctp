<!-- File: src/Template/Books/add.ctp -->
<style>
body{
       background-color:#89D0E8;
    }

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

#comment_frame{
    font-family:'PT Sans Narrow', sans-serif;
    background-color: #507F99;
    width:700px;
    padding:50px;
    border-radius:3px;   
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
    margin:0 auto;
}

#title{
    background-color: white;
    opacity: 1;
    margin-bottom: 30px;
    border: 1px solid #A6A6A6;
    border-radius: 3px;
    text-align: center;

    font-size:16px;
    font-weight:bold;
    color:#7f858a;
}

</style>

<style>

#comment_frame1{
    font-family:'PT Sans Narrow', sans-serif;
    background-color: #5094AB;
    width:700px;
    padding:5px;
    border-radius:3px;   
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
    margin:0 auto;
}

#title1{
    
    opacity: 1;
    margin-bottom: -30px;
    border-radius: 3px;
    text-align: center;
    font-size:16px;
    color:#7f858a;
}

</style>
<style>

div.stars {
  width: 180px;
  float:left;
  display: inline-block;
  
  
}



input.star { display: none; }

label.star {
  float: right;
  padding: 1px;
  font-size: 30px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FD4;
  text-shadow: 0 0 20px #C4B700;
}
input.star-5:checked ~ label.star:before {
  color: ;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>

<style>

div.stars1 {
  width: 180px;
  float:left;
  display: inline-block;
  
  
}



input.star1 { display: none; }

label.star1 {
  float: right;
  padding: 1px;
  font-size: 30px;
  color: #444;
  transition: all .2s;
}

input.star1:checked ~ label.star1:before {
  content: '\f005';

  transition: all .25s;
}



label.star1:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>



<style>

/*#cover_image{
    transition: 0.5s;
}
#cover_image:hover{
    margin-right:124px;
    transform:scale(2);
}*/

</style>
<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #222B2E;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '>>';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
.button:hover{
    background:#38474D;
    color:white;
}

#comments tr{
 border:1px solid gray;

}

</style>








<div style="overflow-x:auto;">
<table style="color:white;">



<tr >
<td >  
<div id="cover_frame" >
            <div id="cover">
               <?php if ($book->cover)
            echo $this->Html->image($book->cover,['height'=>'300','width'=>'230','id'=>'cover_image']);
        else 
            echo $this->Html->image('/webroot/files/default-book.png',['height'=>'200','width'=>'150']);?>
            </div>

<script>
function enlarge(){

  document.getElementById("cover_image").style = "transform:scale(2);";
}
</script>





<div style="color:white">

<h3 style="color:white"><?php echo $book->title;?></h3>
<h4 style="color:white">By <?=$book->author?></h4>
<?php

$reviewers_num = 0;
$sum = 0;
 foreach($reviews as $r){
  
  if(!empty($r->rating))
  $reviewers_num++;
  $sum = $sum + $r->rating;

}

if($reviewers_num > 0)
echo "<p>Average Rating: " . round(($sum/$reviewers_num),2)." / 5" . "</p><p> (". $reviewers_num . " Ratings)</p>";
else
echo "<p>This book has not been rated yet. Be the first!</p>";
?>


</div>

 

<?php echo $this->Form->create($review,array('id' => 'myform'));?>
<div class="stars" >
    <input class="star star-5" id="star-5" type="radio" onchange=myfunction() name="rating" value='5' <?php if($review->rating == 5) echo 'checked'; ?>/>
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" id="star-4" type="radio" onchange=myfunction() name="rating" value='4' <?php if($review->rating == 4) echo 'checked'; ?>/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" id="star-3" type="radio" onchange=myfunction() name="rating" value='3' <?php if($review->rating == 3) echo 'checked'; ?>/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" id="star-2" type="radio" onchange=myfunction() name="rating" value='2' <?php if($review->rating == 2) echo 'checked'; ?>/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" id="star-1" type="radio" onchange=myfunction() name="rating" value='1' <?php if($review->rating == 1) echo 'checked'; ?>/>
    <label class="star star-1" for="star-1"></label>
</div>


<?= $this->Html->link('Find Similar Titles', ['action' => 'similar',$book->id],['class' => 'button']);
?>

<?php

//echo $this->Form->hidden('title',['value'=>'']);
//echo $this->Form->hidden('body',['value'=>'']);
echo $this->Form->hidden('user_id',['value'=>$user_id]);
echo $this->Form->hidden('book_id',['value'=>$book->id]); 
echo $this->Form->end();

?>

<h4>Publication Year: <?=$book->pub_date->format('Y')?></h4>
<h4>ISBN: <?= $this->Html->link($book->isbn,"http://www.isbnsearch.org/isbn/".$book->isbn); ?></h4>
</td>

<td style="padding-left:10px;">
<div


<?php

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))


echo 'style="width:330px"';

?>>






<h2>Description</h2>
<p style="font-size:20px;color:white;font-weight:400;border-radius: 5px;"><?=$book->description ?></p>
</div>
</td>

</tr>

</table>
</div>

<div > 











<table id="comments" style="color:white; font-size:20px;margin:0 auto;text-align:left;"

<?php

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))


echo 'style="width:330px"';

?>      >



<?php

if(!empty($review->rating)){
 // if($review->body ==''){
  echo "<div id='my_review_div' style='display:none;'>";
echo $this->Form->create($review,array('id' => 'myform2')); 
echo '<h2 style="color:white;font-weight:300">Write a review</h2>';
echo  '<div id="comment_frame1" style="margin-top:55px;">
            <div id="title1"><p style="color:white;font-weight:300;">Title</p>'

              .$this->Form->input('title',array('value'=>$review->title,'label'=>'','style'=>'width:500px;height:40px;','id'=>'review_title','onkeyup'=>'disable()'));

  echo          '<br></div>

            <p style="text-align:left;color:white;"><p style="color:white">Review</p>'. $this->Form->input('body',array('value'=>$review->body,'label'=>'', 'style'=>'width:600px;height:150px;','id'=>'review_body','onkeyup'=>'disable()')). "</p>

          </div><br>";
$button_value = 'Post Review';

if($review->body !='')
$button_value = 'Update Review';
echo $this->Form->button(__($button_value),array('style'=>'margin: auto;margin-bottom:55px;margin-right:5px;','class' => 'button','id'=>'post_button'));



echo $this->Form->hidden('user_id',['value'=>$user_id]);
echo $this->Form->hidden('book_id',['value'=>$book->id]); 

echo $this->Form->end();
echo "</div>";
//}
}

else
  echo "<h2 style='color:white;'>You need to rate the book before you can write a review</h2>";
 ?>


<?php



?>

<script>

function empty_review(){
  document.getElementById("review_body").value = "";
  document.getElementById("review_title").value = "";
}


function update_review(){
  document.getElementById("my_review_div").style.display = '';
  document.getElementById("all_my_review").style.display = 'none';

document.getElementById("del_button").disabled = true;
document.getElementById("del_button").style.opacity = 0;

document.getElementById("up_button").disabled = true;
document.getElementById("up_button").style.opacity = 0;

}


</script>


<?php 

echo "<div id='all_my_review'>";

$flag = 0;
foreach($users_reviews as $r){
 
  if($r->body != ""){
    
    $flag = 1;
    echo "<script>document.getElementById('my_review_div').style.display = 'none';</script>";
    if( $r->user_id == $loggedin_id){
      echo "<h2 style='color:white;font-weight:300'>My Review</h2>";
    echo  '<br><div id="comment_frame" style=" background:#68A2BA;">';
      foreach($all_users as $u)
        if($u->id == $r->user_id){
          echo "<p style='width:300px;margin:0 auto;color:white;font-size:22px;background:#90C3D4;border-radius: 3px;box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);border: 1px solid #A6A6A6;'>".$u->fname. " " .$u->lname. "</p>"; 
echo '<p><div class="stars1" >
    <input  class="star1 star-55" id="star-55" type="radio"   '; if($r->rating == 5) echo "checked";echo '/>
    <label class="star1 star-55" for="star-55"></label>
    <input  class="star1 star-44" id="star-44" type="radio" ';   if($r->rating == 4) echo "checked";echo '/>
    <label class="star1 star-44" for="star-44"></label>
    <input  class="star1 star-33" id="star-33" type="radio" ';   if($r->rating == 3) echo "checked";echo '/>
    <label class="star1 star-33" for="star-33"></label>
    <input  class="star1 star-22" id="star-22" type="radio"  ';   if($r->rating == 2) echo "checked";echo '/>
    <label class="star1 star-22" for="star-22"></label>
    <input  class="star1 star-11" id="star-11" type="radio"   ';   if($r->rating == 1) echo "checked";echo '/>
    <label class="star1 star-11" for="star-11"></label>
</div></p><br>';

        }
  echo          '<p><div id="title">'
              .$r->title;

  echo          "</div></p>

            <p style='text-align:left;color:white;'>". $r->body. "</p>
            <table style='margin:0 auto;margin-bottom:50px;'><tr><td><button class='button' onclick='update_review()' id='up_button'>Update</button></td>";

          echo $this->Form->create($review,array('id' => 'delete_form')); 
          echo "<td>".$this->Form->button(__('Delete Review'),array('class' => 'button','id'=>'del_button'))."</td></tr></table>";
 echo $this->Form->hidden('title',['value'=>'']);
echo $this->Form->hidden('body',['value'=>'']); 

echo $this->Form->hidden('user_id',['value'=>$user_id]);
echo $this->Form->hidden('book_id',['value'=>$book->id]); 
echo $this->Form->end();


        echo  "</div>";
        echo  "</div>";
}
  }
  else
    echo "<script>document.getElementById('my_review_div').style.display = '';</script>";

}


?>



<script>
if(document.getElementById("review_body").value == '' || document.getElementById("review_title").value == ''){
document.getElementById("post_button").disabled = true;
document.getElementById("post_button").style.opacity = 0.2;

}
function disable(){
if(document.getElementById("review_body").value == ''|| document.getElementById("review_title").value == ''){
document.getElementById("post_button").disabled = true;
document.getElementById("post_button").style.opacity = 0.2;
}

if(document.getElementById("review_body").value != '' && document.getElementById("review_title").value != ''){
document.getElementById("post_button").disabled = false;
document.getElementById("post_button").style.opacity = 1;
}

} 
</script>


<script>
document.getElementById("star-55").disabled = true;
document.getElementById("star-44").disabled = true;
document.getElementById("star-33").disabled = true;
document.getElementById("star-22").disabled = true;
document.getElementById("star-11").disabled = true;

</script>



<?php 

foreach($users_reviews as $r){
 
  if($r->body != ""){

if($flag == 1){
  $flag = 0;
  echo '<h2 style="color:white;font-weight:300">Reviews</h2>';

}


    
        

    echo  '<div id="comment_frame"'; if( $r->user_id == $loggedin_id) echo 'style="background:#68A2BA;">'; else echo '>';
      foreach($all_users as $u)
        if($u->id == $r->user_id){
          echo "<p style='width:300px;margin:0 auto;color:white;font-size:22px;background:#90C3D4;border-radius: 3px;box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);border: 1px solid #A6A6A6;'>"; echo  $this->Html->link($u->fname. " " .$u->lname, ['controller'=>'Users', 'action' => 'user', $u->id], array('style' =>  'color: white;')); "</p>"; 
echo '<p><div class="stars1" >
    <input  class="star1 star-55" id="star-55" type="radio"   '; if($r->rating == 5) echo "checked";echo '/>
    <label class="star1 star-55" for="star-55"></label>
    <input  class="star1 star-44" id="star-44" type="radio" ';   if($r->rating == 4) echo "checked";echo '/>
    <label class="star1 star-44" for="star-44"></label>
    <input  class="star1 star-33" id="star-33" type="radio" ';   if($r->rating == 3) echo "checked";echo '/>
    <label class="star1 star-33" for="star-33"></label>
    <input  class="star1 star-22" id="star-22" type="radio"  ';   if($r->rating == 2) echo "checked";echo '/>
    <label class="star1 star-22" for="star-22"></label>
    <input  class="star1 star-11" id="star-11" type="radio"   ';   if($r->rating == 1) echo "checked";echo '/>
    <label class="star1 star-11" for="star-11"></label>
</div></p><br>';

        }
  echo          '<p><div id="title" style="">'
              .$r->title;

  echo          '</div></p>

            <p style="text-align:left;color:white;">'. $r->body. "</p>
          </div>";

  }

}

if($flag == 1)
  echo '<h2 style="color:white;font-weight:300">This book has no reviews</h2>';

?>


</table>
</div>



<script>
function myfunction() {
  document.forms["myform"].submit();
}
</script>
 
