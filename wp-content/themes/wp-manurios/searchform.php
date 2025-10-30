<?php
/**
 * Template for displaying search forms
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="input-group">
        <input type="search" class="form-control" placeholder="<?php echo esc_attr_x('Buscar...', 'placeholder', 'wp-manurios'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
            <span class="visually-hidden"><?php echo _x('Buscar', 'submit button', 'wp-manurios'); ?></span>
        </button>
    </div>
</form>
