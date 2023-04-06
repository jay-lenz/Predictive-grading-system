<?php
include("config.php");

include("header.php");
?>

    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Staffs</h2>
      </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-12">
                <div class="block">
                  <div class="title">
                  	<button type="button" data-toggle="modal" data-target="#addstaff" class="btn btn-primary">Add Staff </button>
                  	<div id="addstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Add Staff</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <p>Please ensure all details are accurate</p>
                            <form action="process.php" method="post" autocomplete="off">
                              <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" name="sfullname" class="form-control">
                              </div>
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="susername" class="form-control">
                              </div>
                              <div class="form-group">       
                                <label>Password</label>
                                <input type="password" name="spassword" class="form-control">
                              </div>
                              <div class="form-group">
                              	<label><input type="checkbox" name="sstatus"> Active</label>
                              </div>
                              <div class="form-group">       
                                <input type="submit" name="addstaff" value="Submit" class="btn btn-primary">
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
                          <th>username</th>
                          <th>fullName</th>
                          <th>status</th>
                          <th>Action</th>
                      </thead>
                      <tbody>
                      <?php 
                      $getstaff = $conn->query("SELECT * FROM users WHERE role = 'staff' ");
                      while($staff = $getstaff->fetch_assoc()){
                        ?>
                        <tr>
                          <td><?=$staff['username']?></td>
                          <td><?=$staff['fullname']?></td>
                          <td><?=$staff['status']?></td>
                          <td>
                            <button type="button" data-toggle="modal" data-target="#editstaff<?=$staff['userid']?>" class="btn btn-primary">Edit </button>
                            <div id="editstaff<?=$staff['userid']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                              <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Edit Staff ID <?=$staff['userid']?></strong>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Please ensure all details are accurate</p>
                                    <form action="process.php" method="post" autocomplete="off">
                                      <div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" name="efullname" class="form-control" value="<?=$staff['fullname']?>">
                                      </div>
                                      <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="eusername" class="form-control" value="<?=$staff['username']?>">
                                      </div>
                                      <div class="form-group">
                                        <label><input type="checkbox" name="sstatus" <?php if($staff['status'] == 'active'){echo 'checked';} ?>> Active</label>
                                        <label><input type="checkbox" name="resetpass" > Reset Password to 1234?</label>
                                      </div>
                                      <div class="form-group">  
                                        <input type="hidden" name="userid" value="<?=$staff['userid']?>">     
                                        <input type="submit" name="editstaff" value="Submit" class="btn btn-primary">
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
