<?php 
include 'templates/header.php';

 if(!$user->isAdmin())
    redirect("index.php");
 ?>

        <div class="row">
            <!-- Left nav start -->
            <?php include 'templates/leftnav.html' ?>
            <!-- Left nv end -->

              <div class="span9">
              		<div class="control-group roles-input">
              			<div class="controls col-lg-3">
          					  <input type="text" class="form-control col-lg-3" id='role-name' placeholder="<?php echo ASLang::get('role_name'); ?>">
          					</div>
                    <button type="submit" class="btn btn-success" onclick="roles.addRole();">
                      <?php echo ASLang::get('add'); ?>
                    </button>
          		</div>
				<?php $roles = $db->select("SELECT * FROM `as_user_roles` WHERE `role_id` NOT IN (1,2,3)"); ?>
              <table class="table table-striped roles-table">
                  <thead>
                      <th><?php echo ASLang::get('role_name'); ?></th>
                      <th><?php echo ASLang::get('users_with_role'); ?></th>
                      <th><?php echo ASLang::get('action'); ?></th>
                  </thead>
              <?php foreach ($roles as $role): ?>
                  <?php $result = $db->select("SELECT COUNT(*) AS num FROM `as_users` WHERE `user_role` = :r", array( "r" => $role['role_id'])); ?>
                  <?php $usersWithThisRole = $result[0]['num']; ?>
                  <tr class="role-row">
                  	<td><?php echo e($role['role']); ?></td>
                  	<td><?php echo e($usersWithThisRole); ?></td>
                  	<td>
                  		<button type="button" class="btn btn-danger btn-sm" onclick="roles.deleteRole(this,<?php echo $role['role_id']; ?>);">
                  			<i class="icon-trash glyphicon glyphicon-trash"></i>
                            <?php echo ASLang::get('delete'); ?>
                  		</button>
                  	</td>
                  	
                  </tr>
              <?php endforeach; ?>
              </table>
          </div>

        </div>
    
    <?php include 'templates/footer.php'; ?>

    <script type="text/javascript" src="ASLibrary/js/asengine.js"></script>
    <script type="text/javascript" src="ASLibrary/js/roles.js"></script>
    <script type="text/javascript" src="ASLibrary/js/index.js"></script>
   	</body>
 </html>