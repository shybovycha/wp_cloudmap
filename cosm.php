<?php
    /*
    Plugin Name: COSM
    Plugin URI: http://enjoyinc.comoj.com
    Description: COSM is a wordpress plugin that
        adds Coludmade's Open Street Map (though COSM)
        services to wordpress.
        Using: in the post or comment body add [map] tag like that:
        [map lat="" lon="" zoom="" apikey="" width="" height="" style_id="" /]
        
        This tag will add Cloudmade's map tile with specified sizes, with
        center at the point (lat, lon), specified zoom and
        using specified API key using style_id for interface.
    Version: 0.1
    Author: Artem Shybovych
    Author URI: http://enjoyinc.comoj.com
    */
    
    /*  Copyright 2009  shybovycha  (email: shybovycha@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */

global $opt_val, $opt_name;

add_action('admin_menu', 'mt_add_pages');

function mt_add_pages() {
    add_options_page('COSM', 'COSM Configuration', 'administrator', 'testoptions', 'mt_toplevel_page');
}

function mt_toplevel_page() {
    $opt_name = 'cosm_apikey';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'cosm_apikey';

    $opt_val = get_option( $opt_name );

    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        $opt_val = $_POST[ $data_field_name ];

        update_option( $opt_name, $opt_val );

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    echo '<div class="wrap">';
    echo "<h2>" . __( 'COSM Options', 'mt_trans_domain' ) . "</h2>";
    ?>

<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("API Key:", 'mt_trans_domain' ); ?>
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p>

</form>
</div>

<?php
 
}


    function map_func($atts, $content = null) {
        extract(shortcode_atts(array(
            'name' => 'cosm_map1',
            'lat' => '0.0',
            'lon' => '0.0',
            'apikey' => get_option('cosm_apikey'),
            'width' => '500',
            'height' => '500',
            'zoom' => '10.0',
            'style_id' => '1'
        ), $atts));

        return "
                    <div id=\"" . $name . "\" style=\"width: " . $width . "px; height: " . $height . "px\"></div>
                    <script type=\"text/javascript\" src=\"http://tile.cloudmade.com/wml/latest/web-maps-lite.js\"></script>
                    <script type=\"text/javascript\">
                        var cloudmade = new CM.Tiles.CloudMade.Web({key: '" . $apikey . "', styleId: " . $style_id . "});
                        var map = new CM.Map('" . $name . "', cloudmade);
                        map.setCenter(new CM.LatLng(" . $lat . ", " . $lon . "), " . $zoom . ");
                        map.addControl(new CM.LargeMapControl());
                    </script>
               ";
    }
    
    add_shortcode('map', 'map_func');
?>

