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

}</style>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart)
      var user1 = <?php echo json_encode($user1); ?>;
      var user2 = <?php echo json_encode($user2); ?>;
      var reviews = <?php echo json_encode($reviews); ?>;
      var count = <?php echo json_encode($count); ?>;
      var points=[]
      points[0]=['','']
      for(var i=1;i<count;i++){
        points[i]=[{v:reviews[i][1], f: reviews[i][0]},{v:reviews[i][2], f: '('+reviews[i][1]+','+reviews[i][2]+')'}];
      }
    

       
      function drawChart() {
        var data = google.visualization.arrayToDataTable(points);

        var options = {
          hAxis: {title: user1,minValue: 0, maxValue: 5,gridlines:{count:6}},
          vAxis: {title: user2,minValue: 0, maxValue:5,gridlines:{count:6}},
          chartArea: {width:'50%',height:'50%'},
          trendlines: {
            0: {
              type: 'linear',
              showR2: true,
              visibleInLegend: true
            }
          }
        };

        var chartLinear = new google.visualization.ScatterChart(document.getElementById('chartLinear'));
        chartLinear.draw(data, options);

        
      }
    </script>
  </head>
  <body>
    <h1 style="color:white">Pearson Correlation Coefficient Graph</h1>
   

    <hr />
    <br />

    <table style="margin-left: auto;
    margin-right: auto;">
      <tr><th>
    <p>
      The Pearson correlation coefficient is a measure of the strength of a linear association between two variables and is denoted by r. Basically, Pearson correlation attempts to draw a line of best fit through the data of two variables and  indicates how far away all these data points are to this line of best fit .
    </p>
      </tr></th>
  </table>
    <div id="chartLinear" style="height: 1000px; width: 1000px;margin-left: auto;
    margin-right: auto;"></div>
  </body>
</html>