# rdr-related-post
RDR Related Post est un plugin Wordpress qui permet l'affichage d'article en relation.

Le plugin est léger, il est composé de deux fonctions, dont une qui permet l'appel par shortcode dans Wordpress.

La configuration des options se fait par l'appel de la fonction en passant des paramètres.

## Aperçu
Rendu :

<img src="https://github.com/rdrouche/rdr-related-post/blob/master/screen_1.png" width="500">

Utilisation du code court dans Gutenberg

<img src="https://github.com/rdrouche/rdr-related-post/blob/master/screen_2.png">

## Prérequis

Le CSS utilisé dans les templates par défaut utilise soit le grid bootstrap (1 et 2) ou unsemantic-grid

## Liste des paramètres utilisables

L'appel de la fonction get_rdr_related_post prend les paramètres dans array PHP, l'appel par shortcode prend les paramètres nommés. (voir section exemple)

- per_page : nombre de post à afficher, par défaut 3.
- style_rp : template à utiliser, il est possible d'utiliser un template personnel (voir utiler un template personnel). Par défaut 3 (rdr-rp-style-3.php)
- post_type : Type de post wordpress par défaut post. voir <a href="https://developer.wordpress.org/reference/classes/wp_query/#post-type-parameters" target="_blank">Post Type Parameters</a>