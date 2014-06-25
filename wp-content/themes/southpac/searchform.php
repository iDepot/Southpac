<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25/06/14
 * Time: 7:55 PM
 */

?>

<div class="search">
    <form id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="GET">
        <input type="text" name="s" value="<?php _e('Search')?>" onfocus="if (this.value == '<?php _e('Search')?>') {this.value=''}" onblur="if (this.value == ''){this.value='<?php _e('Search')?>'}" />
        <a onclick="document.getElementById('search').submit()"></a>
        <div class="clear"></div>
    </form>
</div>
