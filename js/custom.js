/***************************************************************
************************** VARIABLES ***************************
***************************************************************/
var s_days_array = [];
var classes_array = [];
var s_css_top_array = [];
var s_css_left_array = [];
var s_css_bg_array = [];
var s_css_fore_array = [];
var s_css_width_array = [];

var n_classes_array = [];
var n_classes_bg_array = [];
var n_classes_fore_array = [];

var teachers_array = [];
var t_css_top_array = [];
var t_css_left_array = [];
var t_css_bg_array = [];
var t_css_fore_array = [];
var t_days_array = [];

var n_teachers_array = [];
var n_teachers_bg_array = [];
var n_teachers_fore_array = [];


var draggable_opts = {
    helper: 'clone',
    cursor: "move",
    cursorAt: {
        top: -2,
        left: -2
    }

}
var resizable_opts= {
	animate: true,
	autoHide: true,
	handles: 'e',
	ghost:true,
	
	resize: function(event, ui) { 
		ui.size.height = "30px";
		
	}
}




/***************************************************************
********************** Hunain's functions **********************
***************************************************************/



$(function() {
	populateArrays();
	$( ".resizable" ).resizable(resizable_opts);

    $(".source li").draggable(draggable_opts);

    $(".target.connected").droppable({
		  
		  addClasses: false,
		  activeClass: "listActive",
		  accept: "#clas li",
		  disabled: true,
		  tolerance:"touch",
		  drop: function(event, ui) {
			var bgColor = $(ui.draggable).css('backgroundColor');
			var foreColor = $(ui.draggable).css('color');
			var link = $("<a href='#' class='dismiss'>x</a>");
			
			var list = $("<div class='resizable' '></div>").text(ui.draggable.text().slice(0,-1)).css('backgroundColor',bgColor).css('color',foreColor).css("position","absolute").draggable({ containment: "parent" });
			$(list).append(link);
			$(list).appendTo(this);
			$( ".resizable" ).resizable(resizable_opts);
		  }
	}).on("click", ".dismiss", function(event) {
        event.preventDefault();
        $(this).parent().remove();

    });

    $(".Teachtarget").droppable({
		  
		  addClasses: false,
		  activeClass: "listActive",
		  accept: "#teach li",
		  drop: function(event, ui) {
			var bgColor = $(ui.draggable).css('backgroundColor');
			var foreColor = $(ui.draggable).css('color');
			var link = $("<a href='#' class='dismiss'>x</a>");
			var list = $("<li></li>").text(ui.draggable.text().slice(0,-1)).css('backgroundColor',bgColor).css('color',foreColor);
			$(list).append(link);
			$(list).appendTo(this);
			$day = $(this).attr("data-day");
			$('.target.connected[data-day="'+ $day +'"]').droppable("enable");
		  }
		}).sortable({
		  items: "li",
		  revert:true,
		  placeholder: "sortable-placeholder",
		  
		  sort: function() {
			$(this).removeClass("listActive");
		  }
				
		}).on("click", ".dismiss", function(event) {
		  event.preventDefault();
		  $li = $(this).parent();
		  $ul = $li.parent(); 
		  $day = $ul.attr("data-day");
		  $top = $li.index()*36;
		  $bottom = $top + 36;
		 
		  // Delete all classes taught by that teacher.
		  // Positioning used to calculate which teacher teaches which classes.
		  // So have to correct positioning of subsequent classes.
		  
		  $('.target.connected[data-day="'+ $day +'"]').children().each(function(){
					  $curr_top = parseInt($(this).css("top").replace("px",""));
					  if($curr_top >= $top && $curr_top+32 <= $bottom)
						  $(this).remove();
					  else if($curr_top+32 >= $bottom){
						  $new_top = $curr_top - 36;
						  $(this).css("top",$new_top + "px");
					  }
					  if($(this).css("top") === "auto" && $top === 0)
						  $(this).remove();
				  });
		
		  
		  if($ul.children().length === 1){
			  
			  $('.target.connected[data-day="'+ $day +'"]').droppable("disable").empty();
		  }
		  
		  $li.remove();	 	
		  
		});

});





/***************************************************************
*********************** Utility functions **********************
***************************************************************/

