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

## Installation

Envoyer le dossier rdr-related-post dans le répertoire plugins de votre site Wordpress.

## Liste des paramètres utilisables

L'appel de la fonction get_rdr_related_post prend les paramètres dans array PHP, l'appel par shortcode prend les paramètres nommés. (voir section exemple)

- per_page : nombre de post à afficher, par défaut 3.
- style_rp : template à utiliser, il est possible d'utiliser un template personnel (voir utiler un template personnel). Par défaut 3 (rdr-rp-style-3.php)
- post_type : Type de post wordpress par défaut post. voir <a href="https://developer.wordpress.org/reference/classes/wp_query/#post-type-parameters" target="_blank">Post Type Parameters</a>
- caching : permet d'activer le cache en base de données. Par défaut false
- find_by : ce paramètre de configurer les éléments pour trouver les articles similaires
    - tag : (défaut) utilise les tags de l'article
    - cat : catégories
    - both : tag et catégories, élément le plus restrictif
- load_css : ce paramètre permet de forcer le chargement du fichier CSS grid de votre choix. Ils sont inclus dans le dossiers asset/css du plugin. Il faut passer le nom du fichier dans l'extension (.css).

## Utilisation

Deux possibilités pour utiliser RDR Related Post.

- Appel de la fonction directement dans un fichier
- Appel par shortcode [get_rdr_rp]

### Appel de la fonction

Dans le fichier de votre thème généralement (content-single.php) qui gére l'affichage des articles, ajouter à l'endroit voulu le code suivant : 

```
<!-- START RELATED POST -->
<div class="inside-article">
	<br/>
	<h3>Related Posts</h3>
	<br/>    
	<?php get_rdr_related_post(); ?>
</div><!-- /.inside-article -->
<!-- END RELATED POST -->
```

Utilisation avec des paramètres : 

```
<!-- START RELATED POST -->
<div class="inside-article">
	<br/>
	<h3>Related Posts</h3>
	<br/>    
	<?php get_rdr_related_post(array('caching' => true, 'style_rp' => 'perso')); ?>
</div><!-- /.inside-article -->
<!-- END RELATED POST -->
```