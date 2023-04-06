<?php
include("config.php");

include("header.php");
?>
    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Predictions</h2>
      </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-12">
                <div class="block">
                  <div class="title">
                  	<a href="home.php" class="btn btn-primary">Add</a>
                  </div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Matric No</th>
                          <th>Course</th>
                          <th>Attendance</th>
                          <th>Studytime</th>
                          <th>Score</th>
                          <th>Grade</th>
                          <th>Staff</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $getdata = $conn->query("SELECT * FROM predictions");
                      while($data = $getdata->fetch_assoc()){
                        ?>
                        <tr>
                          <td><?=$data['matricno']?></td>
                          <td><?=getcourseinfo($data['courseid'])?></td>
                          <td><?=$data['attendance']?></td>
                          <td><?=$data['studytime']?></td>
                          <td><?=$data['score']?></td>
                          <td><?=getgrade($data['score'])?></td>
                          <td><?=$data['staff']?></td>
                        </tr>
                        <?php
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </section>

    
<?php 
include("footer.php");
?>
