<?php
include("config.php");

include("header.php");
?>
    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Data Sets</h2>
      </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-12">
                <div class="block">
                  <div class="title">
                  	<button type="button" data-toggle="modal" data-target="#adddata" class="btn btn-primary">Add</button>
                  	<div id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Add Data Set</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <form action="process.php" autocomplete="off" method="post">
                              <div class="form-group">
                                <label>Course</label>
                                <select class="form-control" name="course">
                                  <?=getcourselist()?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Matric No</label>
                                <input type="text" name="matricno" class="form-control">
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
                                <label>Total Score</label>
                                <input type="text" name="score" required min="0" max="100" class="form-control">
                              </div>
                              <div class="form-group">       
                                <input type="submit" name="adddataset" value="Submit" class="btn btn-primary">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                  	</div>
                    <button type="button" data-toggle="modal" data-target="#uploaddata" class="btn btn-primary">Upload</button>
                    <div id="uploaddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Upload Data Set</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <form action="process.php" autocomplete="off" method="post" enctype="multipart/form-data">                           
                              <p>
                                <ul>
                                  <li>Course ID</li>
                                  <li>matricno</li>
                                  <li>attendance</li>
                                  <li>studytime</li>
                                  <li>total score</li>
                                </ul>
                              </p>
                              <div class="form-group">
                                <label>CSV File</label>
                                <input type="text" name="csv" required min="0" max="100" class="form-control">
                              </div>
                              <div class="form-group">       
                                <input type="submit" name="uploaddataset" value="Submit" class="btn btn-primary">
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
                          <th>Course</th>
                          <th>Score</th>
                          <th>Grade</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $getdata = $conn->query("SELECT * FROM coursestaken");
                      while($data = $getdata->fetch_assoc()){
                        ?>
                        <tr>
                          <td><?=$data['matricno']?></td>
                          <td><?=getcourseinfo($data['courseid'])?></td>
                          <td><?=$data['score']?></td>
                          <td><?=getgrade($data['score'])?></td>
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
