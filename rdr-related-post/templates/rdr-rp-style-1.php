<div class="row"> 
<?php            
while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <div class="col">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php the_post_thumbnail('thumbnail'); ?>
        </a><br/>
        <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </div>
<?php
endwhile;           
?> 
</div>