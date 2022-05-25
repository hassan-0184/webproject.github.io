<?php
  class Database
  {
    private $dsn = "mysql:host=localhost;dbname=website";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function __construct()
    {
      try
      {
        $this->conn = new PDO($this->dsn, $this->user, $this->pass);
      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
    }
    public function check_member_login($id)
    {
      $data = array();
      $sql = "Select * from tbl_member where m_username = :id";
      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function get_member_info($id)
    {
      $data = array();
      $sql = "Select * from tbl_member m where m.m_id = :id";

      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function get_project_info($id)
    {
      $data = array();
      $sql = "Select * from tbl_project p where p.p_id = :id";

      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function get_team_info($id)
    {
      $data = array();
      $sql = "Select * from tbl_team p where p.team_id = :id";

      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function count_total_projects($id)
    {
      $data = array();
      $sql = "select count(*) as 'total_projects' from tbl_project p where p.team_id = (select m.team_id from tbl_member m where m.m_id = :id)";

      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $data = $result["total_projects"];
      return $data;  
    }
    public function get_all_projects($id)
    {
      $data = array();
      $sql = "select p.* from tbl_project p where p.team_id = (select m.team_id from tbl_member m where m.m_id = :id)";
      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }

    public function count_total_teams()
    {
      $data = array();
      $sql = "select count(*) as 'total_teams' from tbl_team;";

      $stmt = $this->conn->prepare($sql); 
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $data = $result["total_teams"];
      return $data;  
    }
    public function count_total_members($team_id)
    {
      $data = array();
      $sql = "select count(*) as 'total_members' from tbl_member where team_id = :team_id;";

      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['team_id'=>$team_id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $data = $result["total_members"];
      return $data;  
    }
    public function count_all_tasks($id, $status)
    {
      $data = array();
      if ($status != "NULL")
      {
        $sql = "select count(*) as 'total_tasks' from tbl_task t where t.project_id = (select p.p_id from tbl_project p where p.p_id = :id) and t.status = :status;";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(['id'=>$id, 'status'=>$status]);
      }
      else 
      {
        $sql = "select count(*) as 'total_tasks' from tbl_task t where t.project_id = (select p.p_id from tbl_project p where p.p_id = :id);";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(['id'=>$id]);
      }
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $data = $result["total_tasks"];
      return $data;  
    }
    public function get_all_tasks($id, $status)
    {
      $data = array();
      if ($status != "NULL")
      {
        $sql = "select t.*, m.m_name, m.m_role from tbl_task t inner join tbl_member m on t.member_id = m.m_id where t.project_id = :id and t.status = :status order by last_update desc;";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(['id'=>$id, 'status'=>$status]);
      }
      else 
      {
        $sql = "select t.*, m.m_name, m.m_role from tbl_task t inner join tbl_member m on t.member_id = m.m_id where t.project_id = :id order by last_update desc;";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(['id'=>$id]);
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function get_all_tasks_by_member($id)
    {
      $data = array();
      $sql = "select m.*,(select count(t_id)from tbl_task t where t.member_id=m.m_id)  as 'Tasks' 
      from tbl_member m 
      where m.team_id=:id";
      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function get_task_details($id)
    {
      $data = array();
      $sql = "select t.*, m.m_name, m.m_role from tbl_task t inner join tbl_member m on t.member_id = m.m_id where t.t_id = :id";
      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function update_task_status($id, $status)
    {
      $sql = "update tbl_task t set t.status = :status, t.last_update = CURRENT_TIMESTAMP() where t.t_id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute (['id'=>$id, 'status'=>$status]);
      return true; 
    }
    public function get_member_team($id)
    {
      $data = array();
      $sql = "select t.t_name from tbl_team t inner join tbl_member m on t.team_id = m.m_id where m.m_id = :id";

      $stmt = $this->conn->prepare($sql); 
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function get_all_team_leads()
    {
      $sql = "select * from tbl_member m where m.m_role = 'Team Lead'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      return $result;
    }

    public function insert_team($team_name)
    {
       $sql = "insert into tbl_team (t_name) values (:team_name)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['team_name'=>$team_name]);
      return true; 
    }

    public function insert_project($project_name, $project_description, $team_id)
    {
       $sql = "insert into tbl_project (p_name, p_about, team_id) values (:project_name, :project_description, :team_id)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['project_name'=>$project_name, 'project_description'=>$project_description, 'team_id'=>$team_id]);
      return true; 
    }

    public function get_project_team_name($project_id)
    {
      $sql = "select t.t_name from tbl_team t where t.team_id = (select p.team_id from tbl_project p where p.p_id = :project_id);";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['project_id'=>$project_id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      return $result;
    }
    public function get_all_teams()
    {
      $data = array();
      $sql = "select * from tbl_team t";
      $stmt = $this->conn->prepare($sql); 
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function get_all_members($project_id)
    {
      $sql = "select * from tbl_member m where m.team_id = (select p.team_id from tbl_project p where p.p_id = :project_id)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['project_id'=>$project_id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    public function insert_task($task_name, $task_description, $member_id, $project_id)
    {
       $sql = "insert into tbl_task (t_name, t_description, project_id, member_id, status, last_update) values (:task_name, :task_description, :project_id, :member_id, 'todo', CURRENT_TIMESTAMP())";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['task_name'=>$task_name, 'task_description'=>$task_description, 'member_id'=>$member_id, 'project_id'=>$project_id]);
      return true; 
    }
    public function insert_member($m_name, $m_username, $m_password, $m_role, $team_id)
    {
       $sql = "insert into tbl_member (m_name, m_username, m_password, m_role, team_id) values (:m_name, :m_username, :m_password, :m_role, :team_id)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['m_name'=>$m_name, 'm_username'=>$m_username, 'm_password'=>$m_password, 'm_role'=>$m_role, 'team_id'=>$team_id]);
      return true; 
    }
    public function username_check($user)
    {
      $sql = "SELECT * from tbl_member where m_username = :user";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['user'=>$user]);
      $t_rows = $stmt->rowCount();
      return $t_rows;
    }
    public function delete_member($member_id)
    {
       $sql = "delete from tbl_member where m_id = :member_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['member_id'=>$member_id]);
      return true; 
    }
    public function count_tasks_per_member($member_id, $check)
    {
      $data = array();
      if ($check == "NULL")
      {
        $sql = "select count(member_id) 'total_tasks' from tbl_task where member_id = :member_id and status <> 'completed';";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(['member_id'=>$member_id]);
      }
      else
      {
        $sql = "select count(member_id) 'total_tasks' from tbl_task where member_id = :member_id and status = 'completed';";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(['member_id'=>$member_id]);
      }
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $data = $result["total_tasks"];
      return $data;  
    }

  }
  

$db = new Database(); 

?>