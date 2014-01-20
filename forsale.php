<?php
/**
 * @package forsale
 * @version 1.6
 */
/*
Plugin Name: MultiSite For Sale
Plugin URI: http://www.bejda.com/multisite-domain-for-sale
Description: MultiSite Domain For Sale
Author: Milos Bejda
Version: 1.6
Author URI: http://wwwbejda.com
Network: true 
*/ 

add_action('wp_enqueue_scripts','frontend_load_scripts',9999);
add_action('admin_enqueue_scripts','backend_load_scripts');
add_action('admin_print_scripts','backend_print_scripts');

add_action('wp_footer','load_footer');
add_action('wp_print_scripts','frontend_print',9999);
add_action('wp_ajax_send_form', 'send_form_callback');
add_action('wp_ajax_nopriv_send_form', 'send_form_callback');


function backend_print_scripts()
{
?>
<style>
table.bordered {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;    
}

table.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
}

table.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}    
    
table.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
    text-align: left;    
}

table.bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

table.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

table.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

table.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

table.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

table.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

table.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}
  </style>
<?php
	
	
}

function set_html_content_type() {
	return 'text/html';
}



function send_form_callback() {
	global $wpdb; // this is how you get access to the database

	$email = trim( $_POST['email'] );
	$name = trim( $_POST['name'] );
	$options = get_option( 'forsale',false);
	$to = $options['contact'];
	$message = '
	Domain : '.site_url().'
	Sub Text : '.$options['cost'].'
	Interested Party : '.$name.'
	Interested Party Email : '.$email;

 wp_mail( $to, 'Domain for Sale', $message ); 

echo "success";

	die(); // this is required to return a proper result
}


function frontend_print()
{
	?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<style>
.feedback{
	position:fixed;
	left:0;
	bottom:0;
}
.feedback input.not_valid {
border:1px solid red;	
}
.feedback a {
	display:block;
	width:100px;
	text-align:center;
	background:red;
	border:2px solid #fff;
	outline:1px solid #a1a1a1;	
	padding:5px;
	float:left;
	cursor:pointer;
	
	/*Font*/
	color:#FFF;
	font-weight:bold;
	text-decoration: none;
	font-size:18px;
background: #ff1a00; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmMWEwMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZjFhMDAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #ff1a00 0%, #ff1a00 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff1a00), color-stop(100%,#ff1a00)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ff1a00 0%,#ff1a00 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ff1a00 0%,#ff1a00 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ff1a00 0%,#ff1a00 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ff1a00 0%,#ff1a00 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff1a00', endColorstr='#ff1a00',GradientType=0 ); /* IE6-8 */
}
.feedback .form{
	clear:both;
	height:500px;
	width:450px;
	border:1px solid #000;
	background:#fff;
	padding:15px;
	display: none;
}
.feedback .form input[type="button"] {margin:4px;}
.feedback .form h1, .feedback .form h2, .feedback .form h3 {margin:0px; display:block;}
.feedback .form label, .feedback .form input {display:block;}
.feedback .form textarea{
	height:170px;
	width:400px;
	padding:5px;
}
.feedback .status{
	font-size:16px;
}

</style>
	<?php

}
function load_footer()
{
	$option = get_option('forsale',true);
	if(($option['active']) == 1)
	{
	?>
<div class="feedback">
	<a id="feedback_button"><?=__('Domain for Sale!','forsale');?></a>
	
	<div class="form"> 
	<h2><?=__('Domain for Sale.','forsale');?></h2>
		<?php
if(!empty($option['cost'])){
		?>
	<h3><?=__($option['cost'],'forsale');?></h3>
	<?php
}
	?>
		<label><?=__('Full Name','forsale');?>:</label>
		<input id="feedback_name" type="text" value=""/>
		<label><?=__('Your Contact Email','forsale');?> : </label>
		<input id="feedback_email" type="email" value="" />
		<input type="button" value="Send" id="submit_form" />
	</div>
</div>

	<?php
}
}
function frontend_load_scripts()
{
		$option = get_option('forsale',true);
	if(($option['active']) == 1)
	{
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'contactable_js', plugins_url( 'contactform/contactable.min.js', __FILE__), array('jquery'), null);
	wp_enqueue_script( 'forsale_js', plugins_url( 'contactform/frontend.js', __FILE__), array('jquery','contactable_js'), null);
	}
}
function backend_load_scripts()
{
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'forsale_css', plugins_url( 'contactform/backend.css', __FILE__));

	wp_enqueue_script( 'script', plugins_url( 'contactform/backend.js', __FILE__), array('jquery','contactable'), null);

}


add_action('network_admin_menu', 'domain_for_sale_settings');

add_filter('plugin_action_links', 'our_plugin_action_links', 10, 2);
function our_plugin_action_links($links, $file) {
    static $this_plugin;
 
    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }
 
    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
        // the anchor tag and href to the URL we want. For a "Settings" link, this needs to be the url of your settings page
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=font-uploader.php">Settings</a>';
        // add the link to the list
        array_unshift($links, $settings_link);
    }
 
    return $links;
}




function domain_for_sale_settings() {
  add_submenu_page(
       'settings.php',
       'For Sale Settings',
       'For Sale Settings',
       'manage_network_options',
       'domain-for-sale',
       'multisite_domains_forsale'
  );    
}
add_action('admin_post_update_my_settings',  'update_domain_for_sale_settings');
function update_domain_for_sale_settings(){     
  check_admin_referer('domain_for_sale');
  if(!current_user_can('manage_network_options')) wp_die('FU');

$contact = $_POST['contact'];
$cost = $_POST['cost'];
$active = $_POST['active'];

foreach($contact as $key=>$val)
{
	$blog_id = $key;
	switch_to_blog($blog_id);
	$a =  $contact[$blog_id];
	$b = $cost[$blog_id];
	$c = $active[$blog_id];

    update_option( 'forsale', array("contact"=>$a,"cost"=>$b,"active"=>$c));

}
restore_current_blog();

  wp_redirect(admin_url('network/settings.php?page=domain-for-sale'));
  exit;  
}

function multisite_domains_forsale(){

  $options = get_site_option('your_plugin');
  global $wpdb;
$blogs = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."blogs ORDER BY blog_id" ) );
?>
  <form action="<?php echo admin_url('admin-post.php?action=update_my_settings'); ?>" method="post">
    <?php wp_nonce_field('domain_for_sale'); ?>

<table class="bordered">
<tr>
<th><?=__('Domain','forsale');?></th>
<th><?=__('Sub Text','forsale');?></th>
<th><?=__('Primary Contact Email','forsale');?></th>
<th><?=__('Active','forsale');?></th>


</tr>
<?php
foreach($blogs as $blog)
{
	$blog_id = $blog->blog_id;
	switch_to_blog($blog_id);

	$forsale = get_option('forsale');

	?>
	<tr>
<td>
<?=$blog->domain;?>
<?=$blog->path;?>
</td>
<td>
	<input name="cost[<?=$blog->blog_id?>]" type="text" value="<?=@$forsale['cost']?>"/>
</td>
<td>
	<input name="contact[<?=$blog->blog_id?>]" type="text" value="<?=@$forsale['contact'];?>"/>
</td>
<td>
<input type="checkbox" name='active[<?=$blog->blog_id?>]' value="1" <?php checked( $forsale['active'] , 1 ); ?> />
</td>
	</tr>

	<?php
}


?>
</table>
<?php

submit_button(
    __( 'Save', 'forsale' ),
    'primary',
    'submit'
);

?>
<?php
  ?>


  </form>
  <?php
  restore_current_blog();
}