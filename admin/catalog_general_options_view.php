<?php

function html_show_general_options($param_values){  //  var_dump($param_values); ?>



<div class="wrap">

<?php $path_site2 = plugins_url("../images", __FILE__); ?>

<div id="poststuff">
		<?php $path_site2 = plugins_url("../images/", __FILE__); ?>
                <div style="float: left;">
                    <div><a href="http://huge-it.com/wordpress-plugins-product-catalog-user-manual/" target="_blank">User Manual</a></div>
                    <div>This section allows you to configure the Product Catalog options. <a href="http://huge-it.com/wordpress-plugins-product-catalog-user-manual/" target="_blank">More...</a></div>
                </div>
                <div style="float: right;">
                        <a class="header-logo-text" href="http://huge-it.com/product-catalog/" target="_blank">
                                <div><img width="250px" src="<?php echo $path_site2; ?>/huge-it1.png" /></div>
                                <div>Get the full version</div>
                        </a>
                </div>
                <div style="clear:both;"></div>
		<div id="post-body-content" class="catalog-options">
			<div id="post-body-heading">
				<h3>General Options</h3>
				<a onclick="document.getElementById('adminForm').submit()" class="save-catalog-options button-primary">Save</a>
		
			</div>
		<form action="admin.php?page=huge_it_catalog_general_options_page&task=save" method="post" id="adminForm" name="adminForm">
		<div id="catalog-options-list">
			
			
			<ul class="options-block" id="catalog-view-tabs-contents">

				<li id="catalog-view-options-0">
					                                    
					
                                        <div style="">
                                            <h3>Translations</h3>
						<div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_price_text">Price Block Text</label>
							<input type="text" name="params[ht_single_product_price_text]" id="ht_single_product_price_text" value="<?php echo $param_values['ht_single_product_price_text']; ?>" class="text" />
                                                </div>
                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_share_text">Share Block Text</label>
							<input type="text" name="params[ht_single_product_share_text]" id="ht_single_product_share_text" value="<?php echo $param_values['ht_single_product_share_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_rating_text">Rating Block Text</label>
							<input type="text" name="params[ht_single_product_rating_text]" id="ht_single_product_rating_text" value="<?php echo $param_values['ht_single_product_rating_text']; ?>" class="text" />
						</div>
                                                 <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_parameters_text">Parameters Tab Title Text</label>
							<input type="text" name="params[ht_single_product_parameters_text]" id="ht_single_product_parameters_text" value="<?php echo $param_values['ht_single_product_parameters_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_comments_text">Comments Tab Title Text</label>
							<input type="text" name="params[ht_single_product_comments_text]" id="ht_single_product_comments_text" value="<?php echo $param_values['ht_single_product_comments_text']; ?>" class="text" />
						</div>
                                               
                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_your_name_text">Name Label Text</label>
							<input type="text" name="params[ht_single_product_your_name_text]" id="ht_single_product_your_name_text" value="<?php echo $param_values['ht_single_product_your_name_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_your_Comment_text">Comment Label Text</label>
							<input type="text" name="params[ht_single_product_your_Comment_text]" id="ht_single_product_your_Comment_text" value="<?php echo $param_values['ht_single_product_your_Comment_text']; ?>" class="text" />
						</div>
                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_captcha_text">Captcha Label Text</label>
							<input type="text" name="params[ht_single_product_captcha_text]" id="ht_single_product_captcha_text" value="<?php echo $param_values['ht_single_product_captcha_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_invalid_captcha_text">Captcha Error Message Text</label>
							<input type="text" name="params[ht_single_product_invalid_captcha_text]" id="ht_single_product_invalid_captcha_text" value="<?php echo $param_values['ht_single_product_invalid_captcha_text']; ?>" class="text" />
						</div>

                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_asc_to_seller_text">Order Popup Title</label>
							<input type="text" name="params[ht_single_product_asc_to_seller_text]" id="ht_single_product_asc_to_seller_text" value="<?php echo $param_values['ht_single_product_asc_to_seller_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_your_mail_text">E-mail Input Text</label>
							<input type="text" name="params[ht_single_product_your_mail_text]" id="ht_single_product_your_mail_text" value="<?php echo $param_values['ht_single_product_your_mail_text']; ?>" class="text" />
						</div>
                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_invalid_mail_text">E-mail Error Message Text</label>
							<input type="text" name="params[ht_single_product_invalid_mail_text]" id="ht_single_product_invalid_mail_text" value="<?php echo $param_values['ht_single_product_invalid_mail_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_your_phone_text">Phone Input Text</label>
							<input type="text" name="params[ht_single_product_your_phone_text]" id="ht_single_product_your_phone_text" value="<?php echo $param_values['ht_single_product_your_phone_text']; ?>" class="text" />
						</div>
                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_your_message_text">Message Input Text</label>
							<input type="text" name="params[ht_single_product_your_message_text]" id="ht_single_product_your_message_text" value="<?php echo $param_values['ht_single_product_your_message_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_catalog_general_linkbutton_text">Product Button Text</label>
							<input type="text" name="params[ht_catalog_general_linkbutton_text]" id="ht_catalog_general_linkbutton_text" value="<?php echo $param_values['ht_catalog_general_linkbutton_text']; ?>" class="text" />
						</div>
                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_asc_seller_button_text">Order Button Text</label>
							<input type="text" name="params[ht_single_product_asc_seller_button_text]" id="ht_single_product_asc_seller_button_text" value="<?php echo $param_values['ht_single_product_asc_seller_button_text']; ?>" class="text" />
						</div>
                                                <div class="has-background" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_comments_submit_button_text">Comments Submit Button Text</label>
							<input type="text" name="params[ht_single_product_comments_submit_button_text]" id="ht_single_product_comments_submit_button_text" value="<?php echo $param_values['ht_single_product_comments_submit_button_text']; ?>" class="text" />
						</div>
                                                <div class="" style="padding-bottom: 6px;">
                                                        <label for="ht_single_product_asc_seller_popup_button_text">Order Popup Button Text</label>
							<input type="text" name="params[ht_single_product_asc_seller_popup_button_text]" id="ht_single_product_asc_seller_popup_button_text" value="<?php echo $param_values['ht_single_product_asc_seller_popup_button_text']; ?>" class="text" />
						</div>
					</div>
                                    
                                        <div>
						<h3>Email To Administrator</h3>
						<div class="has-background">
							<label for="ht_catalog_general_message_to_admin">Send Message To Administrator After Each Submission</label>
							<input type="hidden" value="off" name="params[ht_catalog_general_message_to_admin]" />
							<input type="checkbox" id="ht_catalog_general_message_to_admin"  <?php  if($param_values['ht_catalog_general_message_to_admin']  == 'on'){ echo 'checked="checked"'; } ?>  name="params[ht_catalog_general_message_to_admin]" value="on" />
						</div>
                                                <div class="">
							<label for="ht_catalog_general_admin_email">Administrator E-mail</label>
							<input name="params[ht_catalog_general_admin_email]" type="text" class="color" id="ht_catalog_general_admin_email" value="<?php echo $param_values['ht_catalog_general_admin_email']; ?>" size="10" />
							
						</div>
						<div class="has-background">
							<label for="ht_catalog_general_admin_email_subject">Message Subject</label>
							<input name="params[ht_catalog_general_admin_email_subject]" type="text" class="color" id="ht_catalog_general_admin_email_subject" value="<?php echo $param_values['ht_catalog_general_admin_email_subject']; ?>" size="10" />
							
						</div>
                                                <div>
							<label for="ht_catalog_general_admin_from_text">From</label>
							<input name="params[ht_catalog_general_admin_from_text]" type="text" class="color" id="ht_catalog_general_admin_from_text" value="<?php echo $param_values['ht_catalog_general_admin_from_text']; ?>" size="10" />
							
						</div>
						<div style="height: auto;" class="has-background">
							<label for="form_adminstrator_message">Message</label>
							<?php
//								function wptiny($initArray){
//									$initArray['height'] = '250px';
//									return $initArray;
//								}
//								add_filter('tiny_mce_before_init', 'wptiny');
								wp_editor($param_values['ht_catalog_general_admin_email_message'], "adminmessage"); 
							?>
						<div class="clear"></div>
						</div>
					</div>
                                    
                                        <div style="//margin-top: -70px;">
						<h3>Email To User</h3>
						<div class="has-background">
							<label for="ht_catalog_general_message_to_user">Send Confirming Message To Users After Submitting</label>
							<input type="hidden" value="off" name="params[ht_catalog_general_message_to_user]" />
							<input type="checkbox" id="ht_catalog_general_message_to_user"  <?php if($param_values['ht_catalog_general_message_to_user']  == 'on'){ echo 'checked="checked"'; } ?>  name="params[ht_catalog_general_message_to_user]" value="on" />
						</div>
						
						<div class="">
							<label for="ht_catalog_general_user_subject">Message Subject</label>
							<input name="params[ht_catalog_general_user_subject]" type="text" class="color" id="ht_catalog_general_user_subject" value="<?php echo $param_values['ht_catalog_general_user_subject']; ?>" size="10" />
							
						</div>
						<div style="height: auto;" class="has-background" >
							<label for="form_adminstrator_message">Message</label>
							<?php
//								function wptiny($initArray){
//									$initArray['height'] = '250px';
//									return $initArray;
//								}
//								add_filter('tiny_mce_before_init', 'wptiny');
								wp_editor($param_values['ht_catalog_general_user_message'], "usermessage"); 
							?>
						<div class="clear"></div>
						</div>
					</div>
                                    <div style="/*margin-top: -355px*/">
                                        <h3>Contact Seller Button</h3>
                                        <div class="has-background">
                                                <label for="ht_single_product_show_asc_seller_button">Show Contact Seller Button</label>
                                                <input type="hidden" value="off" name="params[ht_single_product_show_asc_seller_button]" />
                                                <input type="checkbox" id="ht_single_product_show_asc_seller_button"  <?php if($param_values['ht_single_product_show_asc_seller_button']  == 'on'){ echo 'checked="checked"'; } ?>  name="params[ht_single_product_show_asc_seller_button]" value="on" />
                                        </div>
                                    </div>
                                    
				</li>
			</ul>

		<div id="post-body-footer">
			<a onclick="document.getElementById('adminForm').submit()" class="save-catalog-options button-primary">Save</a>
			<div class="clear"></div>
		</div>
		</form>
		</div>
	</div>
    </div>
</div>

<style>
    
.wp-media-buttons {display:none !important;}

.wp-editor-area { max-height: 250px; }

.catalog-options   div label .help {
    float: right;
    position:relative;
    display:inline-block;
    width:20px;
    height:20px;
    margin:0px 10px 0px 20px;
    border: 1px solid #888;
    border-radius: 20px;
    text-indent: 7px;
}

.catalog-options   div label .help:hover {
    border: 1px solid #1e8cbe;
    border-radius: 20px;
    text-indent: 7px;
}

.catalog-options   div  .help-block {
     position:absolute;
     min-width:250px;
     padding:5px;
     top:30px;
     left: -121px;
     background:#fff;
     border:1px solid #aaa;
     border-radius: 3px;
     display:none;
     font-size: 12px;
     z-index:5;
    text-align:justify;
}

.catalog-options  div  .help-block.active {
    display:block;
}

.catalog-options  div  .help-block .pnt {
    position:absolute;
    width:10px;
    height:11px;
    top:-10px;
    left:50%;
    margin-left:-5px;
    background:url(../images/help.box.pnt.gif) left top no-repeat;
}

.catalog-options div  .help-block p {
    margin: 0px;
    padding: 0px;
    text-indent: 0px;
}

#post-body-heading {
	width:100%;
	padding:10px 0px 10px 0px;
	height:30px;
	background:#fff;
	border-bottom: 1px solid #e5e5e5;
}

