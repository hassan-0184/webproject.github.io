<?php include "header.php" ?>
<?php $project_id = $_GET['page']; 
$project_details = $db->get_project_info($project_id);
?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              
                    <div id="content">
            
                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
                                <nav class="navbar navbar-expand navbar-light bg-white topbar  static-top ">
                                            
                                            <a class="navbar-brand d-none d-lg-block" href="#">
                                                <img src="bootstrap-logo.svg" alt="" width="38" height="30" class="d-inline-block align-text-top">
                                              <?php echo $project_details[0]['p_name']; ?>
                                            </a>
            
                                            <div class="container-fluid">
                                     
                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                  <ul class="navbar-nav">
                                                  <a class="nav-link border-left-primary" href="project_backlog.php?page=<?php echo $project_details[0]['p_id'];?>">Task</a>
                                                   
                                                   <a class="nav-link active" aria-current="page" href="project.php?page=<?php echo $project_details[0]['p_id'];?>">Kanban</a>
                       
                                                   <a class="nav-link" href="project_calender.php?page=<?php echo $project_details[0]['p_id'];?>">Calender</a>
                                                 
                                                    
                                                    
                                                  </ul>
                                                </div>
                                                
                                              </div>
                                          </nav>
                                        
                
                                          <ul class="navbar-nav ml-auto">
            
                            
                                <div class="topbar-divider d-none d-sm-block"></div>
            
                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-sm-inline text-gray-600 small"><?php echo $member_info['0']['m_name']; ?></span>
                                        <img class="img-profile rounded-circle"
                                            src="img/undraw_profile.svg">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                       
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
            
                            </ul>
            
                        </nav>
                       
                        <!-- /.container-fluid -->
            
                    </div>
                    
               

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" id = "all_tasks">

                   
                    

                    <div class="row">
<!-- First part -->
                           <div class="col-sm-3" id = "todo_tasks">

                                <div class="card shadow">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary">To Do</h6>
                                        <?php if ($member_info[0]['m_role'] == 'Team Lead')
            {?>
                                        <button type="button" class="btn btn-sm btn-success add_task_button" id = "add_task" data-id = "<?php echo $id ?>" data-toggle="modal" data-target="#add_task_model">Add Task</button>
                                        <?php }?>
                                    </div>
                                    <div class="card-body"><!-- Done -->
                                         <?php

                                            $total_tasks = $db->count_all_tasks($project_id, 'todo');

                                            if ($total_tasks > 0)
                                            {
                                                $tasks_results = $db->get_all_tasks($project_id, 'todo');
                                                foreach($tasks_results as $row)
                                                {
                                                    ?>
                                        <div class="card mb-3 ">
                                           
                                                <div class="card-body px-1 py-1">
                                            
                                                
                                                    <a class="open-AddTodoTask" data-toggle="modal" data-id = "<?php echo $row['t_id'] ?>" href="#todo_task_modal" ><h4  class="small"><?php echo $row['t_name']; ?></h4></a>
                                            
                                                <div class="bg-white mb-1 ml-3 ">
                                    
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item dropdown no-arrow small">
                                                                <a class="" href="#" >
                                                                                                        
                                                                        <img src="img/undraw_profile.svg" class="rounded-circle small"alt=""  width="20" height="20">
                                                                        <span class="ml-2 text-gray-600 small"><?php echo $row['m_name'].' ('.$row['m_role'].')'; ?></span>
                                                                </a>
                                                            </a>
                                                        </li>
                                                        </ul>
                                                </div>
                    
                                            </div>
                                        </div>
                                                    <?php 
                                                }
                                            }
                                            ?>

                                        

                                        
                    
                                         

                                    </div>
                                </div>
                        </div>


