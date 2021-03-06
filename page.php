<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content">
         <h3><?php the_title(); ?></h3>
         <?php 
         if(have_posts()){
            while(have_posts()){
               the_post();
         ?>
         <div class="post">
            <?php the_content(); ?>
         </div>
         <?php
            }
         }
         ?>
      </div>
		<div class="large-5 columns">
      	<div id="sidebar" class="sidebar-container" role="complementary">
		      <?php get_sidebar('translation'); ?>
   		   <?php get_sidebar('news'); ?>
         </div>
      </div><!-- .large-5 -->
   </div><!-- .row -->
</div>

<?php get_footer(); ?>