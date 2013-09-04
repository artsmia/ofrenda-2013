<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content">
         <h3>Project News</h3>
         <?php 
         if(have_posts()){
            while(have_posts()){
               the_post();
         ?>
         <div class="post">
               <a href="<?php the_permalink(); ?>"><h4 class="post-title"><?php the_title(); ?></h4></a>
               <?php echo "<div class='post-date'>".get_the_date("l, F j")."</div>"; ?>
               <?php the_excerpt(); ?>
         </div>
         <?php
            }
         }
         echo "<div class='older_posts_link'>".get_next_posts_link( '&laquo;&nbsp;Older&nbsp;Posts' )."</div>";
         echo "<div class='newer_posts_link'>".get_previous_posts_link( 'Newer&nbsp;Posts&nbsp;&raquo;' )."</div>";
         ?>
      </div><!-- .large-11.columns.blog -->
      <div class="large-5 columns">
      	<div id="sidebar" class="sidebar-container" role="complementary">
				<?php get_sidebar('translation'); ?>
            <?php get_sidebar('general'); ?>
			</div>
      </div><!-- .large-5.columns -->
   </div><!-- .row -->
</div>

<?php get_footer(); ?>