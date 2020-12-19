
<?php
/*
global $chk2;
global $chk3;
global $chk4;
global $chk5;

if (isset($_POST['bp_submit'])) {
    bp_opt();
}
function bp_opt()
{
    $bkashusername = $_POST['bkashusername'];
    $bkashpassword = $_POST['bkashpassword'];
    $bkashappkey = $_POST['bkashappkey'];
    $bkashappsecret = $_POST['bkashappsecret'];

    global $chk2;
    global $chk3;
    global $chk4;
    global $chk5;

    if (get_option('bkash_user_name') != trim($bkashusername)) {
        $chk2 = update_option('bkash_user_name', trim($bkashusername));
    }
    if (get_option('bkash_password') != trim($bkashpassword)) {
        $chk3 = update_option('bkash_password', trim($bkashpassword));
    }
    if (get_option('bkash_app_key') != trim($bkashappkey)) {
        $chk4 = update_option('bkash_app_key', trim($bkashappkey));
    }
    if (get_option('bkash_app_secret') != trim($bkashappsecret)) {
        $chk5 = update_option('bkash_app_secret', trim($bkashappsecret));
    }
}
?>
<div class="wrap">
    <div id="icon-options-general" class="icon32"> <br>
    </div>
    <h2>Bkash Settings</h2>
    <?php if (isset($_POST['bp_submit']) && ($chk2 && $chk3 && $chk4 && $chk5)) : ?>
        <div id="message" class="updated below-h2">
            <p>Content updated successfully</p>
        </div>
    <?php endif; ?>


    <div class="metabox-holder">
        <h3><strong>Enter bkash Credential and click on save button.</strong></h3>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">Test mode</th>
                    <td><input type="checkbox" name="bkashmode" <?php echo (isset($_POST['bkashmode']) ? 'checked' : ''); ?> /> Enable Test Mode</td>
                </tr>
                <tr>
                    <th scope="row">User Name</th>
                    <td><input type="text" name="bkashusername" value="<?php echo get_option('bkash_user_name'); ?> " size="50" /></td>
                </tr>
                <tr>
                    <th scope="row">Password</th>
                    <td><input type="password" name="bkashpassword" value="<?php echo get_option('bkash_password'); ?> " size="50" /></td>
                </tr>
                <tr>
                    <th scope="row">App Key</th>
                    <td><input type="text" name="bkashappkey" value="<?php echo get_option('bkash_app_key'); ?> " size="50" /></td>
                </tr>
                <tr>
                    <th scope="row">App Secret</th>
                    <td><input type="text" name="bkashappsecret" value="<?php echo get_option('bkash_app_secret'); ?> " size="50" /></td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td style="padding-top:10px;  padding-bottom:10px;">
                        <input type="submit" name="bp_submit" value="Save changes" class="button-primary" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>*/
?>



    <!-- <label for="bp_longitude2"><?php// _e('bp_longitude2', 'bkash-plugin'); ?></label>
    <input type="text" id="bp_longitude2" name="bp_longitude2" value="<?php //echo esc_attr(get_option('bp_longitude2')); ?>">

    <label for="bp_longitude23"><?php //_e('bp_longitude23', 'bkash-plugin'); ?></label>
    <input type="text" id="bp_longitude23" name="bp_longitude23" value="<?php //echo esc_attr(get_option('bp_longitude23')); ?>"> -->