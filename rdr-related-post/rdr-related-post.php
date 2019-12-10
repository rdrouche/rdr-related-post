<?php
/*
Plugin Name: RDR Related Post
Plugin URI: https://github.com/rdrouche/rdr-related-post
Description: Affiche les posts en relations
Author: Romain
Version: 1.0
Author URI: https://rdr-it.com
*/

/**
 * Permet l'affichage d'article en relatation
 * Ajout de poste aleatoire sur pas de tag sur le post.
 * 
 * @param   int     $post_id    Post ID
 * @param   array   $custom_options    Param affichage posts
 * @param   int     $style_rp   Result HTML
 */
function get_rdr_related_post($post_id, $custom_options = array(), $per_page = 3, $style_rp = 3){
    
    // Param custom
    $options = array(
        'per_page'      =>    isset($custom_options['per_page'])  ? $custom_options['per_page'] : 3,
        'style_rp'      =>    isset($custom_options['style_rp'])  ? $custom_options['style_rp'] : 3,
        'post_type'     =>    isset($custom_options['post_type'])  ? $custom_options['post_type'] : 'post',
    );
    
    // Param Query
    $args=array(
        'post__not_in'      =>  array($post_id),
        'posts_per_page'    =>  $per_page,
        'caller_get_posts'  =>  1,
        'meta_key'          => '_thumbnail_id',
        'orderby'           => 'rand',
    );

    

    // Recuperation des tags
    $tags = wp_get_post_tags($post_id);

    if( $tags ){
        // post contenant des TAGS
        $tag_ids = array();	
        foreach($tags as $individual_tag){
            $tag_ids[] = $individual_tag->term_id;
        } 

        // Contruction filtre de la requete
        $args['tag__in'] = $tag_ids;
          
    }else{
        // Recuperation categories du post
        $cats = wp_get_post_categories($post_id);
        if($cats){
            $cats_ids = array();
            foreach($cats as $individual_cat){
                $cats_ids[] = $individual_cat->term_id;
            }
            $args['category__in'] = $tag_ids;
        } // /if($cats)
    } // /else

    $my_query = new WP_Query($args);

    if( $my_query->have_posts() ) {

        if($style_rp == 1){
            ?> <div class="row"> <?php            
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <div class="col">
                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                        <?php the_post_thumbnail('medium', array('class' => 'rdrit-home-thumbnail-max200') ); ?>
                    </a><br/>
                    <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </div>
                <?php
                endwhile;           
            ?> </div> <?php
        }elseif($style_rp == 2){            
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
        }elseif($style_rp == 3){
            include RDRITPCT_DIR . DS . 'templates' . DS . 'rdr-rp-style-3.php'; 
        }
        wp_reset_query();
    } // /$my_query->have_posts()
} // end function