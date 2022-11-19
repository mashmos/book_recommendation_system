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

</style>

<script>
document.getElementById("similar_readers").style = "background:#0F6785";
</script>
<?php 
if(!isset($similar_users))
   echo '<h1 style="color:white">No reader is similar to you!</h1>'; 
else{
?>
<h1 style="color:white">Similar Readers</h1>

<br/>

<table style=" margin-left: auto;
    margin-right: auto;">
  

    <tr>
        <th>Name</th>
        <th>Age</th>
		 <th>E-mail</th>
         <th>Similarity</th>
     </tr>
 <?php  foreach ($similar_users as $similar_user):?>
 <tr>
        <td>
            <?php 
             echo   $this->Html->link($similar_user->fname. " " .$similar_user->lname, ['controller'=>'Users', 'action' => 'user', $similar_user->id], array('style' =>  'color: gray;font-weight:400'));
           ?>

        </td>
        <td>
            <?php 
             echo  (date('Y')-$similar_user->bdate->format('Y')); 
           ?>

        </td>
         <td>
            <?php 
             echo  $similar_user->email; 
           ?>

        </td>
        <td>
            <?php 
            $prcntg=round($scores[$similar_user->id]*100);
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
                            width: '.round($scores[$similar_user->id]*100).'%;
                            height: 100%;
                            background-color: '.$color.';
                            text-align: center;
                            line-height: 30px;
                            color: white;">
               </div>
            </div>';
             echo $this->Html->link('Why', ['action' => 'why',$user,$similar_user->id ]);
            ?>

        </td>
        </tr>
         <?php endforeach; ?>
         </table>
<?php } ?>