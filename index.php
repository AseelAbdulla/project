
<?php get_header(); ?>

<div class="container home-page">
  <div class="row">
<?php
if (have_posts()) { // check if have posts
   while (have_posts()) {
    the_post(); ?>
  <div class="col-sm-6">
    <div class="main-post">
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

      <?php 
     
        the_post_thumbnail('', 
        ['class' => 'img-responsive img-thumbnail',
         'title' => 'post image']);
      
      
    ?>
      <div class="post-content">
        <?php the_excerpt(); ?>
       </div>
      <hr>
      <p class="categories">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <?php the_category(', '); ?>
       </p>
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
    <?php
  }   //end wile loop 

} //end if condition

 echo '<div class="clearfix"></div>'; //fix float clear

// echo '<div class="post_pagination">';
   //if (get_previous_posts_link()) {
   //     previous_posts_link('<i class="fa fa-chevron-left fa-fw fa-lg " aria-hidden="true"></i> Previous ');
   //   }
   //   else {
   //   echo '<span class="prev_span"> This is first page </span>';
   //   }
   //  if (get_next_posts_link()) {
   //   next_posts_link('Next <i class="fa fa-chevron-right fa-fw fa-lg " aria-hidden="true"></i> ');
   //  }
   //  else 
   //   echo '<span class="next_span"> This is last page </span>';
   // echo '</div>';

echo '<div class="num-pagenation">'. numbering_pagenation().'</div>';
?>

  </div>
</div> 

<?php get_footer(); ?>