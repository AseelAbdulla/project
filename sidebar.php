
<div class="sidebar">
    <div class="widget">
        <h3 class="widget-title"><?php single_cat_title() ?> Statistics</h3>
        <div class="widget-content">
        <ul>
            <li>
                <span>Comments count: </span> <?php echo count_category_comments(); ?>
            </li>
            <li>
            <span>Posts count: </span> <?php echo posts_count(); ?>
            </li>
        </ul>
        </div>
    </div>
    <div class="widget">
        <h3 class="widget-title">Latest About Students</h3>
        <div class="widget-content">
            <ul>
         <?php  
         $post_arge =array(
          'posts_per_page'  =>2,
          'cat'             => 4,
         );
         $query = new WP_Query($post_arge);
         if ($query->have_posts()) {
            while ($query->have_posts()) {
                # code...
                $query->the_post();?>
                <li>
                    <a href="<?php echo the_permalink(); ?>" target="_blank" >
                        <?php the_title() ?>
                    </a>
                </li>
             

            <?php
            }
         }
         ?>
         </ul>
        
        </div>
    </div>
    <div class="widget">
        <h3 class="widget-title">Hot Posts By Comments</h3>
        <div class="widget-content">
            <ul>
        <?php  
         $post_arge =array(
          'posts_per_page'  =>1,
          'orderby'         =>'comment_count',
         );
         $query = new WP_Query($post_arge);
         if ($query->have_posts()) {
            while ($query->have_posts()) {
                # code...
                $query->the_post();?>
                <li>
                    <a href="<?php echo the_permalink(); ?>" target="_blank" >
                       <?php the_title() ?> <i class="fa fa-fire" style = color:darkred;></i>
                    </a>
                </li>
                <hr> 
                <li>
               Has <?php comments_popup_link('0 Comments','1 Comment', '% Comments', 'comment-url'); ?>

                </li>

            <?php
            }
         }
         ?>
         </ul>
        </div>
        <div class="widget">
        <h3 class="widget-title">All Categories</h3>
        <div class="widget-content">
           <ul>
           <?php
            $cat = get_categories();
            foreach ($cat as $caty) {
                # code...?>
                 <li>
                    <a href="<?php echo get_category_link($caty->term_id); ?>" target="_blank" >
                       <?php echo $caty->name;  ?> 
                    </a>
                </li>
           <?php }
            ?>
           </ul>
        </div>
        </div>
        </div>
    </div>
</div>