<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content student-archive">
         <?php
			$term_slug = get_query_var('student');
			$term = get_term_by('slug', $term_slug, 'student');
			if($term->parent){
				$school = get_term($term->parent, 'student');
				$image = get_field('image', 'student_'.$term->term_id);
				$image_url = $image['url'];
			}
			$posts = array();
			$query = new WP_Query( array('student'=>$term_slug, 'nopaging'=>true));
			if($query->have_posts()){
				while($query->have_posts()){
					$query->the_post();
					$student = array_pop(get_the_terms($post->ID, 'student'));
					$post_type = $post->post_type;
					if($term->parent){
						// Student
						if('ofrenda' == $post_type){
							$posts['ofrenda']['post'] = $post;
						} else {
							$phase = array_pop(get_the_terms($post->ID, 'phase'));
							$posts[$phase->name]['meta'] = $phase;
							$posts[$phase->name]['post'] = $post;
						}
					} else {
						// School
						$posts = get_term_children($term->term_id, 'student');
					}
				}
			}
			$posts = ksortRecursive($posts);
			wp_reset_postdata();
			if($term->parent){
				// Student
				echo "<img class='student_image_large' src='".$image_url."' />";
				echo "<div class='student_info'>";
					echo "<h3 class='student_name_large'>".$term->name."</h3>";
					echo "<a href='".site_url('/school/'.$school->slug)."'><h4 class='student_meta_large'>".$school->name."</h4></a>";
				echo "</div>";
				echo "<div class='post'>";				
				echo "<ul class='phases'>";
				foreach($posts as $k=>$phase){
					if('ofrenda'==$k){
						$ofrenda_image = get_field('image', $phase['post']->ID);
						$ofrenda_image_url = $ofrenda_image['url'];
						if($ofrenda_image){
							echo "<li class='phase'><a href='".get_permalink($phase['post']->ID)."'><img class='ofrenda_image' src='".$ofrenda_image_url."' /><h4>Ofrenda</h4></a></li>";
						} else {
							echo "<li class='phase'><a href='".get_permalink($phase['post']->ID)."'><h4>Ofrenda</h4></a></li>";
						}
					} else {
						echo "<li class='phase'><a href='".get_permalink($phase['post']->ID)."'><h4>".$phase['meta']->name."</h4></a></li>";
					}
				}
				echo "</ul>";
			} else {
				// School
				echo "<h3 class='school_name_large'>".$term->name."</h3>";
				echo "<div class='post'>";
				echo "<div class='school_description'>".$term->description." <a href='".get_field('link', 'student_'.$term->term_id)."'>School homepage &raquo;</a></div>";
				echo "<h3>Students</h3>";
				echo "<ul class='students'>";
				foreach($posts as $student_id){
					$image = get_field('image', 'student_'.$student_id);
					$image_url = $image['url'];
					$student_term = get_term($student_id, 'student');
					?>
               <li class='video'>
               	<a href="<?php echo site_url('/school/'.$term->slug.'/'.$student_term->slug); ?>"><img class="student_image" src="<?php echo $image_url; ?>" /></a>
                  <a href="<?php echo site_url('/school/'.$term->slug.'/'.$student_term->slug); ?>"><p class="student_name"><?php echo $student_term->name; ?></p></a>
               </li>
               <?php
				}
				echo "</ul>";
			}
			?>
			</div>
      </div><!-- .large-11.columns.content -->
      <div class="large-5 columns">
      	<div id="sidebar" class="sidebar-container" role="complementary">
				<?php get_sidebar('translation'); ?>
		      <?php get_sidebar('general'); ?>
         </div>
      </div>
   </div><!-- .row -->
</div>

<?php get_footer(); ?>