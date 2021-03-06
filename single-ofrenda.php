<?php 
$image = get_field('image');
$image_src = $image['url'];
?>
<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content">
         <h2>Ofrendas</h2>
         <?php 
         if(have_posts()){
            while(have_posts()){
               the_post();
         ?>
         <div class="post">
            <h3 class="post-title"><?php the_title(); ?></h3>        
            <img class='ofrenda-image' src='<?php echo $image_src; ?>' />            
            <?php the_content(); ?>
         </div>
         <?php
            }
         }
         ?>
         <div class="light-text">
            <?php comments_template(); ?>
         </div>
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