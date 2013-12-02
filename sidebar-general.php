<?php 

if(is_singular('ofrenda') || is_singular('video')){
  global $post;
  $is_ofrenda = is_singular('ofrenda');
  $is_video = is_singular('video');
  $current_phase = array_pop(get_the_terms($post->ID, 'phase'));
  $term = array_pop(get_the_terms($post->ID, 'student'));
  $term_slug = $term->slug;

  $posts = array();
  $posts['student'] = $term->name;
  $query = new WP_Query( array('student'=>$term_slug, 'nopaging'=>true));
  if($query->have_posts()){
    while($query->have_posts()){
      $query->the_post();
      $post_type = $post->post_type;
      if('ofrenda' == $post_type && !$is_ofrenda){
        $posts['ofrenda']['post'] = $post;
      } else {
        if(get_the_terms($post->ID, 'phase')){
          $phase = array_pop(get_the_terms($post->ID, 'phase'));
          if($phase != $current_phase){
            $posts['videos'][$phase->name]['meta'] = $phase;
            $posts['videos'][$phase->name]['post'] = $post;
          }
        }
      }
    }
  }
  $posts = ksortRecursive($posts);
  wp_reset_postdata();

  if(array_key_exists('videos', $posts) || array_key_exists('ofrenda', $posts)){
    echo "<div class='widget-area'>";
      echo "<h3>Also by " . $posts['student'] . ":</h3>";
      if(array_key_exists('videos', $posts)){
        echo "<div class='student_videos'>";
        echo "<h4>Videos</h4>";
        echo "<ul class='videos'>";
        foreach($posts['videos'] as $video){
          $content = $video['post']->post_content;
          preg_match("(v=(.{11}))", $content, $matches);
          $youtube_thumb_src = 'http://img.youtube.com/vi/' . $matches[1] . '/0.jpg';
          ?>
          <li class="video">
            <a href="<?php echo get_permalink($video['post']->ID); ?>"><img class="video_thumb" src="<?php echo $youtube_thumb_src; ?>" /></a>
            <a href="<?php echo get_permalink($video['post']->ID); ?>"><p class="phase_name"><?php echo $video['meta']->name; ?></p></a>
          </li>
          <?php
        }
        echo "</ul>";
        echo "</div>";
      }
      if(array_key_exists('ofrenda', $posts)){
        $ofrenda_img = get_field('image', $posts['ofrenda']['post']->ID);
        $ofrenda_img_src = $ofrenda_img['sizes']['medium'];
        echo "<div class='student_ofrenda'>";
        echo "<h4>Ofrenda</h4>";
        echo "<a href='" . get_permalink($posts['ofrenda']['post']->ID) . "'><img src='" . $ofrenda_img_src . "' class='ofrenda_image' /></a>";
        echo "<a href='" . get_permalink($posts['ofrenda']['post']->ID) . "'><p class='ofrenda_name'>" . get_the_title($posts['ofrenda']['post']->ID) . "</a>";
        echo "</div>";
      }
    echo "</div>";
  } else {
    if(is_active_sidebar('sidebar-general')){ ?>
      <div class="widget-area">
        <?php dynamic_sidebar('sidebar-general'); ?>
      </div><!-- .widget-area --><?php 
    }
  }
} else {
  if(is_active_sidebar('sidebar-general')){ ?>
    <div class="widget-area">
      <?php dynamic_sidebar('sidebar-general'); ?>
    </div><!-- .widget-area --><?php 
  }
}

