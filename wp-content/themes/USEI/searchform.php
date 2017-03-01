<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>

<form class="form-search" method="post" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div id="imaginary_container"> 
    <div class="input-group stylish-input-group">
    <input type="text" name="s" id="s" class="form-control"  placeholder="<?php _e('Search blog...', 'lenard'); ?>" >
    <span class="input-group-addon">
    <button id="searchsubmit"  type="submit">
    <span class="glyphicon glyphicon-search"></span>
    </button>  
    </span>
    </div>
    </div>
</form>