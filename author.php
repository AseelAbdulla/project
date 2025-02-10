<!-- author profile link -->
<?php get_header(); ?>

<div class="container author-page">
  <h1 class="text-center profile-header">
        <i class="fa fa-code"></i>
         <?php the_author_meta('nickname'); ?> Page
        </h1>
  <div class="author-form-single">
    <!-- start author info row -->
  <div class="row">
    <div class="col-4 ">
      <?php
       //get avatar by the author id, this function shuld echo it becouse it is not return data
       $avatar_array= array(
       'class'   => 'center-block img-fluid'
       );
       echo get_avatar(
       get_the_author_meta('ID'),     // author avatar id
       196 ,                          // avatar size
       '' ,                         //url default img
       '' ,                        //avatar alt
       $avatar_array,             // arguments for avatar options
       ); 
      ?>
     </div>
    <div class="col-8 author-info">
        <h3>
         <?php the_author_meta('first_name'); ?>
         <?php the_author_meta('last_name'); ?>
        </h3>
        <p><span><i class="fa fa-xmarks-lines"></i> Nice Name:</span> <?php the_author_meta('nickname'); ?></p>
     <hr>
     <?php
     //check if there is author discription
     if (get_the_author_meta('description'))  {?> 

     <p class="author-description-single">
      <i class="fa fa-info-circle"></i>
      <?php the_author_meta('description'); ?>
     </p>

     <?php
     }else{
        echo'<h3 class="text-center"> There is No Description <i class="fa fa-eye-dropper-empty"></i> </h3>';
     } ?>
    </div>
  </div> 
  <!--end author info row  -->
  <div class="clearfix"></div>

  </div>
     <!-- start row -->
     <div class="row author-stats">
       <div class="col-md-3">
        <div class="stats">
          Post Count
          <span>
            <?php echo count_user_posts(get_the_author_meta('ID'));//count how many postes there?>
          </span>
        </div>
       </div>
       <div class="col-md-3">
       <div class="stats">
          Comments Count
          <span>
            <?php
            $commentscount_arguments = array(
              'user_id'      => get_the_author_meta('ID'), //get author id
              'count'        => true, //true mane get number of comments, false mane get the comments string 
            );
            echo get_comments($commentscount_arguments); // count how many comments did you have
            ?>
          </span>
        </div>
       </div>
       <div class="col-md-3">
       <div class="stats">
          Total Post View
          <span>0</span>
        </div>
       </div>
       <div class="col-md-3">
       <div class="stats">
          Testing
          <span>0</span>
        </div>
       </div>
      </div><!-- end status row -->
     <hr>
      <!-- start author posts -->

        <?php
        $author_posts_per_page = 5;
        $author_posta_argument= array(
          'author'          => get_the_author_meta('ID'),
          'posts_per_page'  => -1 //get all posts
        );
        $author_posts = new WP_Query($author_posta_argument); //oop get posts by spesfice author
         if ($author_posts -> have_posts()) { // check if have posts
          if (count_user_posts(get_the_author_meta('ID')) >= $author_posts_per_page) {?>
            <h3 class="author-name"> <i class="fa fa-signs-post"></i> The latest  <?php echo $author_posts_per_page;?> Posts Of <?php the_author_meta('first_name');?></h3>
         <?php }else{
          echo'<h3 class="author-name"> <i class="fa fa-signs-post"></i> The latest Posts Of ';  the_author_meta('first_name'); echo'</h3>';
         }
          ?>
          <?php
          while ($author_posts -> have_posts()) {
            $author_posts -> the_post(); ?>
                    <div class="author-post">
           <div class="row">
           <div class="col-sm-3">
            <?php
             if (has_post_thumbnail()) {
             the_post_thumbnail('', ['class' => 'img-responsive img-fluid','title' => 'post image']);
             }
             else{ ?>
             <img src="<?php echo get_template_directory_uri().'/images/1.gif';?>" alt="" class="img-fluid " style="width: 350px">
             
             <?php }

             ?>
            </div>
        <div class="col-sm-9">
           <div class="author-post-content">
           <h3 class="post-title">
             <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
             </h3>
            <span class="post-date">  
             <i class="fa fa-calendar" aria-hidden="true"></i>
             <?php the_time('F j, Y'); ?>
             </span>
     
            <span class="post-comments"> 
              <i class="fa fa-comments" ></i>
              <?php comments_popup_link('0 Comments','1 Comment', '% Comments', 'comment-url'); ?>
              </span>

            <div class="post-content">
             <?php the_excerpt(); ?>
             </div>
     
           </div>
            
            </div> <!-- end sm-9-->
            </div> <!--end author posts row -->

            </div>
   
         <?php
          }   //end wile loop 
     
          }//end if condition
          wp_reset_postdata(); //reset loop query
          ?>
     
       
    <!-- comments row -->
    <div class="row">
       <?php
         $comment_per_page = 5;
         $comments_arguments= array( // get comments for this user
           'user_id'          => get_the_author_meta('ID'),
           'status'           => 'approve',
           'number'           => $comment_per_page,
           'post_status'      => 'publish',
           'post_type'        => 'post'
           );

          $comments = get_comments($comments_arguments);
          if ($comments) {
           //  $comment-> comment_post_ID
             if (get_comments($commentscount_arguments) >= $comment_per_page) {
                 echo '<h3 class="author-name"> <i class="fa fa-signs-post"></i> The latest '. $comment_per_page.' Comments </h3> ';
                }
             else{
                 echo'<h3 class="author-name"> <i class="fa fa-signs-post"></i> The latest Comments Of ';  the_author_meta('first_name'); echo'</h3>';
                 }
           foreach ($comments as $comment) { ?>
           <div class="col-sm-6" >
             <div class="author-comments text-center"> 
                 <div class="author-comments-content">
                   <h3 class="comment-title">
                      <a href="<?php echo get_permalink($comment -> comment_post_ID) ?>">
                        <?php echo get_the_title($comment ->comment_post_ID ) ?>
                        </a>
                     </h3>
                   <span class="comment-date">  
                     <i class="fa fa-calendar" aria-hidden="true"></i>
                      <!-- ADD DATE FORMAT -->
                     <?php echo 'Added on '.mysql2date('d-m-Y',$comment-> comment_date); ?>
                     </span>

                  <div class="comment-content">
                     <p> <?php echo $comment-> comment_content  ?></p>
                     </div>
                    </div> <!--author-comments-content-->
                </div> <!--author-comments-->
                 <hr>
              </div><!-- end sm-6-->
             <?php 
             } //end foreach
           }else{
            echo'<h2 class="text-center">there is no comments <i class="fa fa-eye-dropper-empty"></i></h2>';
            } //end if condtion
            ?>
     </div> <!--end row-->
 </div> <!-- end container-->

<?php get_footer(); ?>