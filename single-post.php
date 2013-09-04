<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content">
         <a href="<?php echo home_url(); ?>"><h3>&laquo; Back to Project News</h3></a>
         <?php 
         if(have_posts()){
            while(have_posts()){
               the_post();
         ?>
         <div class="post">
            <h3 class="post-title"><?php the_title(); ?></h3>        
            <?php the_date("l, F j", "<div class='post-date'>", "</div>"); ?>
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
            <?php get_sidebar('general'); ?>
			</div>
      </div>
   </div><!-- .row -->
</div>

<?php get_footer(); ?>