.catalog-options #post-body-heading {width:100%;}

#post-body-heading h3 {
	float:left;
	margin:-5px 0px 0px 5px !important;
	padding:0px;
}

#post-body-heading .button,#post-body-heading .save-catalog-options  {
	float:right;
	margin-right:10px !important;
}

#post-body-heading .button.add-post-slide input {
	position:absolute;
	display:none;
}

#post-body-heading .button.add-new-image .wp-media-buttons-icon {
	background: url('../../../../wp-admin/images/media-button.png') no-repeat top left;
	display: inline-block;
	width: 140px;
	height: 24px;
	vertical-align: text-top;
	color: #fff;
	-webkit-box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	border: none; 
	padding-left: 22px;
	background-position: 0px;
	margin-right: 0px !important;
}

#post-body-heading .button.add-new-catalog .wp-media-buttons-icon {
	background: url('../../../../wp-admin/images/media-button.png') no-repeat top left;
	display: inline-block;
	width: 140px;
	height: 24px;
	vertical-align: text-top;
	color: #fff;
	-webkit-box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	border: none; 
	padding-left: 22px;
	background-position: 0px;
	margin-right: 0px !important;
}

#post-body-heading .button.add-post-slide .wp-media-buttons-icon {
	background: url('../../../../wp-admin/images/post-ats.png') no-repeat top left;
	display: inline-block;
	width: 16px;
	height: 16px;
	vertical-align: text-top;
	margin: 2px 7px 0px 0px;
}

