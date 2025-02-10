
<?php get_header(); ?>

<div class="container post-page">
  <div class="row">
   <?php
   if (have_posts()) { // check if have posts
    while (have_posts()) {

     the_post(); ?>

    <div class="col-ms-12">
     <div class="main-post">
      <?php  edit_post_link('Edit <i class="fa fa-edit fa-fw " aria-hidden="true"></i> '); ?>
      <h3 class="post-title">
        <a href="<?php the_permalink() ?>"> <!-- get link of posts -->
            <?php the_title(); ?> 
        </a>
      </h3>
     
      <span class="post-date">  
        <i class="fa fa-calendar" aria-hidden="true"></i>
        <?php the_time('F j, Y'); ?>
      </span>
      <span class="post-comments">
        <i class="fa fa-comments" ></i>
    <!--get comments link -->
        <?php comments_popup_link('0 Comments','1 Comment', '% Comments', 'comment-url'); ?>
      </span>
       <!--get image -->
        <?php the_post_thumbnail('', 
                               ['class' => 'img-responsive img-thumbnail',
                                'title' => 'post image']); ?>
     
     
       
        <div class="post-content">
           <!--get summry of content -->
        <?php the_content(); ?>
       </div>
    
       
        <hr>
      <p class="categories">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <?php the_category(', '); ?>
      </p>
      <p class="tags">
        <?php 
        if(has_tag()){ //check if has tages
          the_tags();
        } else{
          echo 'Tags: There is no tags 
                <i class="fa fa-link fa-fw " aria-hidden="true"></i>';
        }
      ?></p>

     </div>
    </div>
   
    <?php
    }   //end wile loop 

    } //end if condition
    
    echo '<div class="clearfix"></div>'; //fix float clear
     ?>

       <!--start rundom posts row-->
        <?php
        $random_posta_argument= array(
          'posts_per_page'   => 6,
          'orderby'          => 'rand',
          'category__in'     => wp_get_post_categories(get_queried_object_id()),
          'post__not_in'     => array(get_queried_object_id())
        );
        $random_posts = new WP_Query($random_posta_argument); //oop get posts by spesfice author
         if ($random_posts -> have_posts()) { // check if have posts
          echo'<h3 class="random-title"><i class="fa fa-code-branch"></i> Random Titles Relate This Post</h3>';
          while ($random_posts -> have_posts()) {
            $random_posts -> the_post(); ?>
        <div class="random-post">
          <div class="random-post-content">
            <ul>
              <li>
              <h4 class="random-post-title">
               <a href="<?php the_permalink() ?>">
                 <?php the_title(); ?>
                 </a>
             </h4>
              </li>
            </ul>
              
           </div>
          </div>  <!--end rundam posts-->
         <?php
          }   //end wile loop 
     
          }//end if condition
          else{
           echo'<h3 class="text-center random-post-title notes">There is No Relashin Titles <i class="fa fa-person-walking-arrow-loop-left"></i></h3>';
          }
          wp_reset_postdata(); //reset loop query
          ?>
    <!--  set author information  -->
    <div class="author-form">
      <div class="row">
         <div class="col-2">
          <?php
           //get avatar by the author id, this function shuld echo it becouse it is not return data
           $avatar_array= array(
             'class'   => 'center-block img-fluid '
            );
           //get user img profile
           echo get_avatar(
           get_the_author_meta('ID'),     // author avatar id
           128 ,                          // avatar size
           '' ,                         //url default img
           '' ,                        //avatar alt
           $avatar_array,             // arguments for avatar options

           ); 
          ?>
          </div>
         <div class="col-10 author-info">
          <h4>
           <!-- get user name -->
           <?php the_author_meta('first_name'); ?>
           <?php the_author_meta('last_name'); ?>
           <span class="author-nickname">
            (<i class="fa fa-code"></i> <?php the_author_meta('nickname'); ?>)
            </span> 
            </h4>
          <?php
            //check if there is author discription
            if (get_the_author_meta('description'))  {?> 
            <p class="author-description">
            <i class="fa fa-info-circle"></i>
            <?php the_author_meta('description'); ?>
             </p>
           <?php
             }else{
              echo'<h4 class="text-center random-post-title">There is No Relation Titles <i class="fa fa-person-walking-arrow-loop-left"></i></h4>';
             } ?>
           </div>
         
          <hr>
         <p class="author-stats">
           <i class="fa fa-signs-post"></i> Writer Postes: 
           <span class="writer-postes"><?php echo count_user_posts(get_the_author_meta('ID')); //count how many postes there?> </span> - 
           <i class="fa fa-link"></i> Writer Profile Link: 
           <span class="writer-link"><?php the_author_posts_link();?></span>
           </p>
         </div><!--end row-->
         <hr>
      </div> <!-- end form-author -->
    <!-- end author information -->
   
    <?php 
     echo '<div class="post_pagination">';
     if (get_previous_post_link()) {
     previous_post_link();
     }
     else {
     echo '<span class="prev_span"> This is first post </span>';
     }
     if (get_next_post_link()) {
      next_post_link();
     }
     else{
      echo '<span class="prev_span"> This is last post </span>';

     }
     echo '</div>';
     comments_template();
    ?>

  </div>
</div> 

<?php get_footer(); ?>