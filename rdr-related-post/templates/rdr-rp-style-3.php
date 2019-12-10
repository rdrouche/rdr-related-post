<?php
/**
 * Related post style 3 based on unsemantic grid
 */

while ($my_query->have_posts()){
    $my_query->the_post();?>
    <div class="grid-container rdr-rp-container-post">
        <div class="grid-20 tablet-grid-20 hide-on-mobile">
            <a href="<?php echo get_the_permalink(); ?> " title="Lire : <?php echo get_the_title(); ?>">
                <img src="<?php the_post_thumbnail_url('thumbnail' ); ?>" alt="<?php echo get_the_title(); ?>" />
            </a>
        </div><!-- ./grid-20 -->
        <div class="grid-80 tablet-grid-80 mobile-grid-80">
            <h3 class="entry-title">
			    <a href="<?php echo get_the_permalink(); ?> " title="Lire : <?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
		    </h3>
            <div class="rdr-rp-text-resume">
                <?php echo wp_html_excerpt(strip_shortcodes(get_the_content('')),200) ?>
            </div>
        </div><!-- ./grid-80 -->
    </div> <!-- ./grid-container -->
<?php
}