<?php
include("config.php");

include("header.php");
?>

    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Dashboard</h2>
      </div>
    </div>

    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-user-1"></i></div><strong>Students</strong>
                </div>

                <div class="number dashtext-1"><?=getdatarow('studentdata')?></div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-contract"></i></div><strong>Courses</strong>
                </div>
                <div class="number dashtext-2"><?=getdatarow('courses')?></div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Data Sets</strong>
                </div>
                <div class="number dashtext-3"><?=getdatarow('coursestaken')?></div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
              <div class="progress-details d-flex align-items-end justify-content-between">
                <div class="title">
                  <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Staffs</strong>
                </div>
                <div class="number dashtext-4"><?=getdatarow('users')?></div>
              </div>
              <div class="progress progress-template">
                <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
              </div>
            </div>
          </div>
        </div>

        <?php
        if($_SESSION['role'] === "staff"){
          ?>
          <div class="row">
            <div class="col-lg-8">
              <div class="block">
                <div class="title"><strong>Make A Prediction</strong></div>
                  <div class="block-body">
                    <?php
                    if(isset($_GET['result'])){
                      ?>
                      <form class="col-lg-12" action="process.php" method="post">
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Matric Number</label>
                          <div class="col-sm-9">
                            <input type="text" readonly value="<?=$_GET['result']?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Course</label>
                          <div class="col-sm-9">
                            <input type="text" readonly value="<?=getcourseinfo($_GET['course'])?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Predicted Attendance</label>
                          <div class="col-sm-9">
                            <input type="text" name="avgatt" readonly value="<?=$_GET['avgatt']?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Predicted Studytime</label>
                          <div class="col-sm-9">
                            <input type="text" name="avgstu" readonly value="<?=$_GET['avgstu']?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Predicted Score</label>
                          <div class="col-sm-9">
                            <input type="text" name="prescore" readonly value="<?=$_GET['score']?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <input type="hidden" name="student" value="<?=$_GET['result']?>">
                          <input type="hidden" name="courseid" value="<?=$_GET['course']?>">
                          <input type="hidden" name="staff" value="<?=$_GET['staff']?>">
                          <button type="submit" name="saveprediction" class="btn btn-primary btn-block">Save Prediction</button>
                        </div>
                      </form>
                      <?php
                    }elseif(isset($_GET['matricno'])){
                      // get courses only from student department
                      $getstudinfo = $conn->query("SELECT * FROM studentdata WHERE matricno = '".$_GET['matricno']."' ");
                      if($getstudinfo->num_rows > 0){
                        $studinfo = $getstudinfo->fetch_assoc();
                        ?>
                        <form class="col-lg-12" action="process.php" method="post">
                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Course</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="course">
                                <?php 
                                $gtc = $conn->query("SELECT * FROM courses WHERE department = '".$studinfo['department']."' ");
                                while($c = $gtc->fetch_assoc()){
                                  ?><option value="<?=$c['courseid']?>"><?=$c['coursecode']?> - <?=$c['coursetitle']?></option><?php
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <input type="hidden" name="matric" value="<?=$_GET['matricno']?>">
                            <input type="hidden" name="staff" value="<?=$_SESSION['user']?>">
                            <button type="submit" name="predictscore" class="btn btn-primary btn-block">Predict</button>
                          </div>
                        </form>
                        <?php
                      }else{
                        echo '<h3>Enter A Valid Student Matric Number. <a href="home.php">Try Again</a></h3>';
                      }
                    }else{
                      ?>
                      <form class="col-lg-12" action="" method="get">
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Enter Matric Number</label>
                          <div class="col-sm-9">
                            <select name="matricno" class="form-control">
                              <?=getstudentlist()?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <button type="submit" class="btn btn-primary btn-block">Start</button>
                        </div>
                      </form>
                      <?php 
                    }
                    ?>
                  </div>
              </div>
            </div>
            <div class="col-lg-4">
              <?php
              if(isset($_GET['success'])){
                echo '<h4>Prediction Successful. <a href="predictions.php">View here</a></h4>';
              }
              if(isset($_GET['scoreexist'])){
                echo '<h4>Score already exist for this student on this course. Choose another course</h4>';
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>


      </div>
    </section>

   
<?php 
include("footer.php");
?>
