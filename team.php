<?php include 'header.php';?>
<?php $team_id = $_GET['page']; 
$team_details = $db->get_team_info($team_id); ?>
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
                                  
                          
                                              <a class="navbar-brand " href="#">
                                              
                                                <img src="bootstrap-logo.svg" alt="" width="38" height="30" class="mb-1">
                                              <span class=""> <?php echo $team_details[0]['t_name']; ?></span> 
                                              </a>
                                              
                                              
                                            
                  
                                            <ul class="navbar-nav ml-auto">
                                            <?php if ($member_info[0]['m_role'] == 'Team Lead')
            {?>
                                                <button type="button" class="btn btn-sm btn-outline-warning text-left ml-2" id = "add_member" data-toggle="modal" data-target="#add_member_modal">
                                                    + Add a Member
                                                </button>
                                                <?php }?>

                                                
                                  <div class="topbar-divider d-none d-sm-block"></div>
              
                                  <!-- Nav Item - User Information -->
                                  <li class="nav-item dropdown no-arrow">
                                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $member_info['0']['m_name']; ?></span>
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
                <div class="container-fluid" id = "all_members">

                <?php $total_members = $db->count_total_members($team_id); ?>
                    <div class="row ">
                        <div class="col-sm-12">

                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Members <span class="font-weight-bold large"><?php echo $total_members ?></span></h6>
                                </div>
                                <div class="card-body">
                                
                                <?php if ($total_members > 0)
                                            {
                                                $members_results = $db->get_all_tasks_by_member($team_id);
                                                foreach($members_results as $row)
                                                {
                                                    ?>
                                    <div class="card mb-3 ">


                                        <div class="card-body px-1 py-1 bg-warning" >
                                        
                                        <div class="row mt-2 ">
                                
                                                <div class="col-sm-3 " > 

                                                    
                                                        
                                                        <div class=" mb-1 ml-3  ">
                            
                                                            <ul class="navbar-nav">
                                                                <li class="nav-item small ml-4 ">
                                                                        
                                                                                                                
                                                                                <img src="img/undraw_profile.svg" class="rounded-circle "alt=""  width="30" height="30">
                                                                                <span class="ml-4 "><?php echo $row['m_name']; ?></span>
                                                                        
                                                                  
                                                               </li>
                                                            </ul>
                                                        </div> 
                                                    


                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    
                                                  </div>
                                               
                                                
                                                
                                                <div class="col-sm-3 text-center"  >

                                                    
                                                <span class="ml-4 font-weight-bold"><?php echo $row['Tasks']; ?></span>
                                                <span class="ml-2 small "> TASKS</span>
                                                
                                                <span>
                                                                <?php if ($member_info[0]['m_role'] == 'Team Lead' && $member_info[0]['m_id'] != $row['m_id'])
                                                                {?>
                                                                <button type="button" data-toggle="modal" data-target = "#deleteMemberModal" data-id = "<?php echo $row['m_id']; ?>" class="btn ml-5 btn-danger btn-sm delete_member_button">Delete
                                                                </button>
                                                                <?php }
                                                                 else {
                                                                    ?>
                                                                <button type="button" data-toggle="modal" disabled data-target = "#deleteMemberModal" data-id = "<?php echo $row['m_id']; ?>" class="btn ml-5 btn-danger btn-sm delete_member_button">Delete
                                                                </button>
                                                                <?php
                                                                }?>

                                                            </span>
                                              
                                                </div>
                                       
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
<div class="modal fade" id="add_member_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add a New Member</h5>
        <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="javascript:void(0);" class = "form" id = "add-member-form" method = "POST">
                <div class = "row form-group">
                  <div class = "col-12 form-group">
                    <label for="name">Member Name</label>
                    <input required type="text" id = "add_member_name" name = "add_member_name" placeholder = "Full Name" value="" class="form-control">
                    <span id = "error_t_name" class = "text-danger"></span>
                  </div>
                </div>
                <div class = "row form-group">
                  <div class = "col-12 form-group">
                    <label for="team_name">Member Team </label>
                    <input type="text" id = "add_member_team" name = "add_member_team" value="<?php echo $team_details[0]['t_name']; ?>" class="form-control" disabled>
                </div>
                  
                </div>
                <div class = "row form-group" hidden>
                  <div class = "col-12 form-group">
                    <label for="team_name">Member Team </label>
                    <input type="text" id = "member_team_id" name = "member_team_id" value="<?php echo $team_details[0]['team_id']; ?>" class="form-control" disabled>
                </div>
                  
                </div>
                <div class = "row form-group">
	                <div class = "col-12 form-group">
	                    <label for="description">Member Role</label>
                        <select name="add_member_role" id="add_member_role" class = "float-left js-example-basic-single form-control w-100" style="margin-bottom: 10px">
                        <option value="NULL">Select</option>
                        <option value="Team Lead">Team Lead</option>
                        <option value="Junior Developer">Junior Developer</option>
                        <option value="Senior Developer">Senior Developer</option>
                        <option value="Tester">Tester</option>
                                        </select>
                        <span id = "error_member_role_text" class = "text-danger"></span>
	                </div>
             	</div>
                <div class = "row form-group">
	                <div class = "col-12 form-group">
	                    <label for="description">Username</label>
	                    <input required type="text" id = "add_member_username" name = "add_member_username" placeholder = "Unique Username" value="" class="form-control">
                        <span id = "error_t_username" class = "text-danger"></span>
                        <span class = "w-100" style = "margin-left: 1.5%;" id = "availability"></span>
	                </div>
             	</div>
             	<div class = "row form-group">
	                <div class = "col-12 form-group">
	                    <label for="description">Password</label>
	                    <input required type="text" id = "add_member_password" name = "add_member_password" placeholder = "" value="" class="form-control">
	                </div>
             	</div>
                <input type="submit" id = "submit_add_member" name = "submit_add_member" disabled class = "w-100 btn btn-success btn-lg btn-block" value ="Add Member">

              </form> <!-- Form end -->
      </div>
     
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

    <!-- Delete Member Modal-->
    <div class="modal fade" id="deleteMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you Sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Confirm" below if you want to delete the member.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger delete_member_modal" id = "delete_member_modal">Delete</a>
                </div>
            </div>
        </div>
    </div>

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
		$("#add-member-form").on('submit', function(e){
			e.preventDefault(); 
            var m_team_id = $('#member_team_id').val(); 
			$.ajax({
				url: 'action.php',
				method: 'POST',
				data: $(this).serialize()+"&action=Add_Member&member_team_id="+m_team_id, 
				dataType: 'json', 
				beforeSend:function()
				{
					$('#submit_add_member').val('Adding...');
					$('#submit_add_member').attr('disabled', true); 
				},
				success: function(data)
				{	
                    if (data.success)
                    {
                        $('#submit_add_member').val('Add Member');
                        $('#submit_add_member').attr('disabled', false); 
                        $("#add_member_modal").modal("toggle");
                        $(".modal-backdrop").remove();
                        location.reload(); 
                        //$("#all_members").load(location.href + " #all_members > *");
                    }
                    if (data.error)
					{
                        $('#submit_add_member').val('Add Member');
                        $('#submit_add_member').attr('disabled', false); 
						$("#error_member_role_text").text(data.error_member_role);
					}	
				}
			});
		});
        $('#add_member_username').blur(function()
        {
            var username = $(this).val(); 
            $.ajax({
            url: "action.php", 
            method: "POST", 
            data: {user_name: username}, 
            dataType: "text", 
            success:function(e)
            {
                if (e == 1)
                {
                    $('#availability').html('<span class = "text-danger">Username already exists</span>'); 
                    $('#submit_add_member').attr('disabled', true);
                }
                else if (e == 2)
                {
                $('#availability').html('<span class = "text-danger">Username can not be empty</span>'); 
                    $('#submit_add_member').attr('disabled', true);
                }
                else 
                {
                $('#availability').html('<span class = "text-success">Username is available</span>'); 
                $('#submit_add_member').attr('disabled', false);
                }
            },
            error: function(e)
            {
                console.log(e);
            }
            });
        });
        $(".delete_member_button").on("click", function(e){
            var member_id = $(this).data('id');
            $("#delete_member_modal").val(member_id); 
        });
        $(".delete_member_modal").on("click", function(e){
             var member_id = $("#delete_member_modal").val(); 
             
             $.ajax({
                 url: 'action.php', 
                 method: 'POST', 
                 data: {action:"Delete_Member", member_id:member_id},
                 success: function(response)
                 {
                    $("#deleteMemberModal").modal("toggle");
                    location.reload();
                    //$("#all_members").load(location.href + " #all_members > *");
                 }
             });
        });

        
        <?php include_once 'footer.php'; ?>
	});
</script>
</html>