<!-- Second part -->

                        <div class="col-sm-6">
                            <div class="row">

                                     <div class="col-sm-6 ">

                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary">Doing</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $total_tasks = $db->count_all_tasks($project_id, 'doing');

                                            if ($total_tasks > 0)
                                            {
                                                $tasks_results = $db->get_all_tasks($project_id, 'doing');
                                                foreach($tasks_results as $row)
                                                {
                                                    ?>
                                            <div class="card mb-3 ">
                                                <div class="card-body px-1 py-1">
                                                <a class="open-AddTodoTask" data-toggle="modal" data-id = "<?php echo $row['t_id'] ?>" href="#todo_task_modal" ><h4  class="small"><?php echo $row['t_name']; ?></h4></a>
                                                <div class="bg-white mt-2 ">
                                    
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item dropdown no-arrow small">
                                                                <a class="" href="#" >
                                                                                                        
                                                                        <img src="img/undraw_profile.svg" class="rounded-circle small"alt=""  width="20" height="20">
                                                                        <span class="ml-2 text-gray-600 small"><?php echo $row['m_name'].' ('.$row['m_role'].')'; ?></span>
                                                                </a>
                                                            </a>
                                                        </li>
                                                        </ul>
                                            </div>
                        
                                                </div>
                                            </div>
                                            <?php 
                                                }
                                            }
                                            ?>
                                            
    
                                        </div>
                                    </div>
                                        </div>
                             <div class="col-sm-6 ">

                                <div class="card shadow">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">Done</h6>
                                    </div>
                                    <div class="card-body">
                                        <?php

                                            $total_tasks = $db->count_all_tasks($project_id, 'done');

                                            if ($total_tasks > 0)
                                            {
                                                $tasks_results = $db->get_all_tasks($project_id, 'done');
                                                foreach($tasks_results as $row)
                                                {
                                                    ?>
                                        <div class="card mb-3 ">
                                            <div class="card-body px-1 py-1">
                                            <a class="open-AddTodoTask" data-toggle="modal" data-id = "<?php echo $row['t_id'] ?>" href="#todo_task_modal" ><h4  class="small"><?php echo $row['t_name']; ?></h4></a>
                                            <div class="bg-white mt-2 ">
                                
                                                <ul class="navbar-nav">
                                                    <li class="nav-item dropdown no-arrow small">
                                                            <a class="" href="#" >
                                                                                                    
                                                                    <img src="img/undraw_profile.svg" class="rounded-circle small"alt=""  width="20" height="20">
                                                                    <span class="ml-2 text-gray-600 small"><?php echo $row['m_name'].' ('.$row['m_role'].')'; ?></span>
                                                            </a>
                                                        </a>
                                                    </li>
                                                    </ul>
                                        </div>
                    
                                            </div>
                                        </div>
                                        <?php 
                                                }
                                            }
                                            ?>

                                    </div>
                                </div>
                                 </div>

                                 <div class="col-sm-12 mt-4">

                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary">Testing</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $total_tasks = $db->count_all_tasks($project_id, 'testing');

                                            if ($total_tasks > 0)
                                            {
                                                $tasks_results = $db->get_all_tasks($project_id, 'testing');
                                                foreach($tasks_results as $row)
                                                {
                                                    ?>
                                            <div class="card mb-3 ">
                                                <div class="card-body px-1 py-1">
                                                <a class="open-AddTodoTask" data-toggle="modal" data-id = "<?php echo $row['t_id'] ?>" href="#todo_task_modal" ><h4  class="small"><?php echo $row['t_name']; ?></h4></a>
                                                <div class="bg-white mt-2 ">
                                    
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item dropdown no-arrow small">
                                                                <a class="" href="#" >
                                                                                                        
                                                                        <img src="img/undraw_profile.svg" class="rounded-circle small"alt=""  width="20" height="20">
                                                                        <span class="ml-2 text-gray-600 small"><?php echo $row['m_name'].' ('.$row['m_role'].')'; ?></span>
                                                                </a>
                                                            </a>
                                                        </li>
                                                        </ul>
                                            </div>
                        
                                                </div>
                                            </div>
                                             <?php 
                                                }
                                            }
                                            ?>
                                           
    
                                        </div>
                                    </div>
                                     </div>
                    
                              </div>
                        </div>

