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
  padding:18px;
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
tr:nth-child(even) td {
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
  padding:10px;
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

}</style>
 <style>


.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #222B2E;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
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

#book_cover{
    transition: 0.5s;
}
#book_cover:hover{
    margin-right:124px;
    transform:scale(2);
}

input{
  width:400px;
}
</style>     

<!--- -------------------------->




<!--- -------------------------->

<div id="signup_div" >
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit Profile') ?></legend>
        <table >
    <tr >
        <th >
            First Name
        </th>
        <td>
            <?php echo $this->Form->input('fname',['label'=>'']); ?>
        </td>
    </tr>
       <tr>
        <th>
            Last Name
        </th>
        <td>
            <?php  echo $this->Form->input('lname',['label'=>'']); ?>
        </td>
    </tr>
       
       
       <tr>
        <th>
            Username
        </th>
        <td>
            <?php  echo $this->Form->input('username',['readonly'=>'readonly','label'=>'']);  ?>
        </td>
    </tr>
       <tr>
        <th>
            Password
        </th>
        <td>
            <?php echo $this->Form->input('password',['value'=>'','id'=>'p1','onkeyup'=>'val()', 'label'=>'']);  ?>
        </td>
    </tr>
       <tr>
        <th>
            Repeat Password
        </th>
        <td>
            <?php   echo $this->Form->input('password2',['type'=>'password','label'=>'','id'=>'p2','onkeyup'=>'val()']);
                    echo "<p id='message' style='color:red;font-size:12px;'></p>"; ?>
        </td>
    </tr>
    <tr>
      

       <tr>
        <th>
            E-mail
        </th>
        <td>
            <?php   echo $this->Form->input('email',['label'=>'']); ?>
        </td>
        <tr>
                
        </tr>
    </tr>

       <tr>
        <th>
            Birth Date
        </th>
        <td>
            <?php   echo $this->Form->input('bdate',['label'=>'']); ?>
        </td>
        <tr>
                
        </tr>
    </tr>

       <tr>
        <th>
            About
        </th>
        <td>
            <?php   echo $this->Form->input('about',['label'=>'']); ?>
        </td>
        <tr>
                
        </tr>
    </tr>
</table>
<p style="position:relative;float:left;left:-5px;"><?= $this->Form->button(__('Update'),['id'=>'btn','class'=>'button','style'=>';background:#006587']) ?></p>
 <?= $this->Form->end() ?>

     </fieldset>
    
</div>



 




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