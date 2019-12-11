<?php
/*
Plugin Name: RDR Related Post
Plugin URI: https://github.com/rdrouche/rdr-related-post
Description: Affiche les posts en relations
Author: Romain
Version: 1.0
Author URI: https://rdr-it.com
*/

define('RDR_RP_PLUGIN_DIR', dirname( __FILE__ ) );
define('DS', DIRECTORY_SEPARATOR);

/**
 * Permet l'affichage d'article en relatation
 * Ajout de poste aleatoire sur pas de tag sur le post.
 * 
 * @param   int     $post_id    Post ID
 * @param   array   $custom_options    Param affichage posts
 * @param   int     $style_rp   Result HTML
 */
function get_rdr_related_post($custom_options = array()){
    global $post; 
    // Param custom
    $options = array(
        'per_page'      =>    isset($custom_options['per_page'])  ? $custom_options['per_page'] : 3,
        'style_rp'      =>    isset($custom_options['style_rp'])  ? $custom_options['style_rp'] : 3,
        'post_type'     =>    isset($custom_options['post_type'])  ? $custom_options['post_type'] : 'post',
        'caching'       =>    isset($custom_options['caching'])  ? true : false,
        'find_by'       =>    isset($custom_options['find_by'])  ? $custom_options['find_by'] : 'both',
    );

    // Load CSS grid on demand
    if( isset( $custom_options['load_css'] ) ){
        wp_enqueue_style('rdr-rp-css-ondemand','/wp-content/plugins/rdr-related-post/asset/css/'.$custom_options['load_css'].'.css');
    }
    
    // Param Query
    $args=array(
        'post__not_in'      =>  array($post->ID),
        'posts_per_page'    =>  $per_page,
        'caller_get_posts'  =>  1,
        'meta_key'          => '_thumbnail_id',
        'orderby'           => 'rand',
    );

    if($options['caching']){
        $my_query = get_transient('rdr_rp_postid_'. $post->ID .'_style_'.$options['style_rp']);
        if(false !== $my_query){
            goto show_rdr_rp;
        }
    }

    // Traitement find by
    switch( $options['find_by'] ){
        case 'both':
            $tags = wp_get_post_tags($post->ID);
            if( $tags ){
                // post contenant des TAGS
                $tag_ids = array();	
                foreach($tags as $individual_tag){
                    $tag_ids[] = $individual_tag->term_id;
                } 
        
                // Contruction filtre de la requete
                $args['tag__in'] = $tag_ids;                  
            }
            // Recuperation categories du post
            $cats = wp_get_post_categories($post->ID);
            if($cats){
                $cats_ids = array();
                foreach($cats as $individual_cat){
                    $cats_ids[] = $individual_cat->term_id;
                }
                $args['category__in'] = $tag_ids;
            } // /if($cats)
            
        break;
        case 'cat':
            $cats = wp_get_post_categories($post->ID);
            if($cats){
                $cats_ids = array();
                foreach($cats as $individual_cat){
                    $cats_ids[] = $individual_cat->term_id;
                }
                $args['category__in'] = $tag_ids;
            }
        break;
        case 'tag':
        default:
            $tags = wp_get_post_tags($post->ID);
            if( $tags ){
                // post contenant des TAGS
                $tag_ids = array();	
                foreach($tags as $individual_tag){
                    $tag_ids[] = $individual_tag->term_id;
                } 
        
                // Contruction filtre de la requete
                $args['tag__in'] = $tag_ids;                  
            }
    }

    $my_query = new WP_Query($args);

    if($options['caching']){
        set_transient( 'rdr_rp_postid_'. $post->ID .'_style_'.$options['style_rp'], $my_query, HOUR_IN_SECONDS );
    }

    show_rdr_rp:
    if( $my_query->have_posts() ) {

        if($style_rp == 1){
            include RDRITPCT_DIR . DS . 'templates' . DS . 'rdr-rp-style-1.php';  
        }elseif($style_rp == 2){            
            include RDRITPCT_DIR . DS . 'templates' . DS . 'rdr-rp-style-2.php';           
        }elseif($style_rp == 3){
            include RDRITPCT_DIR . DS . 'templates' . DS . 'rdr-rp-style-3.php'; 
        }else{
            // Load personnal template in themes
            get_template_part( 'templates/rdr-rp-style-custom');
        }
        wp_reset_query();
    } // /$my_query->have_posts()
} // end function