<!-- Third part -->


                        <div class="col-sm-3">

                            <div class="card shadow">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Completed</h6>
                                </div>
                                <div class="card-body">
                                    <?php

                                            $total_tasks = $db->count_all_tasks($project_id, 'completed');

                                            if ($total_tasks > 0)
                                            {
                                                $tasks_results = $db->get_all_tasks($project_id, 'completed');
                                                foreach($tasks_results as $row)
                                                {
                                                    ?>
                                    <div class="card mb-3 ">
                                        <div class="card-body px-1 py-1">
                                        <a class="open-AddTodoTask" data-toggle="modal" data-id = "<?php echo $row['t_id'] ?>" href="#todo_task_modal" ><h4  class="small"><?php echo $row['t_name']; ?></h4></a>
                                        <div class="bg-white mt-2 ">
                            
                                            <ul class="navbar-nav">
                                                <li class="nav-item dropdown no-arrow small">
                                                        <a class="" href="#" >
                                                                                                
                                                                <img src="img/undraw_profile.svg" class="rounded-circle small"alt=""  width="20" height="20">
                                                                <span class="ml-2 text-gray-600 small"><?php echo $row['m_name'].' ('.$row['m_role'].')'; ?></span>
                                                        </a>
                                                    </a>
                                                </li>
                                                </ul>
                                    </div>
                
                                        </div>
                                    </div>
                                    <?php 
                                                }
                                            }
                                            ?>
                                   

                                </div>
                            </div>
                    </div>



                    </div>




                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<!-- Modal to Do-->
<div class="modal fade " id="todo_task_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" id = "task_name">
          <h4 class="" name = "modal_title" id="modal_title"> </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        <div class="modal-body">
           <form action="add-student.php" class = "form" id = "add-student-form" method = "POST">
                  
                  <div class = "row form-group">
                        <div class = "col-12 form-group">
                        <h5 for="task_description_title">Task Description </h5>
                        <span name = "task_description" id = "task_description"></span>
                        </div>
                        
                    </div>
                    <div class = "row form-group">
                            <div class = "col-12 form-group">
                            <h5 for="description">Task Member</h5>
                            <span name = "task_member" id = "task_member"></span>
                            </div>
                    </div>
                    
                    <div class="modal-footer"></div>
                    <?php if ($member_info[0]['m_role'] == 'Team Lead')
            {?>
                    <div class = "row" id = "task_buttons">
                       
                    </div>
                  <?php }?>
 
  
             </form> <!-- Form end -->
        </div>
        
      </div>
    </div>
</div>

