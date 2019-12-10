<?php
while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <?php $excerpt = get_the_content(''); ?>
    <div class="row">
        <div class="col-2">
            <div class="rdr-rp-image" style="background:url('<?php echo get_the_post_thumbnail_url(); ?>') 50% 50% no-repeat;width: 97.75px;height:68px;margin-bottom: 5px;background-size:  cover;"></div>
        </div>
        <div class="col-10">
            <a class="rdr-rp-title" href="<?php the_permalink() ?>" style="font-size:12px;line-height:22px;"><?php the_title(); ?></a><br/>
            <span class="rdr-tp-text" style="font-size:11px;"><?php echo wp_html_excerpt(strip_shortcodes($excerpt),250) ?></span>
        </div>
    </div><hr/>
<?php
endwhile;        