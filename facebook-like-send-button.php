<?php
/*
Plugin Name:  Facebook Like & Send Button
Plugin URI:   http://pleer.co.uk/wordpress/plugins/facebook-like-send-button/
Description:  Insert the Facebook Like and/or Send button to any post, page or template with this simple plugin. Also lets you add them via shortcode anywhere in your site!
Version:      1.0
Author:       Alex Moss
Author URI:   http://alex-moss.co.uk/
Contributors: pleer

Copyright (C) 2010-2010, Alex Moss
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Alex Moss or pleer nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/

if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX )) {
	add_action('admin_menu', 'show_fblikesend_options');
	function show_fblikesend_options() {
		// Add a new submenu
		add_options_page('Facebook Like & Send Options', 'Facebook Like & Send', 'manage_options', 'fblikesend', 'fblikesend_options');


		//Add options
		add_option('fblikesend_xfbml', 'on');
		add_option('fblikesend_opengraph', 'off');
		add_option('fblikesend_fbns', 'off');
		add_option('fblikesend_posts', 'on');
		add_option('fblikesend_pages', 'on');
		add_option('fblikesend_homepage', 'on');
		add_option('fblikesend_linklove', 'on');
		add_option('fblikesend_scheme', 'light');
		add_option('fblikesend_like', 'on');
		add_option('fblikesend_send', 'on');
		add_option('fblikesend_verb', 'like');
		add_option('fblikesend_faces', 'on');
		add_option('fblikesend_layout', '');
		add_option('fblikesend_width', '450');
		add_option('fblikesend_font', '');
		add_option('fblikesend_nested', 'off');
	}

	//
	// Admin page HTML //
	//

	function fblikesend_options() { ?>
	<style type="text/css">
	div.headerWrap { background-color:#e4f2fds; width:200px}
	#options h3 { padding:7px; padding-top:10px; margin:0px; cursor:auto }
	#options label { width: 300px; float: left; margin-left: 10px; }
	#options input { float: left; margin-left:10px}
	#options p { clear: both; padding-bottom:10px; }
	#options .postbox { margin:0px 0px 10px 0px; padding:0px; }
	</style>
	<div class="wrap">
	<form method="post" action="options.php" id="options">
	<?php wp_nonce_field('update-options') ?>
	<h2>Facebook Like & Send Options</h2>

	<div class="postbox-container" style="width:100%;">
		<div class="metabox-holder">
		<div class="postbox">
			<h3 class="hndle"><span>Resources</span></h3>
			<div style="margin:20px;">
				<div style="width:180px; text-align:center; float:right; font-size:10px; font-weight:bold">
					<a href="http://pleer.co.uk/go/twitter-paypal/">
					<img src="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" style="padding-bottom:10px" /></a>
				</div>
		<a href="http://developers.facebook.com/docs/reference/plugins/like/" style="text-decoration:none" target="_blank">Facebook Like Developer Homepage</a><br /><br />
		<a href="http://developers.facebook.com/docs/reference/plugins/send/" style="text-decoration:none" target="_blank">Facebook Send Developer Homepage</a><br /><br />
		<a href="http://pleer.co.uk/wordpress/plugins/facebook-like-send-button/" style="text-decoration:none" target="_blank">Plugin Homepage</a> <small>- More information on this plugin</small><br /><br />
		<a href="http://pleer.co.uk/wordpress/plugins/" style="text-decoration:none" target="_blank">WordPress Plugins</a> <small>- I have developed other plugins including <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/" style="text-decoration:none" target="_blank">Facebook Comments</a>, <a href="http://pleer.co.uk/wordpress/plugins/wp-twitter-feed/" style="text-decoration:none" target="_blank">Twitter Feed</a> and <a href="http://pleer.co.uk/wordpress/plugins/rss-feed-reader/" style="text-decoration:none" target="_blank">RSS Feed Reader</a>!</small>

			</div>
		</div>
		</div>
		<div class="metabox-holder">
		<div class="postbox">
			<h3 class="hndle"><span>Settings</span></h3>
			<div style="margin:20px;">
			<p>
				<?php
					if (get_option('fblikesend_fbml') == 'on') {echo '<input type="checkbox" name="fblikesend_fbml" checked="yes" />';}
					else {echo '<input type="checkbox" name="fblikesend_xfbml" />';}
				?>
				<label>Enable XFBML</label><small>only disable this if you already have XFBML enabled elsewhere</small>
			</p>
			<p>
				<?php
					if (get_option('fblikesend_linklove') != '') {echo '<input type="checkbox" name="fblikesend_linklove" checked="yes" />';}
					else {echo '<input type="checkbox" name="fblikesend_linklove" />';}
				?>
				<label>Credit</label><small>untick this box to remove the link to the plugin homepage. If you do, please think of <strong><a href="http://pleer.co.uk/go/twitter-paypal/">donating</a></strong>!</small>
			</p>
			<p>
				<?php
					if (get_option('fblikesend_posts') == 'on') {echo '<input type="checkbox" name="fblikesend_posts" checked="yes" />';}
					else {echo '<input type="checkbox" name="fblikesend_posts" />';}
				?>
				<label>Show button in posts</label>
		</p>
			<p>
				<?php
					if (get_option('fblikesend_pages') == 'on') {echo '<input type="checkbox" name="fblikesend_pages" checked="yes" />';}
					else {echo '<input type="checkbox" name="fblikesend_pages" />';}
				?>
				<label>Show button in pages</label>
			</p>

			<p>
				<?php
					if (get_option('fblikesend_homepage') == 'on') {echo '<input type="checkbox" name="fblikesend_homepage" checked="yes" />';}
					else {echo '<input type="checkbox" name="fblikesend_homepage" />';}
				?>
				<label>Show button on the homepage</label>
			</p>
	</div>
	</div>
	</div>

		<div class="metabox-holder">
		<div class="postbox">
			<h3 class="hndle"><span>Customisation and Styling</span></h3>
			<div style="margin:20px;">
			<p>
				<label>Insert into a DIV</label>
				<div style="margin-left: 45%; margin-top: -20px;"><input type="radio" name="fblikesend_nested" value="on" <?php if (get_option('fblikesend_nested') == 'on') {echo 'checked';} ?> /><label>on</label>
				<br /><br /><input type="radio" name="fblikesend_nested" value="off" <?php if (get_option('fblikesend_nested') == 'off') {echo 'checked';} ?> /> <label>off</label>
				<br /><br />
				Nest the button within a DIV. This DIV will have the CSS class <strong>.fblikesend</strong>
			</div></p>
			<p>
				<label>Button Type</label>
				<div style="margin-left: 45%; margin-top: -20px;"><input type="checkbox" name="fblikesend_like" value="on" <?php if (get_option('fblikesend_like') == 'on') {echo 'checked';} ?> /><label>like</label>
				<br /><br /><input type="checkbox" name="fblikesend_send" value="on" <?php if (get_option('fblikesend_send') == 'on') {echo 'checked';} ?> /> <label>send</label>
			</div></p>
			<p>
				<label>Colour Scheme</label>
				<div style="margin-left: 45%; margin-top: -20px;"><input type="radio" name="fblikesend_scheme" value="light" <?php if (get_option('fblikesend_scheme') == 'light') {echo 'checked';} ?> /><label>light</label>
				<br /><br /><input type="radio" name="fblikesend_scheme" value="dark" <?php if (get_option('fblikesend_scheme') == 'dark') {echo 'checked';} ?> /> <label>dark</label>
			</div></p>
			<p>
				<label>Font</label>
				<div style="margin-left: 45%; margin-top: -20px;">
				<select name="fblikesend_font">
					<option value="" <?php if (get_option('fblikesend_font') == '') {echo 'selected="1"';} ?>>default</option>
					<option value="arial" <?php if (get_option('fblikesend_font') == 'arial') {echo 'selected="1"';} ?>>arial</option>
					<option value="lucida grande" <?php if (get_option('fblikesend_font') == 'lucida grande') {echo 'selected="1"';} ?>>lucida grande</option>
					<option value="segoe ui" <?php if (get_option('fblikesend_font') == 'segoe ui') {echo 'selected="1"';} ?>>segoe ui</option><option value="tahoma">tahoma</option>
					<option value="trebuchet ms" <?php if (get_option('fblikesend_font') == 'trebuchet ms') {echo 'selected="1"';} ?>>trebuchet ms</option>
					<option value="verdana" <?php if (get_option('fblikesend_font') == 'verdana') {echo 'selected="1"';} ?>>verdana</option>
				</select>
			</div></p>
			<strong>Like Button Specific:</strong>
			<p>
				<label>Layout Style</label>
				<div style="margin-left: 45%; margin-top: -20px;"><input type="radio" name="fblikesend_layout" value="" <?php if (get_option('fblikesend_layout') == '') {echo 'checked';} ?> /><label>standard</label>
				<br /><br /><input type="radio" name="fblikesend_layout" value="button_count" <?php if (get_option('fblikesend_layout') == 'button_count') {echo 'checked';} ?> /> <label>button_count</label>
				<br /><br /><input type="radio" name="fblikesend_layout" value="box_count" <?php if (get_option('fblikesend_layout') == 'box_count') {echo 'checked';} ?> /> <label>box_count</label>
			</div></p>
			<p>
				<label>Width</label>
				<div style="margin-left: 45%; margin-top: -20px;"><input type="text" name="fblikesend_width" value="<?php echo get_option('fblikesend_width'); ?>" />default is <strong>450</strong>
			</div></p>
			<p>
				<label>Show faces</label>
				<div style="margin-left: 45%; margin-top: -20px;"><input type="radio" name="fblikesend_faces" value="on" <?php if (get_option('fblikesend_faces') == 'on') {echo 'checked';} ?> /><label>on</label>
				<br /><br /><input type="radio" name="fblikesend_faces" value="off" <?php if (get_option('fblikesend_faces') == 'off') {echo 'checked';} ?> /> <label>off</label>
			</div></p>
			<p>
				<label>Verb to Display</label>
				<div style="margin-left: 45%; margin-top: -20px;"><input type="radio" name="fblikesend_verb" value="like" <?php if (get_option('fblikesend_verb') == 'like') {echo 'checked';} ?> /><label>like</label>
				<br /><br /><input type="radio" name="fblikesend_verb" value="recommend" <?php if (get_option('fblikesend_verb') == 'recommend') {echo 'checked';} ?> /> <label>recommend</label>
			</div></p>
	</div></div>
	</div>

		<div class="metabox-holder">
	<div class="postbox">
	<h3 class="hndle">Insert Manually via Shortcode</h3>
	<div style="text-decoration:none; padding:10px">
	<p>The settings above are for automatic insertion of the Facebook Comment box.</p>
	<p>You can insert the comment box manually in any page or post or template by simply using the shortcode <strong>[fblikesend]</strong>. To enter the shortcode directly into templates using PHP, enter <strong>echo do_shortcode('[fblikesend]');</strong></p>
	<p>You can also use the options below to override the the settings above.</p>
	<ul>
	<li><strong>url</strong> - leave blank for current URL</li>
	<li><strong>like</strong> -  on/off</li>
	<li><strong>send</strong> -  on/off</li>
	<li><strong>verb</strong> -  like/recommend</li>
	<li><strong>faces</strong> -  on/off</li>
	<li><strong>layout</strong> -  standard/button_count/box_count</li>
	<li><strong>nested</strong> -  on/off</li>
	<li><strong>width</strong> -  in pixels, default is <strong>450</strong></li>
	<li><strong>font</strong> -  arial, lucida grande, segoe ui, tahoma, trebuchet ms, verdana</li>
	</ul>
	<p>An example using these options is <strong>[fblikesend url="http://pleer.co.uk/wordpress/plugins/facebook-like-send-button/" like="on" send="on" verb="recommend" faces="no"]</strong><br />this would output the following:<br /><br />
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://pleer.co.uk/wordpress/plugins/facebook-comments/" send="true" width="450" show_faces="false" action="recommend"></fb:like>
	</p>

	</div></div></div>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="fblikesend_xfbml,fblikesend_opengraph,fblikesend_fbns,fblikesend_posts,fblikesend_pages,fblikesend_homepage,fblikesend_linklove,fblikesend_scheme,fblikesend_like,fblikesend_send,fblikesend_verb,fblikesend_faces,fblikesend_layout,fblikesend_width,fblikesend_font,fblikesend_nested" />
	<div class="submit"><input type="submit" class="button-primary" name="submit" value="Save Facebook Like & Send Settings"></div>

	</form>
	</div>

	<?php }

	// Add settings link on plugin page
	function fblikesend_link($links) {
	  $settings_link = '<a href="options-general.php?page=fblikesend">Settings</a>';
	  array_unshift($links, $settings_link);
	  return $links;
	}

	$plugin = plugin_basename(__FILE__);
	add_filter("plugin_action_links_$plugin", 'fblikesend_link' );


} else {

	//ADD XFBML
	function fblikesendfbmlsetup() {
		if (get_option('fblikesend_fbml') == 'on') {
			?><div id="fb-root"></div>
			<script>
			window.fbAsyncInit = function() {
				FB.init({xfbml: true});
			  };
			  (function() {
				var e = document.createElement('script'); e.async = true;
				e.src = document.location.protocol +
				  '//connect.facebook.net/en_US/all.js';
				document.getElementById('fb-root').appendChild(e);
			  }());
			</script>
		<?php }
	}
	add_action('wp_footer', 'fblikesendfbmlsetup', 100);


	//INSERT BUTTON
	function fblikesendbutton($content) {
		if (get_option('fblikesend_font') == 'default') { $font =""; } else { $font = get_option('fblikesend_font'); }
		if (get_option('fblikesend_send') == 'on') { $send ="true"; } else { $send ="false"; }
		if (get_option('fblikesend_faces') == 'on') { $faces ="true"; } else { $faces ="false"; }
		if ((is_single() && get_option('fblikesend_posts') == 'on') ||
		  (is_page() && get_option('fblikesend_pages') == 'on') ||
		  ((is_home() || is_front_page()) && get_option('fblikesend_homepage') == 'on')) {
			if (get_option('fblikesend_nested') == 'on') { $content .="<div class=\"fblikesend\">";}
				if (get_option('fblikesend_like') == '') {
					$content .= "<fb:send href=\"".get_permalink()."\" font=\"".$font."\" colorscheme=\"".get_option('fblikesend_scheme')."\"></fb:send>";
				} else {
					$content .= "<fb:like href=\"".get_permalink()."\" send=\"".$send."\" layout=\"".get_option('fblikesend_layout')."\" width=\"".get_option('fblikesend_width')."\" show_faces=\"".$faces."\" action=\"".get_option('fblikesend_verb')."\" font=\"".$font."\" colorscheme=\"".get_option('fblikesend_scheme')."\"></fb:like>";
				}
			if (get_option('fblikesend_nested') == 'on') { $content .="</div>";}
		}
	  return $content;
	}
	add_filter ('the_content', 'fblikesendbutton', 99);



	function fblscode($fblsatts) {
		extract(shortcode_atts(array(
			"width" => get_option('fblikesend_width'),
			"like" => get_option('fblikesend_like'),
			"send" => get_option('fblikesend_send'),
			"verb" => get_option('fblikesend_verb'),
			"faces" => get_option('fblikesend_faces'),
			"layout" => get_option('fblikesend_layout'),
			"url" => get_permalink(),
			"font" => get_option('fblikesend_font'),
			"scheme" => get_option('fblikesend_scheme'),
			"nested" => get_option('fblikesend_nested'),
		), $fblsatts));

		if ($send == 'on') { $send ="true"; } else { $send ="false"; }
		if ($faces == 'on') { $faces ="true"; } else { $faces ="false"; }
//		$fblikesendbutton = '';
		if ($nested == 'on') { $fblikesendbutton .="<div class=\"fblikesend\">";}

		if (get_option('fblikesend_like') == '' || get_option('fblikesend_like') == 'off') {
				$fblikesendbutton .= "<fb:send href=\"".get_permalink()."\" font=\"".$font."\" colorscheme=\"".$scheme."\"></fb:send>";
			} else {
				$fblikesendbutton .= "<fb:like href=\"".get_permalink()."\" send=\"".$send."\" layout=\"".$layout."\" width=\"".$width."\" show_faces=\"".$faces."\" action=\"".$verb."\" colorscheme=\"".$scheme."\" font=\"".$font."\"></fb:like>";
			}
		if ($nested == 'on') { $fblikesendbutton .="</div>";}
		return $fblikesendbutton;
	}
	add_filter('widget_text', 'do_shortcode');
	add_shortcode('fblikesend', 'fblscode');

}
?>








