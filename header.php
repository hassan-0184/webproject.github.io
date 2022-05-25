<?php include_once "db.php"; 
session_start(); 

if (!isset($_SESSION['member_id']))
  header('location:login.php');
$id = $_SESSION['member_id'];
?>

<?php 
        $member_info = $db->get_member_info($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kanban</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                    
                </div>
                <div class="sidebar-brand-text mx-2">
                   <?php echo $member_info['0']['m_role']; ?>
                </div>
                
            </a>
            <div class="sidebar-heading mt-3 "> 
              
              
              
                <div class=" sidebar-heading "  id = "completed_open_tasks">
                  
                  <?php $total = $db->count_tasks_per_member($member_info[0]['m_id'], "Not"); ?>
                  <span class="fonts_txt">Completed Tasks <span class="ml-2 fonts_num text-white"><?php echo $total; ?></span>    </span>
                  <?php $total = $db->count_tasks_per_member($member_info[0]['m_id'], "NULL"); ?>
                  <span class="fonts_txt">Open Tasks <span class="ml-2 fonts_num text-white"><?php echo $total; ?></span>    </span>
              </div>
  
  
              </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Projects
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
        
            <div id = "project_names">
              <?php
              $total_projects = $db->count_total_projects($id);
              if ($total_projects > 0)
              {
                $projects_names = $db->get_all_projects($id); 
                foreach($projects_names as $row)
                {
                  ?>
                  <li class="nav-item">
                  <a class="nav-link" href="project_backlog.php?page=<?php echo $row['p_id']; ?>">
                  
                      <span><?php echo $row['p_name']; ?></span></a>
                  </li>
                  <?php 
                }
              }
              ?>
              
            </div>

            

          
            <!-- Nav Item - Utilities Collapse Menu -->
            <?php if ($member_info[0]['m_role'] == 'Team Lead')
            {?><button type="button" class="btn btn-sm btn-outline-warning text-left ml-2" id = "add_task" data-toggle="modal" data-target="#add_project_modal">
                + Add New Project
            </button>
            <?php }?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                TEAMS
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
           

            <!-- Nav Item - Charts -->
            <div id = "team_names">
              <?php
              $total_teams = $db->count_total_teams();
              if ($total_teams > 0)
              {
                $team_name = $db->get_all_teams(); 
                foreach($team_name as $row)
                {
                  ?>
                  <li class="nav-item">
                  <a class="nav-link" href="team.php?page=<?php echo $row['team_id']; ?>">
                      <span><?php echo $row['t_name']; ?></span></a>
                  </li>
                  <?php 
                }
              }
              ?>
              
            </div>
            <?php if ($member_info[0]['m_role'] == 'Team Lead')
            {?>
            <button type="button" class="btn btn-sm btn-outline-warning text-left ml-2 click_team" id = "add_task" data-toggle="modal" data-target="#add_team_modal">
                + Add a Team
            </button><?php }?>

<!-- Modal - Add Project -->
<div class="modal fade" id="add_project_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add a New Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form action="javascript:void(0);" class = "form" id = "add-project-form" method = "POST">
                  <div class = "row form-group">
                    <div class = "col-12 form-group">
                      <label for="project_name">Project Name</label>
                      <input type="text" id = "add_project_name" name = "add_project_name" placeholder = "Title of the Project" value="" class="form-control">
                      <span id = "error_p_name" class = "text-danger"></span>
                    </div>
                  </div>
                  <div class = "row form-group">
                    <div class = "col-12 form-group">
                      <label for="project_description">Project Description</label>
                      <input type="text" id = "add_project_description" name = "add_project_description" placeholder = "e.g. What the project is about?" value="" class="form-control">
                      <span id = "error_p_description" class = "text-danger"></span>
                    </div>
                  </div>
                  <div class = "row form-group">
                    <div class = "col-12 form-group">
                       <label for="project_team">Team</label>
                        <select name="project_team_name" id="project_team_name" class = "float-left js-example-basic-single form-control w-100" style="margin-bottom: 10px">
                        <option value="NULL">Select</option>
                         <?php $teams = $db->get_all_teams(); ?>
                          <?php foreach ($teams as $team){ ?>
                          <option value="<?php echo $team['team_id']; ?>" ><?php echo $team['t_name'];  ?></option>
                          <?php } ?>
                    </select>
                     <span id = "error_p_team" class = "text-danger"></span>
                    </div>
                  </div>
                  <input type="submit" id = "add_project_submit" name = "add_project_submit" class = "w-100 btn btn-success btn-lg btn-block" value ="Add Project">
                  
  
  
                </form> <!-- Form end -->
        </div>
      </div>
    </div>
  </div>
  
  
<!-- Modal - Add Team -->
<div class="modal fade" id="add_team_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add a New Team</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form action="javascript:void(0);" class = "form" id = "add-team-form" method = "POST">
                  <div class = "row form-group">
                    <div class = "col-12 form-group">
                      <label for="name">Team Name</label>
                      <input type="text" id = "add_team_name" name = "add_team_name" placeholder = "e.g. Designers or Backend" value="" class="form-control">
                      <span id = "error_t_team" class = "text-danger"></span>
                    </div>
                  </div>
                  <input type="submit" id = "add_team_submit" name = "add_team_submit" class = "w-100 btn btn-success btn-lg btn-block" value ="Add Team">
  
                  <div id = "success-msg" class="w-75" style = "margin-bottom: 30px;">
                  </div>
                  
  
  
                </form> <!-- Form end -->
        </div>
      </div>
    </div>
  </div>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->



