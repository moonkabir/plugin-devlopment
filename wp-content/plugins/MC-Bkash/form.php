<h1>Options Demo Admin Page</h1>
<form method="post" action="<?php echo admin_url('admin-post.php') ?>">
    <?php
    wp_nonce_field("mcbkash");
    $mcbkash_longitude = get_option('mcbkash_longitude2')
    ?>
    <label for="mcbkash_longitude2"><?php _e('Longitude', 'mcbkash'); ?></label>
    <input type="text" id="mcbkash_longitude2" name="mcbkash_longitude2" value="<?php echo esc_attr($mcbkash_longitude); ?>">
    <input type="hidden" name="action" value="mcbkash_admin_page">
    <?php
    submit_button("Save");
    ?>
</form>