<?php
require_once 'db.php';
if (isset($_POST['action']) && $_POST['action'] == "Display_Task") 
{
    $task_id = $_POST['task_id'];
    $t_name = '';
    $t_description = '';
    $t_member = '';
    $t_button = ''; 
    $row = $db->get_task_details($task_id); 
    $t_name = $row[0]["t_name"]; 
    $t_description = $row[0]['t_description'];
    $t_member = $row[0]['m_name']." (".$row[0]['m_role'].")";

    if ($row[0]['status'] != "todo")
    {
        $t_button .= '<div class = "col-sm-3 ">
        <input type="button" id = "move_button" name = "move_button" data-id = '.$row[0]['t_id'].' data-status = "todo" class = "btn-success rounded-pill btn-block move_button" value ="Move to Todo">
        </div>';
    }
    if ($row[0]['status'] != "done")
    {
        $t_button .= '<div class = "col-sm-3 ">
        <input type="button" id = "move_button" name = "move_button" data-id = '.$row[0]['t_id'].' data-status = "done" class = "btn-success rounded-pill btn-block move_button" value ="Move to Done">
        </div>';
    }
    if ($row[0]['status'] != "doing")
    {
        $t_button .= '<div class = "col-sm-3 ">
        <input type="button" id = "move_button" name = "move_button" data-id = '.$row[0]['t_id'].' data-status = "doing" class =  "btn-success rounded-pill btn-block move_button" value ="Move to Doing">
        </div>';
    }
    if ($row[0]['status'] != "testing")
    {
        $t_button .= '<div class = "col-sm-3 ">
        <input type="button" id = "move_button" name = "move_button" data-id = '.$row[0]['t_id'].' data-status = "testing" class = " btn-success rounded-pill btn-block move_button" value ="Move to Testing">
        </div>';
    }
    if ($row[0]['status'] != "completed")
    {
        $t_button .= '<div class = "col-sm-3 ">
        <input type="button" id = "move_button" name = "move_button" data-id = '.$row[0]['t_id'].' data-status = "completed" class = "btn-success rounded-pill btn-block move_button" value ="Move to Completed">
        </div>';
    }
    $output = array(
        't_name' => $t_name, 
        't_description' => $t_description, 
        't_member' => $t_member,
        't_button' => $t_button
    );
    echo json_encode($output); 
} 

if (isset($_POST['action']) && $_POST['action'] == "Move_Task")
{
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];
    if ($db->update_task_status($task_id, $status))
    {
        echo "Status Updated"; 
    }    
} 

if (isset($_POST['action']) && $_POST['action'] == "Add_New_Task")
{
    $member_id = $_POST['member_id'];
    $result = $db->get_member_team($member_id);
    

}
if (isset($_POST['action']) && $_POST['action'] == "Add_Team")
{
    $t_name = ""; 
    $error = false; 
    if (empty($_POST['team_name']))
    {
        $t_name = "Team Name is Required"; 
        $error = true; 
    }
    else 
    {
        $t_name = $_POST['team_name'];
    }
    if ($error == false)
    {
        if ($db->insert_team($t_name))
        {
            $output = array(
                'success' => true
            );
        };
    }
    if ($error == true)
    {
        $output = array(
            'error' => true, 
            'error_t_name' => $t_name, 
        );
    }
    echo json_encode($output); 
} 

if (isset($_POST['action']) && $_POST['action'] == "Move_Task")
{
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];
    if ($db->update_task_status($task_id, $status))
    {
        echo "Status Updated"; 
    }    
} 

if (isset($_POST['action']) && $_POST['action'] == "Add_New_Task")
{
    $member_id = $_POST['member_id'];
    $result = $db->get_member_team($member_id);
    

}

if (isset($_POST['action']) && $_POST['action'] == "Add_Project")
{
    $t_name = ''; 
    $p_description = ''; 
    $p_team_name = '';
    $error = false; 
    if (empty($_POST['project_name']))
    {
        $t_name = "Project Name is Required"; 
        $error = true; 
    }
    else 
    {
        $t_name = $_POST['project_name'];
    }
    if (empty($_POST['project_description']))
    {
        $p_description = "Project Description is Required"; 
        $error = true; 
    }
    else 
    {
        $p_description = $_POST['project_description'];
    }
    if ($_POST['team_name'] == "NULL")
    {
        $p_team_name = "Team is Required"; 
        $error = true; 
    }
    else 
    {
        $p_team_name = $_POST['team_name'];
    }
    if ($error == false)
    {
        if ($db->insert_project($t_name, $p_description, $p_team_name))
        {
            $output = array(
                'success' => true
            );
        };
    }
    if ($error == true)
    {
        $output = array(
            'error' => true, 
            'error_p_name' => $t_name, 
            'error_p_description' => $p_description, 
            'error_p_team' => $p_team_name
        );
    }
    echo json_encode($output); 
} 

if (isset($_POST['action']) && $_POST['action'] == "Add_Task")
{
    $t_name = $_POST['task_name'];
    $t_description = $_POST['task_description']; 
    $t_member = $_POST['member_name'];
    $p_id = $_POST['task_project_id'];
    if ($db->insert_task($t_name, $t_description, $t_member, $p_id))
    {
        $output = array(
        'success' => true
        );
    }
    else 
    {
        $output = array(
            'error' => true
            );
    }
    echo json_encode($output); 
} 

if (isset($_POST['action']) && $_POST['action'] == "Delete_Member")
{
    $member_id = $_POST['member_id'];
    if ($db->delete_member($member_id))
    {
        $output = array(
        'success' => true
        );
    }
    else 
    {
        $output = array(
            'error' => true
            );
    }
    echo json_encode($output); 
}

if (isset ($_POST['user_name']))
{
  $user = $_POST['user_name'];
  if (empty($user))
  {
    echo "2";
  }
  else 
  {
      if ($db->username_check($user) > 0)
    {
      echo "1"; 
    }
    else 
    {
      echo "0";
    }
  }

}

if (isset($_POST['action']) && $_POST['action'] == "Add_Member")
{
  $member_name = $_POST['add_member_name'];
  $member_role = $_POST['add_member_role'];
  $team_id = $_POST['member_team_id'];
  $username = $_POST['add_member_username'];
  $password = $_POST['add_member_password'];  
  $error = false; 
  $error_member_role = ""; 
  if ($member_role == "NULL")
  {
      $error = true; 
      $error_member_role = "Member Role must be selected"; 
  }
  if ($error == false)
  {
      if ($db->insert_member($member_name, $username, $password, $member_role, $team_id))
        {
            $output = array(
            'success' => true
            );
        }
        else 
        {
            $output = array(
                'error' => true
                );
        }
    }
    else 
    {
        $output = array(
            'error' => true,
            'error_member_role' => $error_member_role
            );
    }
    
    echo json_encode($output); 
}


?>