#post-body-footer{
    float: right;
}

#catalog-options-list {
	width:100%;
	background:#fff;
}

#catalog-view-tabs-contents > li  {
	position:relative;
	width:100%;
	float:left;
	display:block;
        background: #fff;
}




#catalog-view-tabs-contents > li  > div {
	position:relative;
	display:block;
	float:left;
	margin:10px 1% 25px 1%;
	padding:0px 1% 10px 1%;
	width:46%;
	background:#f9f9f9;
}
#catalog-view-tabs-contents > li   div.has-background {background:#fff;}
#catalog-view-tabs-contents > li   div.has-height > div {display:inline-block;}


#catalog-view-tabs-contents > li  > div  h3 {
	display:block;
	text-align:center;
	margin:0px 0px 10px 0px;
}

#catalog-view-tabs-contents > li  > div > div {
	position:relative;
	clear:both;
	width:100%;
	height:35px;
	padding:5px 0px 0px 0px;
	margin:0px !important;
}

#catalog-view-tabs-contents > li  > div > div label {
	display:inline-block;
	width:60%;
	padding:5px 0px 0px 2%;
	height:30px;
	float:left;
}



#catalog-view-tabs-contents > li  > div > div div.slider-container {
	position:relative;
	display: inline-block;
	width: 145px;
	margin-left:-5px;
}

#catalog-view-tabs-contents > li  > div > div div.slider-container span {
	position:absolute;
	top:-3px;
	right:0px;
}

#catalog-view-tabs-contents > li  > div > div input[type='text'],#catalog-view-tabs-contents > li  > div > div select {
	width: 190px;
}

#catalog-view-tabs-contents > li  > div > div input[type='checkbox'] {
	margin:7px 0px 3px 0px;
}

#catalog-view-tabs-contents > li  > div > div.bws_position_table input {
	margin:3px 17px 3px 3px;
}

#catalog-view-tabs-contents > li > div:first-child > div{
	height: 60px !important;
        margin-bottom: 10px;
}
#catalog-view-tabs-contents > li > div:first-child > div label {
	display: block !important;
	width: 100% !important;
	padding: 5px 0px 0px 2% !important;
	height: 20px !important;
	float: left !important;
}
#catalog-view-tabs-contents > li > div:first-child > div input {
	display: block !important;
	width: 97% !important;
	margin: 0px 0px 0px 2% !important;
	height: 25px !important;
	float: left !important;
}


</style>

<?php }


?>