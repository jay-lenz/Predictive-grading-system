<?php
include("config.php");

include("header.php");
?>


    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Courses</h2>
      </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-12">
                <div class="block">
                  <div class="title">
                    <button type="button" data-toggle="modal" data-target="#addcourse" class="btn btn-primary">Add Course </button>
                   <div id="addcourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Add Course</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <form action="process.php" method="post" autocomplete="off">
                              <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department">
                                  <?=departmentlist()?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Course Code</label>
                                <input type="text" name="coursecode" required class="form-control">
                              </div>
                              <div class="form-group">       
                                <label>Course Title</label>
                                <input type="text" name="coursetitle" required class="form-control">
                              </div>
                              <div class="form-group">       
                                <label>Course Units</label>
                                <input type="number" min="0" max="6" required name="courseunit" class="form-control">
                              </div>
                              <div class="form-group">       
                                <label>Attendance Requirements (1-100)</label>
                                <input type="number" name="attendancemerit" required min="1" max="100" class="form-control">
                              </div>
                              <div class="form-group">       
                                <label>Studytime Requirements (1-100)</label>
                                <input type="number" name="studytimemerit" required min="1" max="100" class="form-control">
                              </div>
                              <div class="form-group">       
                                <input type="submit" name="addcourse" value="Submit" class="btn btn-primary">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive"> 
                    <table class="table table-hover table-sm">
                      <thead>
                          <th>Code</th>
                          <th>Title</th>
                          <th>Units</th>
                          <th>Department</th>
                      </thead>
                      <tbody>
                      <?php
                      $getcourses = $conn->query("SELECT * FROM courses");
                      while($course = $getcourses->fetch_assoc()){
                        ?>
                        <tr>
                          <td><?=$course['coursecode']?></td>
                          <td><?=$course['coursetitle']?></td>
                          <td><?=$course['courseunits']?></td>
                          <td><?=$course['department']?></td>
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
