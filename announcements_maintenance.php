<?php
include 'templates/header.php';

// if( ! $user->isAdmin() )
//    redirect("index.php");
// ?>

<link rel="stylesheet" href="assets/css/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker3.min.css">

        <div class="row">
            <!-- Left nav start -->
            <?php include 'templates/leftnav.html' ?>
            <!-- Left nv end -->

          <div class="span9 users-wrapper">
              <a class="btn btn-primary" href="javascript:void(0);" 
                  onclick="users.showAddUserModal()" > 
                  <i class="icon-user icon-white glyphicon glyphicon-user"></i>
                  <?php echo ASLang::get('add_user'); ?>
              </a>
              <?php //user_role 3 => admin ?>
              <?php $users = $db->select("SELECT * FROM `as_users` WHERE `user_role` != '3' ORDER BY `register_date` DESC"); ?>
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped users-table" id="users-list" width="100%">
                  <thead>
                  <th><?php echo ASLang::get('username'); ?></th>
                  <th><?php echo ASLang::get('email'); ?></th>
                  <th><?php echo ASLang::get('register_date'); ?></th>
<!--                  <th>--><?php //echo ASLang::get('last_login'); ?><!--</th>-->
                  <th><?php echo ASLang::get('confirmed'); ?></th>
                  <th><?php echo ASLang::get('action'); ?></th>
                  </thead>
                  <?php foreach ($users as $user): ?>
                      <?php $tmpUser = new ASUser($user['user_id']); ?>
                      <?php $userRole = $tmpUser->getRole(); ?>
                      <tr class="user-row">
                          <td><?php echo e($user['username']); ?></td>
                          <td><?php echo e($user['email']); ?></td>
                          <td><?php echo $user['register_date']; ?></td>
