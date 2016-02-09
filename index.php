<?php
$connection = include 'connection.php';
$get_teachers = "SELECT teacher_name,teacher_bgcolor,teacher_forecolor FROM teachers_lst";
$result_teachers = mysqli_query($connection, $get_teachers);

$get_classes = "SELECT class_name,class_bgcolor,class_forecolor FROM classes_lst";
$result_classes = mysqli_query($connection, $get_classes);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Time Table</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/jquery-ui.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
  
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery-ui.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/custom.js"></script>
  </head>
  <body>
    <div class="container">
      

      <h2 class="text-primary">Swimming Time Table</h2>
      <div style="float:left; width:200px;">
    <h3>Classes</h3>
        <ul id="clas" class="source"  >
      		<?php while($row = mysqli_fetch_assoc($result_classes)){
      			echo "<li style='background-color:".$row['class_bgcolor']."; color:".$row['class_forecolor']."'>".$row['class_name']."<a href='#' class='dismiss'>x</a></li>";
      		} ?>
          <li>Swim Level 1<a href='#' class='dismiss'>x</a></li>
          <li>Swim Level 2<a href='#' class='dismiss'>x</a></li>
          <li>Swim Level 3<a href='#' class='dismiss'>x</a></li>
          <li>Swim Level 4<a href='#' class='dismiss'>x</a></li>
          <li>Swim Level 5<a href='#' class='dismiss'>x</a></li>
          <li>Swim Level 6<a href='#' class='dismiss'>x</a></li>
          <li>Swim Level 7<a href='#' class='dismiss'>x</a></li>
          <li>Swim Level 8<a href='#' class='dismiss'>x</a></li>
          <li>Club Junior<a href='#' class='dismiss'>x</a></li>
          <li>School Squad<a href='#' class='dismiss'>x</a></li>    
        </ul>
    
    <button id="add-class" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClass">Add new class</button>
    
    <h3>Teachers</h3>
    <ul id="teach" class="source"  >
        	<?php while($row = mysqli_fetch_assoc($result_teachers)){
      			echo "<li style='background-color:".$row['teacher_bgcolor']."; color:".$row['teacher_forecolor']."'>".$row['teacher_name']."<a href='#' class='dismiss'>x</a></li>";
      		} ?>
          <li>Teacher A<a href='#' class='dismiss'>x</a></li>
          <li>Teacher B<a href='#' class='dismiss'>x</a></li>
          <li>Teacher C<a href='#' class='dismiss'>x</a></li>   
          
        </ul>
    <button id="add-teacher" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTeacher">Add new teacher</button>
      </div>
    
    <!-- Modal -->
    <div id="addClass" class="modal fade" role="dialog">
      <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-lock"></span> Add Class</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
        
        <div class="form-group">
          <label for="class"><span class="glyphicon glyphicon-briefcase"></span> Class Name</label>
          <input type="text" class="form-control" id="class" placeholder="Enter name">
          </div>
        <div class="form-group">  
          <label for="class"><span class="glyphicon glyphicon-briefcase"></span>Background Color</label>
          <input type="color" class="form-control" id="bckcolor" >
        </div>
        <div class="form-group">  
          <label for="class"><span class="glyphicon glyphicon-briefcase"></span>Foreground Color</label>
          <input type="color" class="form-control" id="forecolor" >
        </div>
        <button type="submit" onclick="addClass();" class="btn btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> Add Class</button>
       
              </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            
          </div>
      </div>
      </div>
    </div>
    <div id="addTeacher" class="modal fade" role="dialog">
      <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-lock"></span>Add Teacher</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
        
        <div class="form-group">
          <label for="class"><span class="glyphicon glyphicon-user"></span> Teacher Name</label>
          <input type="text" class="form-control" id="teacher" placeholder="Enter name">
        </div>
        <div class="form-group">  
          <label for="class"><span class="glyphicon glyphicon-briefcase"></span>Background Color</label>
          <input type="color" class="form-control" id="bckcolor2" >
        </div>
        <div class="form-group">  
          <label for="class"><span class="glyphicon glyphicon-briefcase"></span>Foreground Color</label>
          <input type="color" class="form-control" id="forecolor2" >
        </div>
        <button type="submit" onclick="addTeacher();" class="btn btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> Add Teacher</button>
     
              </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            
          </div>
      </div>
      </div>
    </div>
    
    
      <div class = "tab">
        <table class="table table-hover table-bordered" >
          <thead>
            <tr>
              <th class="day" width="100px"></th>
              <th class="teach">Teacher</th>
              <th>08:30</th>
			  <th>08:45</th>
              <th>09:00</th>
			  <th>09:15</th>
              <th>09:30</th>
			  <th>09:45</th>
              <th>10:00</th>
              <th>10:15</th>
			  <th>10:30</th>
			  <th>10:45</th>
              <th>11:00</th>
			  <th>11:15</th>
              <th>11:30</th>
			  <th>11:45</th>
              <th>12:00</th>
			  <th>12:15</th>
              <th>12:30</th>
			  <th>12:45</th>
              <th>13:00</th>
			  <th>13:15</th>
              <th>13:30</th>
			  <th>13:45</th>
              <th>14:00</th>
			  <th>14:15</th>
              <th>14:30</th>
			  <th>14:45</th>
              <th>15:00</th>
			  <th>15:15</th>
              <th>15:30</th>
			  <th>15:40</th>
              <th>16:00</th>
			  <th>16:15</th>
              <th>16:30</th>
			  <th>16:45</th>
              <th>17:00</th>
			  <th>17:15</th>
              <th>17:30</th>
			  <th>17:45</th>
              <th>18:00</th>
			  <th>18:15</th>
              <th>18:30</th>
			  <th>18:45</th>
              <th>19:00</th>
			  <th>19:15</th>
              <th>19:30</th>
			  <th>19:45</th>
              <th>20:00</th>
            </tr>
          </thead>
          <tbody>
            <tr class="row_sunday">
              <th class="day">Sunday</th>
              <td>
                <ul data-day="sunday" class="Teachtarget target"></ul>
              </td>
              <td colspan="47">
                <div data-starting-time="830" data-ending-time = "900" data-day="sunday" class="target connected"></div>
              </td>
            </tr>
            <tr class="row_monday">
              <th class="day">Monday</th>
               <td>
                <ul data-day="monday" class="Teachtarget target"></ul>
              </td>
              <td colspan="47">
                <div data-starting-time="830" data-ending-time = "900" data-day="monday" class="target connected"></div>
              </td>
            </tr>
            <tr class="row_tuesday">
              <th class="day">Tuesday</th>
               <td>
                <ul data-day="tuesday" class="Teachtarget target"></ul>
              </td>
              <td colspan="47">
                <div data-starting-time="830" data-ending-time = "900" data-day="tuesday" class="target connected"></div>
              </td>
            </tr>
            <tr class="row_wednesday">
              <th class="day">Wednesday</th>
              <td>
                <ul data-day="wednesday" class="Teachtarget target"></ul>
              </td>
              <td colspan="47">
                <div data-starting-time="830" data-ending-time = "900" data-day="wednesday" class="target connected"></div>
              </td>
            </tr>
            <tr class="row_thursday">
              <th class="day">Thursday</th>
               <td>
                <ul data-day="thursday" class="Teachtarget target"></ul>
              </td>
              <td colspan="47">
                <div data-starting-time="830" data-ending-time = "900" data-day="thursday" class="target connected"></div>
              </td>
            </tr>
            <tr class="row_friday">
              <th class="day">Friday</th>
               <td>
                <ul data-day="friday" class="Teachtarget target"></ul>
              </td>
              <td colspan="47">
                <div data-starting-time="830" data-ending-time = "900" data-day="friday" class="target connected"></div>
              </td>
            </tr>
			<tr class="row_saturday">
              <th class="day">Saturday</th>
               <td>
                <ul data-day="saturday" class="Teachtarget target"></ul>
              </td>
              <td colspan="47">
                <div data-starting-time="830" data-ending-time = "900" data-day="saturday" class="target connected"></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
	 
		 <div class="savebtn">
				<button class="btn btn-success" onclick="addToDatabase();">Save to Database</button>
		  </div>
    </div>
	
	<script>
		$(".source a.dismiss").on('click', function(event){
	 event.preventDefault();
	$(this).parent().remove();
});

	</script>
  </body>
</html>