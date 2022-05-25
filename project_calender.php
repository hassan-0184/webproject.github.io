<?php include 'header.php'; ?>
<?php $project_id = $_GET['page']; 
$project_details = $db->get_project_info($project_id);
?> 

<body id="page-top" onload="renderDate()">
<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
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
                                                   
                                                   <a class="nav-link" aria-current="page" href="project.php?page=<?php echo $project_details[0]['p_id'];?>">Kanban</a>
                       
                                                   <a class="nav-link active" href="project_calender.php?page=<?php echo $project_details[0]['p_id'];?>">Calender</a>
                                                 
                                                    
                                                    
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
                <div class="container-fluid">

                   
                    

                    <div class="row">
<!-- First part -->
                        <div class="col-lg-3">


    <!-- Modal -->
  




    <div class="wrapper">

        <div class="calendar">

            <div class=" month">

                <div class="prev" onclick="moveDate('prev')">
                    <span>&#10094;</span>
                </div>
                <div>
                    <h2 id="month"></h2>
                    <p id="date_str"></p>
                </div>
                <div class="next" onclick="moveDate('next')">
                    <span>&#10095;</span>
                </div>
            </div>
            <div>
               

            </div>





            <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="days">

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
    <script>
        var dt = new Date();
        function renderDate() {
            dt.setDate(1);
            var day = dt.getDay();
            var today = new Date();
            var endDate = new Date(
                dt.getFullYear(),
                dt.getMonth() + 1,
                0
            ).getDate();

            var prevDate = new Date(
                dt.getFullYear(),
                dt.getMonth(),
                0
            ).getDate();
            var months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ]
            document.getElementById("month").innerHTML = months[dt.getMonth()];
            document.getElementById("date_str").innerHTML = dt.toDateString();
            var cells = "";
            for (x = day; x > 0; x--) {
                cells += "<div class='prev_date'>" + (prevDate - x + 1) + "</div>";
            }
            console.log(day);
            for (i = 1; i <= endDate; i++) {
                if (i == today.getDate() && dt.getMonth() == today.getMonth()) cells += "<div class='today'>" + i + "</div>";
                else
                    cells += "<div>" + i + "</div>";
            }
            document.getElementsByClassName("days")[0].innerHTML = cells;

        }

        function moveDate(para) {
            if (para == "prev") {
                dt.setMonth(dt.getMonth() - 1);
            } else if (para == 'next') {
                dt.setMonth(dt.getMonth() + 1);
            }
            renderDate();
        }
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
  
    
</body>
<script> 
    $(document).ready(function(){
        <?php include_once 'footer.php'; ?>
    });
</script>
</html>