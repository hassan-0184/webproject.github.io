<?php include_once 'header.php'; ?>
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
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                              <i class="fa fa-bars"></i>
                          </button>
                                  
                          
                                              <a class="navbar-brand d-none d-lg-block" href="#">
                                              
                                                <img src="bootstrap-logo.svg" alt="" width="38" height="30" class="">
                                              <span><?php echo $project_details[0]['p_name']; ?></span> 
                                              </a>
                                              
                                              <div class="container-fluid">
                                       
                                                  <div class="collapse navbar-collapse" id="navbarNav">
                                                    <ul class="navbar-nav">
                                                    <a class="nav-link border-left-primary active" href="project_backlog.php?page=<?php echo $project_details[0]['p_id'];?>">Task</a>
                                                   
                                                        <a class="nav-link " aria-current="page" href="project.php?page=<?php echo $project_details[0]['p_id'];?>">Kanban</a>
                            
                                                        <a class="nav-link" href="project_calender.php?page=<?php echo $project_details[0]['p_id'];?>">Calender</a>
                                                      
                                                      
                                                    </ul>
                                                  </div>
                                                  
                                                </div>
                                            
                  
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
                        <!-- End of Topbar -->

                        <!-- /.container-fluid -->
            
                    </div>
                    
               

               

                <!-- Begin Page Content -->
                <div class="container-fluid">

<!-- Back log -->

                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Backlog</h6>
                                </div>
                                <div class="card-body">
                                <?php

$total_tasks = $db->count_all_tasks($project_id, 'NULL');

if ($total_tasks > 0)
{
    $tasks_results = $db->get_all_tasks($project_id, 'NULL');
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

<!-- To do-->
                        <div class="col-lg-12">

                           
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">To Do</h6>
                                </div>
                                <div class="card-body">
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

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
    $(document).ready(function(){
        $("#add_team_modal").on('submit', function(e){
			e.preventDefault(); 
            var team_name = $('#add_team_name').val();
			$.ajax({
				url: 'action.php',
				method: 'POST',
				data: {team_name: team_name, action:"Add_Team"}, 
				dataType: 'json', 
				beforeSend:function()
				{
					$('#add_team_submit').val('Validating...');
					$('#add_team_submit').attr('disabled', true); 
				},
				success: function(data)
				{
                    $('#add_team_submit').val('Add Task');
					$('#add_team_submit').attr('disabled', false);
					if (data.success)
					{
						$("#add_team_modal").modal("toggle");
                        $("#team_names").load(location.href + " #team_names");
					}
					if (data.error)
					{
						if (data.error_t_team != '')
							$('#error_t_team').text(data.error_t_name); 
						else 
							$('#error_t_team').text('');
					}	
				}
			});
		});

 $("#add_project_modal").on('submit', function(e){
			e.preventDefault(); 
            var project_name = $('#add_project_name').val();
            var project_description = $('#add_project_description').val();
            var team_name = $('#project_team_name').val();
			$.ajax({
				url: 'action.php',
				method: 'POST',
				data: {project_name: project_name, team_name: team_name, project_description: project_description, action:"Add_Project"}, 
				dataType: 'json', 
				beforeSend:function()
				{
					$('#add_project_submit').val('Validating...');
					$('#add_project_submit').attr('disabled', true); 
				},
				success: function(data)
				{
                    $('#add_project_submit').val('Add Project');
					$('#add_project_submit').attr('disabled', false);
					if (data.success)
					{
						$("#add_project_modal").modal("toggle");
                        $("#project_names").load(location.href + " #project_names");
					}
					if (data.error)
					{
						if (data.error_p_name == 'Project Name is Required')
						{
                            $('#error_p_name').text(data.error_p_name); 
                        }
                        else 
							$('#error_p_name').text('');
                        if (data.error_p_description == 'Project Description is Required')
						{
                        	$('#error_p_description').text(data.error_p_description); 
                        }
                        else 
							$('#error_p_description').text('');
                        if (data.error_p_team == 'Team is Required')
						{	
                            $('#error_p_team').text(data.error_p_team); 
                        }
                        else 
							$('#error_p_team').text('');
					}	
				}
			});
		});
    });
</script>
</html>