<!-- Modal Add-->
<div class="modal fade" id="add_task_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add a New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="javascript:void(0);" class = "form" id = "add-task-form" method = "POST">
                <div class = "row form-group">
                  <div class = "col-12 form-group">
                    <label for="name">Task Name</label>
                    <input type="text" id = "add_task_name" name = "add_task_name" placeholder = "e.g. Email Validation" value="" class="form-control">
                    <span id = "error_t_name" class = "text-danger"></span>
                  </div>
                </div>
                <div class = "row form-group">
                  <div class = "col-12 form-group">
                    <label for="team_name">Task Team </label>
                    <?php $t_name = $db->get_project_team_name($project_id); ?> 
                    <input type="text" id = "task_team_name" name = "task_team_name" value="<?php echo $t_name[0]['t_name'] ?>" class="form-control" disabled>
                </div>
                  
                </div>
                <div class = "row form-group" hidden>
                  <div class = "col-12 form-group">
                    <label for="team_name">Task Team </label>
                    <?php $t_name = $db->get_project_team_name($project_id); ?> 
                    <input type="text" id = "task_project_id" name = "task_project_id" value="<?php echo $project_id?>" class="form-control" disabled>
                </div>
                  
                </div>
                <div class = "row form-group">
	                <div class = "col-12 form-group">
	                    <label for="description">Task Description</label>
	                    <input required type="text" id = "add_description_name" name = "add_description_name" placeholder = "Details of Task" value="" class="form-control">
                        <span id = "error_t_description" class = "text-danger"></span>
	                </div>
             	</div>
             	<div class = "row form-group">
	                <div class = "col-12 form-group">
	                    <label for="members_name">Members</label>
                        <select name="add_task_member" id="add_task_member" class = "float-left js-example-basic-single form-control w-100" style="margin-bottom: 10px">
                        <option value="NULL">Select</option>
                         <?php $members = $db->get_all_members($project_id); ?>
                          <?php foreach ($members as $member){ ?>
                          <option value="<?php echo $member['m_id']; ?>" ><?php echo $member['m_name'] .' ('.$member['m_role'].')';  ?></option>
                          <?php } ?>
                    </select>
                     <span id = "error_t_member" class = "text-danger"></span>
	                </div>
             	</div>
                <input type="submit" id = "submit_add_task" name = "submit_add_task" class = "w-100 btn btn-success btn-lg btn-block" value ="Add Task">

              </form> <!-- Form end -->
      </div>
     
    </div>
  </div>
</div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kanban 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
 
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
<script>
    $(document).ready(function()
    {
        $(document).on("click", ".open-AddTodoTask", function () 
        {
         var task_id = $(this).data('id');
         $.ajax
         ({
            url: "action.php", 
            type: "POST", 
            dataType: 'json',
            data:{action: "Display_Task", task_id: task_id}, 
            success:function(response)
            {
                $("#modal_title").html(response.t_name);
                $("#task_description").text(response.t_description);
                $("#task_member").text(response.t_member); 
                $("#task_buttons").html(response.t_button); 
            }
         });
        });

        // Clicked on any Move Button 
        $(document).on("click", ".move_button", function(){
            var task_id = $(this).data('id'); 
            var status = $(this).data('status');
            $.ajax
            ({
                url: "action.php", 
                type: "POST", 
                data: {action: "Move_Task", task_id: task_id, status: status},
                success:function(response)
                {
                    $("#todo_task_modal").modal("toggle");
                    $("#all_tasks").load(location.href + " #all_tasks > *");
                    $("#completed_open_tasks").load(location.href + " #completed_open_tasks > *");
                    //window.alert(response); 
                }
            });

        });
        <?php include_once 'footer.php'; ?>
        // Clicked on Add Task Button 
        $(document).on("click", ".add_task_button", function()
        {
            var member_id = $(this).data('id'); 
            $.ajax 
            ({
                url: "action.php", 
                type: "POST", 
                data: {action: "Add_New_Task", member_id: member_id},
                success:function(response)
                {

                }
            });
        });

        // Add a New Task 
        $("#add_task_model").on('submit', function(e){
			e.preventDefault(); 
            var task_name = $('#add_task_name').val();
            var task_description = $('#add_description_name').val();
            var member_name = $('#add_task_member').val();
            var task_project_id = $('#task_project_id').val();
			$.ajax({
				url: 'action.php',
				method: 'POST',
				data: {task_name: task_name, task_description: task_description, member_name: member_name, task_project_id: task_project_id, action:"Add_Task"}, 
				dataType: 'json', 
				beforeSend:function()
				{
					$('#add_task_submit').val('Validating...');
					$('#add_task_submit').attr('disabled', true); 
				},
				success: function(data)
				{
                    $('#add_task_submit').val('Add Task');
					$('#add_task_submit').attr('disabled', false);
					if (data.success)
					{
						$("#add_task_model").modal("toggle");
                        $("#all_tasks").load(location.href + " #all_tasks > *");
                        
					}
					if (data.error)
					{
						
					}	
				}
			});
		});
        
    });
</script>
</html>