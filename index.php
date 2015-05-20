<?php include 'templates/header.php'; ?>
        
<!-- Left nav
================================================== -->
<div class="row">
    <!-- Left nav start -->
    <?php include 'templates/leftnav.html' ?>
    <!-- Left nv end -->

  <div class="span9">

        <div class="comments">
                <h3 id="comments-title">
                  <?php echo ASLang::get('comments_wall'); ?>
                  <small><?php echo ASLang::get('last_7_posts'); ?></small>
                </h3>
                <div class="comments-comments">
                    <?php $ASComment = new ASComment(); ?>
                    <?php $comments = $ASComment->getComments(); ?>
                    <?php foreach($comments as $comment): ?>
                     <blockquote>
                        <p><?php echo e($comment['comment']); ?></p>
                        <small>
                            <?php echo e($comment['posted_by_name']);  ?>
                            <em> <?php echo ASLang::get('at'); ?> <?php echo $comment['post_time']; ?></em></small>
                    </blockquote>
                    <?php endforeach; ?>
                </div>
        </div>

        <?php if($user->getRole() != 'user'): ?>
        <div class="leave-comment">
            <div class="control-group form-group">
                <h5><?php echo ASLang::get('leave_comment'); ?></h5>
                <div class="controls">
                    <textarea class="form-control" id="comment-text"></textarea>
                </div>
            </div>
            <div class="control-group form-group">
                 <div class="controls">
                    <button class="btn btn-success" id="comment">
                      <?php echo ASLang::get('comment'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php else: ?>
            <p><?php echo ASLang::get('you_cant_post'); ?></p>
        <?php endif; ?>


  </div>

</div>

<?php include 'templates/footer.php'; ?>

<script src="ASLibrary/js/asengine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="ASLibrary/js/index.js" charset="utf-8"></script>

    
  </body>
</html>
