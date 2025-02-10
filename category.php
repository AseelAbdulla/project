
<?php get_header(); ?>

<div class="container category-page">
    <div class="row text-center info">  
        <div class="col-4">
            <h2 class="category-title"><i class="fa fa-tags"></i><?php single_cat_title() ?></h2>
        </div>
        <div class="col-4">
        <div class="category-description"><?php echo category_description(); ?></div>

        </div>
        <div class="col-4">
        <div class="category-state">
                <span>Articals count: <?php echo count_category_comments(); ?></span>
                <span>Comments count: <?php echo posts_count(); ?> </span>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-9">
     
         <?php
          if (have_posts()) { // check if have posts
           while (have_posts()) {
           the_post(); 
           if(has_post_thumbnail()){
           ?>
            <div class="main-post">
                <div class="row">
                    <div class="col-md-6">
                    <?php 
                 the_post_thumbnail('', 
                 ['class' => 'img-responsive img-fluid',
                  'title' => 'post image']); 
                   ?>
                    </div>
                    <div class="col-md-6">
                    <h3 class="post-title">
                 <a href="<?php the_permalink() ?>">
                 <?php the_title(); ?>
                 </a>
                 </h3>
             <span class="post-author">
                 <i class="fa fa-user fa-fw " aria-hidden="true"></i>
                 <?php the_author_posts_link(); ?>  
                 </span>
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
                <hr>
             <p class="tags">
                 <?php 
                 if(has_tag()){
                 the_tags();
                 } else{
                 echo 'Tags: There is no tags 
                  <i class="fa fa-link fa-fw " aria-hidden="true"></i>';
                  }
                ?></p>
                    </div>
                </div>
             
            </div>

          <?php
           }
           else { ?>
            <div class="main-post">
                <div class="row">
                    <div class="col-md-12">
                    <h3 class="post-title">
                 <a href="<?php the_permalink() ?>">
                 <?php the_title(); ?>
                 </a>
                 </h3>
             <span class="post-author">
                 <i class="fa fa-user fa-fw " aria-hidden="true"></i>
                 <?php the_author_posts_link(); ?>  
                 </span>
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
                <hr>
             <p class="tags">
                 <?php 
                 if(has_tag()){
                 the_tags();
                 } else{
                 echo 'Tags: There is no tags 
                  <i class="fa fa-link fa-fw " aria-hidden="true"></i>';
                  }
                ?></p>
                    </div>
                </div>
             
            </div>
          <?php } //end if condetion
           }   //end wile loop 
         } //end if condition

    echo'</div>'; //end col-md-9 ?>

    <div class="col-md-3">
    <?php 
    // if (is_active_sidebar('main-sidebar')) {
    //     dynamic_sidebar('main-sidebar'); //to display spesific sidebar by id
    // }
    get_sidebar();
     ?>
     </div>

     <div class="row">
 <?php
 
 echo '<div class="clearfix"></div>'; //fix float clear
   echo '<div class="post_pagination">';
   if (get_previous_posts_link()) {
       previous_posts_link('<i class="fa fa-chevron-left fa-fw fa-lg " aria-hidden="true"></i> Previous ');
     }
     else {
     echo '<span class="prev_span"> This is first page </span>';
     }
    if (get_next_posts_link()) {
     next_posts_link('Next <i class="fa fa-chevron-right fa-fw fa-lg " aria-hidden="true"></i> ');
    }
    else 
     echo '<span class="next_span"> This is last page </span>';
     echo '</div>';

   ?>
</div>
  </div> <!--end row-->
 </div> 

<?php get_footer(); ?>