/* Add Class and Teacher Objects to the lists dynamically on button click */
function addClass() {
	var clas = document.getElementById("class").value;
	var bckcolor = document.getElementById("bckcolor").value;
	var forecolor = document.getElementById("forecolor").value;
	var newClass = $('<li style="background-color:'+ bckcolor + '; color:'+forecolor+ ';">'+ clas +'</li>').draggable(draggable_opts);
	$("#clas").append(newClass);

	// add class to array
	n_classes_array.push(clas);
	n_classes_fore_array.push(forecolor);
	n_classes_bg_array.push(bckcolor);
}

function addTeacher() {
	var teacher = document.getElementById("teacher").value;
	var bckcolor = document.getElementById("bckcolor2").value;
	var forecolor = document.getElementById("forecolor2").value;
	var newClass = $('<li style="background-color:'+ bckcolor + '; color:'+forecolor+ ';">'+ teacher +'</li>').draggable(draggable_opts);
	$("#teach").append(newClass);

	// add class to array
	n_teachers_array.push(teacher);
	n_teachers_fore_array.push(forecolor);
	n_teachers_bg_array.push(bckcolor);
	//alert(forecolor);
}

/*Add to database */

function addDataToArraysFor(day) {
	// add teachers
	$('.Teachtarget.target[data-day="'+ day +'"]').each(function() {
		var teachers = $(this).children();
		if (teachers.length > 0) {
			for (var i = 0; i < teachers.length; i++) {
				
				t_days_array.push(this.getAttribute('data-day'));
				teachers_array.push($(teachers[i]).clone().children().remove().end().text());
				t_css_top_array.push($(teachers[i]).css('top'));
				t_css_left_array.push($(teachers[i]).css('left'));
				t_css_bg_array.push($(teachers[i]).css('background-color'));
				t_css_fore_array.push($(teachers[i]).css('color'));
			}
		}
	});

	// add classes
	$('.target.connected[data-day="'+ day +'"]').each(function() {
		// get classes of every timeslot
		var classes = $(this).children();
		if (classes.length > 0) {
			for (var i = 0; i < classes.length; i++) {
				s_days_array.push(this.getAttribute('data-day'));
				
				classes_array.push($(classes[i]).clone().children().remove().end().text());

				s_css_top_array.push($(classes[i]).css('top'));
				s_css_left_array.push($(classes[i]).css('left'));
				s_css_bg_array.push($(classes[i]).css('background-color'));
				s_css_fore_array.push($(classes[i]).css('color'));
				s_css_width_array.push($(classes[i]).css('width'));
			}
		}
	});
}
function populateLists(type) {
	if (type == 'class') {
		for (var i = 0; i < s_days_array.length; i++) {
			var parentDiv = $('.target.connected[data-day="'+ s_days_array[i] +'"]');
			var childDiv = $('<div class="resizable" style=" position:absolute; background-color: '+ s_css_bg_array[i] +'; color: '+ s_css_fore_array[i] +';width: '+ s_css_width_array[i] +'; top: '+ s_css_top_array[i] +'; left: '+ s_css_left_array[i] +';"></div>').draggable({ containment: "parent" });
		    var link = $("<a href='#' class='dismiss'>x</a>");
			childDiv.html(classes_array[i]);
		    $(childDiv).append(link);
		
		    $(parentDiv).append(childDiv);
			$( ".resizable" ).resizable(resizable_opts);
		};
	}
	else if (type == 'teacher') {
		for (var i = 0; i < t_days_array.length; i++) {
			var ul = $('.Teachtarget.target[data-day="'+ t_days_array[i] +'"]');
			var li = $('<li style="background-color: '+ t_css_bg_array[i] +'; color: '+ t_css_fore_array[i] +';" id="resizable">'+ teachers_array[i] +'</li>');
			var link = $("<a href='#' class='dismiss'>x</a>");
			$(li).append(link);
			ul.append(li);
			$('.target.connected[data-day="'+ t_days_array[i] +'"]').droppable("enable")
		};
	}
}

