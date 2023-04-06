<?php
include("config.php");

include("header.php");
?>
    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Students</h2>
      </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-12">
                <div class="block">
                  <div class="title">
                  	<button type="button" data-toggle="modal" data-target="#addstaff" class="btn btn-primary">Add Student Data </button>
                  	<div id="addstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Add Student</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <form action="process.php" autocomplete="off" method="post">
                              <div class="form-group">
                                <label>Matric No</label>
                                <input type="text" name="matricno" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department">
                                  <?=departmentlist()?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Age</label>
                                <input type="number" name="age" class="form-control">
                              </div>
                              <div class="form-group">       
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                  <option>Male</option>
                                  <option>Female</option>
                                </select>
                              </div>
                              <div class="form-group">       
                                <label>Attendance Rating (1-100)</label>
                                <input type="number" name="attendancerating" required min="1" max="100" class="form-control">
                              </div>
                              <div class="form-group">       
                                <label>Studytime Rating (1-100)</label>
                                <input type="number" name="studytimerating" required min="1" max="100" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Year Admitted</label>
                                <input type="text" name="yearadmitted" class="form-control">
                              </div>
                              <div class="form-group">       
                                <input type="submit" name="addstudent" value="Submit" class="btn btn-primary">
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
                        <tr>
                          <th>Matric No</th>
                          <th>Department</th>
                          <th>Gender</th>
                          <th>Year Admitted</th>
                          <th>Attendance</th>
                          <th>Studytime</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $getstudent = $conn->query("SELECT * FROM studentdata");
                      while($student = $getstudent->fetch_assoc()){
                        ?>
                        <tr>
                          <td><?=$student['matricno']?></td>
                          <td><?=$student['department']?></td>
                          <td><?=$student['gender']?></td>
                          <td><?=$student['yearadmitted']?></td>
                          <td><?=$student['attendance']?></td>
                          <td><?=$student['studytime']?></td>
                          <td>
                             <button type="button" data-toggle="modal" data-target="#editstudent<?=$student['stud_id']?>" class="btn btn-primary">Edit </button>
                            <div id="editstudent<?=$student['stud_id']?>" class="modal fade text-left">
                              <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Edit Student Matric No <?=$student['matricno']?></strong>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Please ensure all details are accurate</p>
                                    <form action="process.php" autocomplete="off" method="post">
                                      <div class="form-group">
                                        <label>Matric No</label>
                                        <input type="text" name="ematricno" value="<?=$student['matricno']?>" class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control" name="edepartment">
                                          <option><?=$student['department']?></option>
                                          <?=departmentlist()?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label>Age</label>
                                        <input type="number" value="<?=$student['age']?>" name="eage" class="form-control">
                                      </div>
                                      <div class="form-group">       
                                        <label>Gender</label>
                                        <select class="form-control" name="egender">
                                          <option><?=$student['gender']?></option>
                                          <option>Male</option>
                                          <option>Female</option>
                                        </select>
                                      </div>
                                      <div class="form-group">       
                                        <label>Attendance Rating (1-100)</label>
                                        <input type="number" name="eattendancerating" value="<?=$student['attendance']?>" required min="1" max="100" class="form-control">
                                      </div>
                                      <div class="form-group">       
                                        <label>Studytime Rating (1-100)</label>
                                        <input type="number" name="estudytimerating" value="<?=$student['studytime']?>" required min="1" max="100" class="form-control">
                                      </div>
                                      <div class="form-group">
                                        <label>Year Admitted</label>
                                        <input type="text" name="eyearadmitted" class="form-control" value="<?=$student['yearadmitted']?>">
                                      </div>
                                      <div class="form-group">
                                      <input type="hidden" name="studid" value="<?=$student['stud_id']?>">     
                                        <input type="submit" name="editstudent" value="Save Changes " class="btn btn-primary">
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
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
