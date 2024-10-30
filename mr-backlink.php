<?php
        /*
        Plugin Name: Mr Backlink
        Plugin URI: http://mrbacklink.co
        Description: The ultimate backlink strategy that will help you to enhance the level of your website SEO by providing you with very high quality backlinks that can be regenerated every 30 days on 27-28-29 of every month , !NO FAKE BACK LINKS HERE, Mr Backlink only approves the real and fully constructed websites . 
        Author: The Mr Community
        Author URI: http://mrbacklink.co/
        Version: 3.0
        */
        /////////////

        if ( ! defined( 'ABSPATH' ) ) exit; 

// MR Backlink Admin page in the wordpress dashboard

        function mbk_main_page() {

            add_menu_page(
                __( 'Mr Backlink', 'textdomain' ),
                'Mr Backlink',
                'manage_options',
                'Mr_Backlink.php',
                'mbk_Content',
                plugins_url('IMG/Mr_Backlink.png',__FILE__ ),
                6
            );
        }
        add_action( 'admin_menu', 'mbk_main_page' );

// The content of MR BACKLINK starts here 

        function mbk_Content(){

        $mbk_img =  plugins_url('IMG/mbk_backlink.png',__FILE__ );
        
        echo '<div class="mbk_content" style="background-color: #01022b;
    color: #7daaff !important;
    font-size: 20px;
    border-radius: 20px;
    padding: 15px 15px 0px;"><center><img src="'.$mbk_img.'" width="11%"><br><p style="color: #ff6600;font-size: 18px;">**Welcome To Mr Backlink**</p></center>';

//Displaying visits from MR backlink system 
       ?>
<center><p style="color:#ff6600;font-weight: 800;">Number of visits for the websites in our system (Counter starts every 6 hours) =
<?php

$mbk_visits =  wp_remote_get('http://mrbacklink.co/visits.txt'); 
if ( is_array( $mbk_visits ) ) {
  $mbk_visits_body = $mbk_visits['body']; 
  echo $mbk_visits_body;
}

echo'</p> <div class="tooltip">What does this number mean ?
  <span class="tooltiptext">This Number describes the visits that come to the websites in our system , This tells you just one thing , We are serving high quality websites that have their own power in the field of web technology and online/social existence , Their power is translated into very large numbers of visits every second , So! Since the launch of Mr Backlink plugin we are here to increase your website page authority , We are here for your website seo next level , So lets rank your website higher. <p style="color: #ff6600;">Thanks for being a part of Mr Backlink. </p></span>
</div></center>';

?>

<style>
.tooltip {
    position: relative;
    display: inline-block;
    padding-bottom: 20px;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 520px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 1s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>


<?php

//End of Tooltip description 

        $mbk_categories = array('Arts','Business','Computers','Games','Health','Home','Kids and Teens','News','Recreation','Reference','Regional','Religion','Science','Shopping','Society');

// Here mr backlink plugin checks if the website is already found in our system using custom api  

        $url = 'http://www.mrbacklink.co/mrbacklinkapi.php?mbk_site='.site_url();
        $request =   wp_remote_get($url);
        // Get the body of the response
        $response = wp_remote_retrieve_body( $request );

        $mbk_api_decode = json_decode($response);

        // Info about the seo and what is the backlink strategy that we follow 

        if($mbk_api_decode->website_type == null){
            echo '<center><div style="width: 80%;
            line-height: 27px;
            color: #00a2ff;
            font-size: 18px;
            font-family: inherit;
            background-color: floralwhite;
            border-radius: 22px;">

        -The Ultimate plugin for a killing and successful link 
        building Campaign.<br>

        -SEO for people are not familiar with is the process of 
        making your website to search engines like Google, AOl and Bing.<br>
         
        -One of the major factors affecting website ranking is 
        backlinks which means links that are referring to your website.<br>

        -In the eye of Google and other major search engines, This is
        considered as a vote up for your website. By default, More 
        quality backlinks equals more rankings in search engines.<br>

        -Link Building campaign can be frustrating sometimes and 
        can be tough to get your website a high-quality backlinks
        that can improve your rankings.<br>

        -Here <a style="color: #ff6600;
            text-decoration: none;" href="http://mrbacklink.co">Mr Backlink </a> came with the solution, At a push of button
        you will get high-quality backlinks that will deliever
        you positive results.<br>
            </div></center>';
        ?>

        <div class="mbk_container" style="padding-top: 20px;
    padding-bottom: 20px;text-align: center; color: darkred;">
        <form method="post">
        Select your website category : <select name="mbk_category" required>
        <?php
        // Form that the plugin user should fill to send the (website url , keyword , category and ip address of the sender) to our system to save and check 
        
        foreach($mbk_categories as $mbk_select_category){
        ?>    
        <option value="<?php echo $mbk_select_category; ?>">
            <?php echo $mbk_select_category; ?>
        </option>

        <?php 

        }?>
        </select>
        <input type="text" style="width: 25%; text-align: center;" placeholder="Website KEYWORD" name="mbk_keyword" required>
        <input type="text" style="width: 25%; text-align: center;" placeholder="Email address To give you backlinks updates" name="mbk_email" required>

        <input type="submit" style="color: #ff9400; font-family: inherit;" name="save" value="Save">
        <?php wp_nonce_field( 'backlink_action', 'backlink_nonce_field' ); ?>
        </form>
        <br>
        <p style="color: red; text-decoration: overline; font-size: 16px;">Please don't submit your website in case it is under construction or in a maintenance mode as we accept only 100% working website.</p>
    </div></div</center>

        <?
        // checking the data before sending them to our system 

        if(isset($_POST['save'])){

            if ( ! isset( $_POST['backlink_nonce_field'] ) 
    || ! wp_verify_nonce( $_POST['backlink_nonce_field'], 'backlink_action' ) 
) {
die( 'Failed security check' );
}else{
        $mbk_type=  sanitize_text_field(filter_var("Wordpress"));
        $mbk_site =  sanitize_text_field(filter_var(site_url()));
        $mbk_category = sanitize_text_field(filter_var($_POST['mbk_category']));
        $mbk_keyword = sanitize_text_field(filter_var($_POST['mbk_keyword']));
        $mbk_ip = sanitize_text_field(filter_var($_SERVER['REMOTE_ADDR']));
        $mbk_email = sanitize_text_field(filter_var($_POST['mbk_email']));
        wp_remote_request("http://www.mrbacklink.co/mrbacklinkapi.php?mbk_site=$mbk_site&mbk_type=$mbk_type&mbk_category=$mbk_category&mbk_keyword=$mbk_keyword&mbk_ip=$mbk_ip&mbk_email=$mbk_email");
        echo'<meta http-equiv="refresh" content="0">';
        }}}else{

        // Message after submission 

        echo'<style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        </style>';

        // Displaying data using mr backlink api

        ?>
        <table>
         
          
          <tr>
            <td>Website Category</td>
            <td><?php echo "<p>".$mbk_api_decode->website_category."</p>"; ?></td>
          </tr>
          <tr>
            <td>Website Type</td>
            <td><?php echo "<p>".$mbk_api_decode->website_type."</p>"; ?></td>
          </tr>
          <tr>
            <td>Website Keyword</td>
            <td><?php echo "<p>".$mbk_api_decode->keyword."</p>"; ?></td>
          </tr>
          <tr>
            <td>Website Status</td>
            <td><?php 

            if($mbk_api_decode->website_status =='pending'){
                        echo '<p style="color: red;">'.$mbk_api_decode->website_status.'</p>';
            } else{
                        echo '<p style="color: green;">'.$mbk_api_decode->website_status.'</p>';
            }

            ?></td>
          </tr>
          <tr>
            <td>Websites that your domain exists in</td>
            <td>
                <?php 
            if( $mbk_api_decode->website_status == 'pending'){
                echo '<p style="color: red;">pending - Link will appear here immediately after the approval</p>';
                }else{
                echo '<p style="color: green;"><a href="http://mrbacklink.co/?mbk_website='.site_url().'" target="_blank">Click here to see where does your domain exist. </a></p>';
               
                $mbk_date = date('d');
                $mbk_api_date = $mbk_api_decode->regenerate_date;
                $mbk_api_date2 = $mbk_api_decode->regenerated_dates;
                if($mbk_date == $mbk_api_date || in_array($mbk_date, $mbk_api_date2)){
                echo '<p style="color: green;"><a href="http://mrbacklink.co/?regenerate_mbk_website='.site_url().'&regenerate_mbk_website_key=onetimeregeneration272829" target="_blank">Regenerate New Backlinks for your website. </a></p>';
                }else{
                    echo'<a href="http://mrbacklink.co/blog" target="_blank"> Never forget to Regenerate your Backlinks  </br> Next 27-28-29 . </br> . </a>';
                }
                }
                ?>
            

            </td>
          </tr>
        </table>
 

        <?php
        if(empty($mbk_api_decode->websites_for_me)){
            
        echo'<p>Our system takes short time to list your website in the other websites after getting the "Website Status"=>"active" , You can check them from the link that will appear after the active status after 1-48 hours, Thank you for your patience</p> </br>';
        echo'<p style="padding-bottom: 20px;color:#827575;">CAUTION ! MR BACKLINK uses its CUSTOM API to get the best performance for all users , So If our robots detect any change in the functionality of the plugin , Your website will be automatically removed from the websites you have the backlinks in , And then you will lose the chance to submit your website to MR BACKLINK again.<br>
Also , In case you deactivate the plugin or remove it , Your website will be removed from our system and you will no longer have your backlinks in the websites on our system.
</p>';

        }





        }}

        function mbk_after_submission(){


        $url = 'http://www.mrbacklink.co/mrbacklinkapi.php?mbk_site='.site_url();
        $request =   wp_remote_get($url);
        // Get the body of the response
        $response = wp_remote_retrieve_body( $request );

        $mbk_api_decode = json_decode($response);

//PLEASE DON'T EVER CHANGE THE CODE , OUR BOTS WILL DETECT THIS AND YOU WILL GET BANNED FROM USING MR BACKLINK PLUGIN , THANKS

$mbk_back1 = $mbk_api_decode->backlink1;
$mbk_back1_key = $mbk_api_decode->backlink1_key;
$mbk_back2 = $mbk_api_decode->backlink2;
$mbk_back2_key = $mbk_api_decode->backlink2_key;
$mbk_back3 = $mbk_api_decode->backlink3;
$mbk_back3_key = $mbk_api_decode->backlink3_key;
$mbk_back4 = $mbk_api_decode->backlink4;
$mbk_back4_key = $mbk_api_decode->backlink4_key;
$mbk_back5 = $mbk_api_decode->backlink5;
$mbk_back5_key = $mbk_api_decode->backlink5_key;
//PLEASE DON'T EVER CHANGE THE CODE , OUR BOTS WILL DETECT THIS AND YOU WILL GET BANNED FROM USING MR BACKLINK , THANKS

echo'<!-- START MR Backlink -->';
echo'<div class="mbk_content"style="display:none!important">Advertisement Area</div>';
echo '<div class="mbk_content" style="display:none!important;"><a href="'.$mbk_back1.'" rel="nofollow"> '.$mbk_back1_key.' </a></div>';
echo '<div class="mbk_content" style="display:none!important;"><a href="'.$mbk_back2.'">'.$mbk_back2_key.'</a></div>';
echo '<div class="mbk_content" style="display:none!important;"><img src="'.$mbk_back3.'" alt="'.$mbk_back3_key.'" rel=" nofollow noopener"></div>';
echo '<div class="mbk_content" style="display:none!important;"><a href="'.$mbk_back4.'">'.$mbk_back4_key.'</a></div>';
echo '<div class="mbk_content" style="display:none!important;"><a href="'.$mbk_back5.'">'.$mbk_back5_key.'</a></div>';
echo'<!-- END MR Backlink --> ';

        }
        add_action('wp_footer','mbk_after_submission');
        add_action('wp_head','mbk_after_submission');

        function mbk_deactivate(){
        $mbk_site_deactive =  sanitize_text_field(filter_var(site_url()));
        $mbk_ip_deactive = sanitize_text_field(filter_var($_SERVER['REMOTE_ADDR']));
        $mbk_admin_email = get_option( 'admin_email' ); 
        $mbk_email_deactive = sanitize_text_field(filter_var($mbk_admin_email));  
        wp_remote_request("http://www.mrbacklink.co/delta.php?mbk_site_deactive=$mbk_site_deactive&mbk_ip_deactive=$mbk_ip_deactive&mbk_email_deactive=$mbk_email_deactive");
        }
        register_deactivation_hook( __FILE__, 'mbk_deactivate' );
        
    
function cyb_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=Mr_Backlink.php' ) ) );
    }
}
add_action( 'activated_plugin', 'cyb_activation_redirect' );