function emptyAllArrays() {
 classes_array = [];
 s_days_array = [];
 s_css_top_array = [];
 s_css_left_array = [];
 s_css_bg_array = [];
 s_css_fore_array = [];
 s_css_width_array = [];
 
 teachers_array = [];
 t_css_top_array = [];
 t_css_left_array = [];
 t_days_array = [];
 t_css_fore_array = [];
 t_css_bg_array = [];
}
function populateArrays() {
	$.ajax({
        type: 'GET',
        async: true,
        url: 'http://localhost/calendar/get_data.php',
        crossDomain: true,
        dataType: 'json',
        success: function(response) {
        	// get classes
        	var s_no_of_records = (response.classes).length;
        	for (var i = 0; i < s_no_of_records; i++) {
        		s_days_array.push(response.s_days[i]);
				classes_array.push(response.classes[i]);
				s_css_top_array.push(response.s_css_top[i]);
				s_css_left_array.push(response.s_css_left[i]);
				s_css_bg_array.push(response.s_bg_colors[i]);
				s_css_fore_array.push(response.s_fore_colors[i]);
				s_css_width_array.push(response.s_css_width[i]);
        	};
        	// get teachers
        	var t_no_of_records = (response.teachers).length;
        	for (var i = 0; i < t_no_of_records; i++) {
        		t_days_array.push(response.t_days[i]);
				teachers_array.push(response.teachers[i]);
				t_css_bg_array.push(response.t_bg_colors[i]);
				t_css_fore_array.push(response.t_fore_colors[i]);
        	};


        	populateLists('class');
        	populateLists('teacher');
            
        },
        error: function(textStatus, errorThrown) {
            alert("Cannot connect to db: " + textStatus.status);
        }
    });
}


/***************************************************************
******************** Saving to DB functions ********************
***************************************************************/
function addToDatabase() {
	
	emptyAllArrays();
	// traverse over day one by one
	
	addDataToArraysFor('sunday');
	addDataToArraysFor('monday');
	addDataToArraysFor('tuesday');
	addDataToArraysFor('wednesday');
	addDataToArraysFor('thursday');
	addDataToArraysFor('friday');
	addDataToArraysFor('saturday');

	// send classes data
    $.ajax({
        type: 'GET',
        async: true,
        url: 'http://localhost/calendar/store_classes.php',
        data: {
            'days_array': s_days_array,
            'classes_array': classes_array,
            'css_top_array': s_css_top_array,
            'css_left_array': s_css_left_array,
            'css_bg_array': s_css_bg_array,
            'css_fore_array': s_css_fore_array,
            'css_width_array': s_css_width_array
        },
        crossDomain: true,
        success: function(response) {
            
        },
        error: function(textStatus, errorThrown) {
            alert("addToDatabase: " + textStatus.status);
        }
    });
	

	// send teachers data
    $.ajax({
        type: 'GET',
        async: true,
        url: 'http://localhost/calendar/store_teachers.php',
        data: {
            'teachers_array': teachers_array,
            'days_array': t_days_array,
            'css_top_array': t_css_top_array,
            'css_left_array': t_css_left_array,
            'css_bg_array': t_css_bg_array,
            'css_fore_array': t_css_fore_array
        },
        crossDomain: true,
        success: function(response) {
            
			
        },
        error: function(textStatus, errorThrown) {
            alert("addToDatabase: " + textStatus.status);
        }
    });

	// send new classes list to DB
	$.ajax({
        type: 'GET',
        async: true,
        url: 'http://localhost/calendar/store_new_classes.php',
        data: {
            'classes_array': n_classes_array,
            'css_bg_array': n_classes_bg_array,
            'css_fore_array': n_classes_fore_array
        },
        crossDomain: true,
        success: function(response) {
           
        },
        error: function(textStatus, errorThrown) {
            alert("addToDatabase: " + textStatus.status);
        }
    });

	// send new teachers list to DB
	$.ajax({
        type: 'GET',
        async: true,
        url: 'http://localhost/calendar/store_new_teachers.php',
        data: {
            'teachers_array': n_teachers_array,
            'css_bg_array': n_teachers_bg_array,
            'css_fore_array': n_teachers_fore_array
        },
        crossDomain: true,
        success: function(response) {
            
        },
        error: function(textStatus, errorThrown) {
            alert("addToDatabase: " + textStatus.status);
        }
    });

	alert("The timetable has been saved to database");
	// empty all arrays
	emptyAllArrays();
}
