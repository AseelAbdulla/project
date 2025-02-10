<?php

if (comments_open()) { // check if there is comments
  echo'<h3 class="comments-count">'; ?> <?php comments_number('No comments', '1 comment', '% Comments'); ?> <?php echo'</h3>';
   
  echo'<ul class="list-unstyled comments-list">';// to make comments under one ul 
   
    $comments_arguments = array(
      'max_depth'     => 3,
      'type'          => 'comment',
      'avatar_size'   =>  64,

    );
    
  wp_list_comments($comments_arguments); // display list of omments

  echo'</ul>';

  echo'<hr>';

  $commentform_arguments= array(
     'title_reply'          => 'Add Your Comment',            //chenge add comment text
     'tilte_reply_to'       => 'Add Reply To [%s]',           // change add reply text
     'class_submit'         => 'btn btn-primary btn-sm',      //change submit class
     'comment_notes_before' => ''  ,                          //display email message
      
  ); 
  comment_form($commentform_arguments);
} else {
    // comment_form();
}