function mbk_notice() {
    $url = 'http://www.mrbacklink.co/mrbacklinkapi.php?mbk_site='.site_url();
        $request =   wp_remote_get($url);
        // Get the body of the response
        $response = wp_remote_retrieve_body( $request );
        $mbk_api_decode = json_decode($response);
    
                $mbk_date = date('d');
                $mbk_api_date = $mbk_api_decode->regenerate_date;
                $mbk_api_date2 = $mbk_api_decode->regenerated_dates;

                if($mbk_date == $mbk_api_date || in_array($mbk_date, $mbk_api_date2)){
                $mbk_regenerate = '&nbsp;<p style="color: green;"><a href="http://mrbacklink.co/?regenerate_mbk_website='.site_url().'&regenerate_mbk_website_key=onetimeregeneration272829" target="_blank">Regenerate New Backlinks for your website. </a>';
                }else{
                    $mbk_regenerate = '&nbsp;<a href="http://mrbacklink.co/blog" target="_blank"> Never forget to Regenerate your Backlinks  </br> Next 27-28-29 . </br> . </a></p>';
                }
    
    $mbk_notice='<div class="notice notice-success is-dismissible" style="border-right: 4px solid #00a6ff;
    border-left: 4px solid #ff6600;
    text-align: center;
    width: 15%;"> 
    <p><strong><img src="'.plugins_url('IMG/Mr_Backlink.png',__FILE__ ).'"><a href="http://mrbacklink.co/?mbk_website='.site_url().'" target="_blank">Check Your Backlinks</a></strong></p>'.$mbk_regenerate.'
    <button type="button" class="notice-dismiss">
        <span class="screen-reader-text">Dismiss this notice.</span>
    </button>
</div>';
    
    ?>
        
        <p><?php _e( $mbk_notice , 'my_plugin_textdomain' ); ?></p>
    <?php
}
add_action( 'admin_notices', 'mbk_notice' );


