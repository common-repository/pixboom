<?php
/*
  Copyright 2011 Pixboom ( http://www.pixboom.com/ )

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function pixboom_config_page() {
    $opts = get_option('pixboom_options');
?>

<div>
    <h2>Pixboom options</h2>
    <p>
        Please fill in your Pixboom secret identifier here. If you don't have a Pixboom account yet, visit <a href="http://www.pixboom.com/">pixboom.com</a> to sign up.
    </p>
    <form method="post" action="options.php">
        <?php settings_fields('pixboom-options'); ?>

        <p>
            <label for="pixboom_secret">Secret identifier:</label>
            <input name="pixboom_options[secret]" type="text" id="pixboom_secret" value="<?php _e($opts['secret']); ?>" /> (16 characters)
        </p>
        <p>
          <input type="submit" value="<?php _e('Save changes') ?>" />
        </p>

    </form>
</div>


<?php
}
?>
