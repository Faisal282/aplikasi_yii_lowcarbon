<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package metropoly
 */

get_header(); 
?>
<?php
global  $metropoly_page_meta,$allowedposttags;
$detect  = new Mobile_Detect;

$enable_page_title_bar     = metropoly_option('enable_page_title_bar','yes');
$page_title_bg_parallax    = esc_attr(metropoly_option('page_title_bg_parallax','no'));
$page_title_bg_parallax    = $page_title_bg_parallax=="yes"?"parallax-scrolling":"";
$page_title_align          = esc_attr(metropoly_option('page_title_align','left'));
$display_breadcrumb        = esc_attr(metropoly_option('display_breadcrumb','yes'));
$breadcrumbs_on_mobile     = esc_attr(metropoly_option('breadcrumbs_on_mobile_devices','yes'));
$breadcrumb_menu_prefix    = esc_attr(metropoly_option('breadcrumb_menu_prefix',''));
$breadcrumb_menu_separator = esc_attr(metropoly_option('breadcrumb_menu_separator','/'));
$content                   = wp_kses(metropoly_option('content_404',''), $allowedposttags);

$sidebar ='none';
$left_sidebar              = esc_attr(metropoly_option('left_sidebar_404'));
$right_sidebar             = esc_attr(metropoly_option('right_sidebar_404'));
if( $left_sidebar !='' )
$sidebar ='left';
if( $right_sidebar !='' )
$sidebar ='right';
if( $left_sidebar !='' && $right_sidebar !='' )
$sidebar ='both';

?>
<?php if( $enable_page_title_bar == 'yes' ):?>
<section class="page-title-bar title-<?php echo $page_title_align;?> no-subtitle <?php echo $page_title_bg_parallax;?>">
            <div class="container">
                <hgroup class="page-title text-light">
                    <h1><?php echo metropoly_option('title_404','');?></h1>
                    <!--<h3>This is a subtitle for the page.</h3>-->
                </hgroup>
                <?php if( $display_breadcrumb == 'yes' && !$detect->isMobile()):?>
                <?php metropoly_get_breadcrumb(array("before"=>"<div class='breadcrumb-nav text-light'>".$breadcrumb_menu_prefix,"after"=>"</div>","show_browse"=>false,"separator"=>$breadcrumb_menu_separator));?>
                <?php endif;?>
                <?php if( $breadcrumbs_on_mobile == 'yes' && $detect->isMobile()):?>
                <?php metropoly_get_breadcrumb(array("before"=>"<div class='breadcrumb-nav text-light'>".$breadcrumb_menu_prefix,"after"=>"</div>","show_browse"=>false,"separator"=>$breadcrumb_menu_separator));?>
                <?php endif;?>
                <div class="clearfix"></div>            
            </div>
        </section>
<?php endif;?>
<div class="page-wrap">
            <div class="container">
                <div class="page-inner row <?php echo metropoly_get_content_class($sidebar);?>">
                    <div class="col-main">
                        <section class="page-main" role="main" id="content">
                            <div class="page-content">
                               <?php echo  do_shortcode(metropoly_fix_shortcodes($content));?>
                            </div>
                            <div class="post-attributes"></div>
                        </section>
                    </div>
                    
                    <?php if( $sidebar == 'left' || $sidebar == 'both'  ): ?>
       <div class="col-aside-left">
                        <aside class="blog-side left text-left">
                            <div class="widget-area">
                            <?php get_sidebar('notfoundleft');?>
                            </div>
                        </aside>
                    </div>
            <?php endif; ?>
            <?php if( $sidebar == 'right' || $sidebar == 'both'  ): ?>        
                    <div class="col-aside-right">
                        <div class="widget-area">
                           <?php get_sidebar('notfoundright');?>
                            </div>
                    </div>
             <?php endif; ?>
             
                </div>
            </div>  
        </div>        
<!-- #primary -->

<?php get_footer(); ?>