<!--                          <td>--><?php //echo $user['last_login']; ?><!--</td>-->
                          <td>
                              <?php echo $user['confirmed'] == "Y"
                                  ? "<p class='text-success'>" . ASLang::get('yes') . "</p>"
                                  : "<p class='text-error'>" . ASLang::get('no') . "</p>"
                              ?>
                          </td>
                          <td>
                              <div class="btn-group">
                                  <a  class="btn <?php echo $user['banned'] == 'Y' ? 'btn-danger' : 'btn-primary'; ?> btn-user"
                                      href="javascript:void(0);"
                                      onclick="users.roleChanger(this,<?php echo $user['user_id'];  ?>);">

                                      <i class="icon-user icon-white glyphicon glyphicon-user"></i>
                                      <span class="user-role"><?php echo ucfirst($userRole); ?></span>
                                  </a>
                                  <a class="btn <?php echo $user['banned'] == 'Y' ? 'btn-danger' : 'btn-primary'; ?> dropdown-toggle" data-toggle="dropdown" href="#">
                                      <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                      <li>
                                          <a href="javascript:void(0);"
                                             onclick="users.editUser(<?php echo $user['user_id']; ?>);">
                                              <i class="icon-edit glyphicon glyphicon-edit"></i>
                                              <?php echo ASLang::get('edit'); ?>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:void(0);"
                                             onclick="users.displayInfo(<?php echo $user['user_id']; ?>);">
                                              <i class="icon-pencil glyphicon glyphicon-pencil"></i>
                                              <?php echo ASLang::get('details'); ?>
                                          </a>
                                      </li>

                                      <?php if ( $user['banned'] == 'Y' ): ?>
                                          <li>
                                              <a href="javascript:void(0);"
                                                 onclick="users.unbanUser(this,<?php echo $user['user_id'];  ?>);">
                                                  <i class="icon-ban-circle glyphicon glyphicon-ban-circle"></i>
                                                  <span><?php echo ASLang::get('unban'); ?></span>
                                              </a>
                                          </li>
                                      <?php else: ?>
                                          <li>
                                              <a href="javascript:void(0);"
                                                 onclick="users.banUser(this,<?php echo $user['user_id'];  ?>);">
                                                  <i class="icon-ban-circle glyphicon glyphicon-ban-circle"></i>
                                                  <span><?php echo ASLang::get('ban'); ?></span>
                                              </a>
                                          </li>
                                      <?php endif; ?>

                                      <li>
                                          <a href="javascript:void(0);"
                                             onclick="users.deleteUser(this,<?php echo $user['user_id'];  ?>);">
                                              <i class="icon-trash glyphicon glyphicon-trash"></i>
                                              <?php echo ASLang::get('delete'); ?>
                                          </a>
                                      </li>

                                      <li class="divider"></li>

                                      <li>
                                          <a href="javascript:void(0);"
                                             onclick="users.roleChanger(this,<?php echo $user['user_id'];  ?>);">
                                              <i class="i"></i> <?php echo ASLang::get('change_role'); ?></a>
                                      </li>
                                  </ul>
                              </div>
                          </td>
                      </tr>
                  <?php endforeach; ?>
              </table>
          </div>
        </div>
    
    <?php include 'templates/footer.php'; ?>
        
        <div class="modal" id="modal-user-details" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="modal-username">
                    <?php echo ASLang::get('loading'); ?>
                  </h4>
                </div>
                <div class="modal-body" id="details-body">
                  <dl class="dl-horizontal">
                    <dt title="<?php echo ASLang::get('email'); ?>"><?php echo ASLang::get('email'); ?></dt>
                    <dd id="modal-email"></dd>
                    <dt title="<?php echo ASLang::get('first_name'); ?>"><?php echo ASLang::get('first_name'); ?></dt>
                    <dd id="modal-first-name"></dd>
                    <dt title="<?php echo ASLang::get('last_name'); ?>"><?php echo ASLang::get('last_name'); ?></dt>
                    <dd id="modal-last-name"></dd>
                    <dt title="<?php echo ASLang::get('address'); ?>"><?php echo ASLang::get('address'); ?></dt>
                    <dd id="modal-address"></dd>
                    <dt title="<?php echo ASLang::get('phone'); ?>"><?php echo ASLang::get('phone'); ?></dt>
                    <dd id="modal-phone"></dd>
                    <dt title="<?php echo ASLang::get('last_login'); ?>"><?php echo ASLang::get('last_login'); ?></dt>
                    <dd id="modal-last-login"></dd>
                  </dl>
                </div>
                  <div align="center" id="ajax-loading"><img src="assets/img/ajax_loader.gif" /></div>
                <div class="modal-footer">
                  <a href="javascript:void(0);" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                    <?php echo ASLang::get('ok'); ?>
                  </a>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

           <div class="modal <?php echo BOOTSTRAP_VERSION == 2 ? "hide" : "fade" ?>" id="modal-change-role">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="modal-username">
                    <?php echo ASLang::get('pick_user_role'); ?>
                  </h4>
                </div>
                <div class="modal-body" id="details-body">
                    <?php $roles = $db->select("SELECT * FROM `as_user_roles` WHERE `role_id` <> '3'"); ?>
                    <?php if(count($roles) > 0): ?>
                      <p><?php echo ASLang::get('select_role'); ?>:</p>
                      <select id="select-user-role" class="form-control" style="width: 100%;">
                      <?php foreach($roles as $role): ?>
                          <option value="<?php echo $role['role_id']; ?>">
                            <?php echo e(ucfirst($role['role'])); ?>
                          </option>
                      <?php endforeach; ?>
                      </select>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                  <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                    <?php echo ASLang::get('cancel'); ?>
                  </a>
                  <a href="javascript:void(0);" class="btn btn-primary" id="change-role-button" data-dismiss="modal" aria-hidden="true">
                      <?php echo ASLang::get('ok'); ?>
                  </a>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->



          <div class="modal" id="modal-add-edit-user" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="modal-annoucement-title">
                    Add Annoucement
                  </h4>
                </div>
                <div class="modal-body" id="details-body">
                    <form class="form-horizontal" id="add-announcement-form">
                      <input type="hidden" id="addannouncement-title" />
                      <div class="control-group form-group">
                        <label class="control-label col-lg-3" for="addannouncement-title">
                          Title
                        </label>
                        <div class="controls col-lg-9">
                          <input id="addannouncement-title" name="addannouncement-title" type="text" class="input-xlarge form-control" >
                        </div>
                      </div>
                      <div class="control-group form-group">
                        <label class="control-label col-lg-3" for="addannouncement-content">
                          Content
                        </label>
                        <div class="controls col-lg-9">
                            <textarea name="addannouncement-content" id="addannouncement-content" rows="10" cols="60" class="form-control">Announcement content here.</textarea>
                        </div>
                      </div>
                        <hr>
                      <div class="control-group form-group">
                        <label class="control-label col-lg-3" for="addanouncement-effective-date">
                          Effective date
                        </label>
                        <div class="controls col-lg-9">
                            <div class="input-prepend">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" />
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" />
                                </div>
                            </div>
                            <!--<p class="help-block">help</p>-->
                        </div>
                      </div>
                  </form>
                </div>
                <div align="center" class="ajax-loading"><img src="assets/img/ajax_loader.gif" /></div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                      <?php echo ASLang::get('cancel'); ?>
                    </a>
                    <a href="javascript:void(0);" id="btn-add-user" class="btn btn-primary">
                      <?php echo ASLang::get('add'); ?>
                    </a>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

        
        
        <script type="text/javascript" src="assets/js/sha512.js"></script>
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
        <script src="assets/js/bootstrap-datepicker.min.js"></script>
        <?php if(BOOTSTRAP_VERSION == 2): ?>
            <script type="text/javascript" src="assets/js/dataTables.bootstrap2.js"></script>
        <?php else: ?>
            <script type="text/javascript" src="assets/js/dataTables.bootstrap3.js"></script>
        <?php endif; ?>
        <script src="ASLibrary/js/asengine.js" type="text/javascript" charset="utf-8"></script>
        <script src="ASLibrary/js/users.js" type="text/javascript" charset="utf-8"></script>
        <script src="ASLibrary/js/index.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#users-list').dataTable();
            $('.input-daterange').datepicker({
                clearBtn: true,
                autoclose: true,
                todayHighlight: true
            });
        } );
    </script>
  </body>
</html>