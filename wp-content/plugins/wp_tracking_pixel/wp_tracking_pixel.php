<?php
/*
 * Plugin Name: AffiliateWP - Pixel Tracking
 * Description: Plugin for Pixel Tracking on AffiliateWP
 * Author: Manjunath Sharma K
 * Version: 1.1
 * @package AffiliateWP
 * @category Core
 * @author Manjunath Sharma K
 * @version 1.1
 */

function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

//Postback functionality after member registration
add_action( 'affwp_insert_new_referral', 'my_registration_complete', 10, 1 );
function my_registration_complete( $user_id ) {
    global $wpdb;
	//$campaign_id=(($_GET['campaign'] == '') ? NULL : $_GET['campaign']);

    //Get all the available parameters
    $all_parameters=$wpdb->get_results("SELECT wp_affiliate_s2s_change_tag1,wp_affiliate_s2s_change_tag2,wp_affiliate_s2s_change_tag3,wp_affiliate_s2s_parameter_for_dynamic_replace1,wp_affiliate_s2s_parameter_for_dynamic_replace2,wp_affiliate_s2s_parameter_for_dynamic_replace3 FROM wp_affiliate_wp_affiliate_pixel_data where wp_affiliate_s2s_active=1 and affiliate_id='".$_GET['ref']."'");
    $parameters=array();
    foreach($all_parameters as $parameter){
        $parameters[replace1][]=$parameter->wp_affiliate_s2s_change_tag1;
        $parameters[replace2][]=$parameter->wp_affiliate_s2s_change_tag2;
        $parameters[replace3][]=$parameter->wp_affiliate_s2s_change_tag3;
        $parameters[replace1][]=$parameter->wp_affiliate_s2s_parameter_for_dynamic_replace1;
        $parameters[replace2][]=$parameter->wp_affiliate_s2s_parameter_for_dynamic_replace2;
        $parameters[replace3][]=$parameter->wp_affiliate_s2s_parameter_for_dynamic_replace3;
    }
   $wpdb->update(
        'wp_affiliate_wp_referrals',
        array(
            'click_id' => $_GET['click_id'],
        ),
       array('affiliate_id'=>$_GET['ref'],'context'=>'ultimate_member_signup','type'=>'lead','reference'=>$user_id),
        array('%s')
        );
    $postback_url=$wpdb->get_results("SELECT wp_affiliate_s2s_postback_url FROM wp_affiliate_wp_affiliate_pixel_data where wp_affiliate_s2s_active=1 and affiliate_id='".$_GET['ref']."'");
    $URL=$postback_url[0]->wp_affiliate_s2s_postback_url;
    if($URL != NULL){
    foreach($parameters as $param){
        if($param[1]=='user_id'){
            $_GET[$param[1]]=$user_id;
        }
        $URL=str_replace($param[0],$_GET[$param[1]],$URL);
    }
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $URL);
    $data = curl_exec($handle);
    $wpdb->update(
        'wp_affiliate_wp_referrals',
        array(
            'postback_response' => $data,
        ),
        array('affiliate_id'=>$_GET['ref'],'context'=>'ultimate_member_signup','type'=>'lead','reference'=>$user_id),
        array('%s')
        );
    curl_close($handle);
    }

}

//Global Pixel Tracking Code
add_action('wp_footer','injectGlobalScript');
function injectGlobalScript() {
    global $wpdb;
    $scripts = $wpdb->get_results("SELECT wp_affiliate_global_tracking_pixel FROM wp_affiliate_wp_affiliate_pixel_data ");
    foreach($scripts as $script){
        $data = stripslashes($script->wp_affiliate_global_tracking_pixel);
       echo $data;
    }
}

//CPL Tracking Code
add_action('wp_footer','injectCPLScript');
function injectCPLScript() {
    global $wpdb;
    //$page_id = get_id_by_slug('shop');//Fetch Current Page Id - Hardcoding for Shop Page
    $page_id = get_queried_object_id();
    if(is_shop()) { //If it is shop page
        $page_id = get_id_by_slug('shop');
    }
    $lead_id= get_current_user_id();
    //echo "PAAGE ID:".$page_id."____LEAD ID:".$lead_id ;
    $scriptCpt = $wpdb->get_results("SELECT wp_affiliate_cpl_active,wp_affiliate_cpl_management FROM wp_affiliate_wp_affiliate_pixel_data where wp_affiliate_cpl_active='1' and wp_affiliate_cpl_active_forms='".$page_id."'");
    foreach ($scriptCpt as $cpt_info) {
      if($cpt_info->wp_affiliate_cpl_management !=''){
        $data = stripslashes($cpt_info->wp_affiliate_cpl_management);
        $r_data=str_replace("{LEAD_ID}",$lead_id,$data);
        echo $r_data;
      }
    }
}

//CPA Tracking Code
add_action('wp_footer','injectCPAScript');
function injectCPAScript() {
    global $wpdb;
    $scripts = $wpdb->get_results("SELECT wp_affiliate_cpa_active,wp_affiliate_cpa_management FROM wp_affiliate_wp_affiliate_pixel_data");
    foreach($scripts as $script){
        if($script->wp_affiliate_cpa_active){
            $data = stripslashes($script->wp_affiliate_cpa_management);
           echo $data;
        }
    }
}


//Add pixel tracking fields in Affiliate Add form
add_action('affwp_new_affiliate_end', 'addPixelFieldsInNew');
function addPixelFieldsInNew(){
    $args = array(
        'child_of'     => 0,
        'sort_order'   => 'ASC',
        'sort_column'  => 'post_title',
        'hierarchical' => 1,
        'exclude'      => array(),
        'include'      => array(),
        'meta_key'     => '',
        'meta_value'   => '',
        'authors'      => '',
        'parent'       => -1,
        'exclude_tree' => array(),
        'number'       => '',
        'offset'       => 0,
        'post_type'    => 'page',
        'post_status'  => 'publish',
    );
    $pages=get_pages($args);
    $all_pages=array();
    $all_pages_data=array();
    foreach($pages as $page){
        $all_pages_data['title']=$page->post_title;
        $all_pages_data['id']=$page->ID;
        $all_pages[]=$all_pages_data;
    }
        ?>

		<tr class="form-row" id="affwp-global-tracking-pixel-row">

				<th scope="row">
					<label for="global_tracking_pixel"><?php _e( 'Global Tracking Pixel', 'affiliate-wp' ); ?></label>
				</th>

				<td>
					<label class="description">
					<textarea name="global_tracking_pixel" rows="5" cols="50" id="global_tracking_pixel" class="large-text"></textarea>

					</label>
				</td>

			</tr>

			<tr class="form-row" id="affwp-cpl-management-row">

				<th scope="row">
					<label for="cpl_management"><?php _e( 'CPL Management', 'affiliate-wp' ); ?></label>

				</th>

				<td>
					<label class="description"><input type="checkbox" name="cpl_activer" id="cpl_activer" value="1" /><?php _e( 'Active', 'affiliate-wp' ); ?></label>
					<textarea name="cpl_management" rows="5" cols="50" id="cpl_management" class="large-text" ></textarea>
					<label for="active_forms"><?php _e( 'Active Forms', 'affiliate-wp' ); ?></label>
					<select name="active_forms" id="active_forms">

					<?php
					foreach($all_pages as $each_page){
					    ?>
					    <option value="<?php echo $each_page['id'];?>" <?php /* if($each_page['id']==831){?> selected="selected" <?php } */ ?>><?php echo $each_page['title'];?></option>
					    <?php

					}?>
					</select>

				</td>

			</tr>
			<tr class="form-row" id="affwp-cpl-management-row">

				<th scope="row">
					<label for="cpa_management"><?php _e( 'CPA Management', 'affiliate-wp' ); ?></label>

				</th>

				<td>
					<label class="description"><input type="checkbox" name="cpa_activer" id="cpa_activer" value="1" /><?php _e( 'Active', 'affiliate-wp' ); ?></label>
					<textarea name="cpa_management" rows="5" cols="50" id="cpa_management" class="large-text" ></textarea>
				</td>

			</tr>
			<tr class="form-row" id="affwp-cpl-management-row">

				<th scope="row">
					<label for="s2s_postback_url"><?php _e( 'S2S Postback URL', 'affiliate-wp' ); ?></label>
				</th>

				<td>
					<label class="description">
						<input type="checkbox" name="s2s_activer" id="s2s_activer" value="1" /><?php _e( 'Active', 'affiliate-wp' ); ?>
					</label>
					<table class="form-table postback_table">

						<tr>
							<td colspan="2"><div><strong>Postback URL</strong></div><input type="text" name="s2s_postback_url" id="s2s_postback_url" class="large-text" /></td>
						</tr>
						<tr>
							<td>
								<table>
									<tr>
										<th>Parameter Change</th>
										<th>Parameter Replace</th>
									</tr>
									<tr>
										<td><input type="text" name="change_tag1" id="change_tag1" class="regular-text" value="<?php echo $pixel->wp_affiliate_s2s_change_tag;?>"/></td>
										<td><input type="text" name="param_for_dynamic_replace1" id="param_for_dynamic_replace1" class="regular-text" value="<?php echo $pixel->wp_affiliate_s2s_parameter_for_dynamic_replace;?>" />	</td>
									</tr>
									<tr>
										<td><input type="text"  name="change_tag2" id="change_tag2" class="regular-text" value="<?php echo $pixel->wp_affiliate_s2s_change_tag;?>"/></td>
										<td><input type="text" name="param_for_dynamic_replace2" id="param_for_dynamic_replace2" class="regular-text" value="<?php echo $pixel->wp_affiliate_s2s_parameter_for_dynamic_replace;?>" /></td>
									</tr>
									<tr>
										<td><input type="text"  name="change_tag3" id="change_tag3" class="regular-text" value="<?php echo $pixel->wp_affiliate_s2s_change_tag;?>"/></td>
										<td><input type="text"  name="param_for_dynamic_replace3" id="param_for_dynamic_replace3" class="regular-text" value="<?php echo $pixel->wp_affiliate_s2s_parameter_for_dynamic_replace;?>" />	</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>

    <?php

}

//Add pixel tracking fields in Affiliate form Edit
add_action('affwp_edit_affiliate_end', 'addPixelFieldsInEdit');
function addPixelFieldsInEdit($affiliate){
    global $wpdb;
    $args = array(
        'child_of'     => 0,
        'sort_order'   => 'ASC',
        'sort_column'  => 'post_title',
        'hierarchical' => 1,
        'exclude'      => array(),
        'include'      => array(),
        'meta_key'     => '',
        'meta_value'   => '',
        'authors'      => '',
        'parent'       => -1,
        'exclude_tree' => array(),
        'number'       => '',
        'offset'       => 0,
        'post_type'    => 'page',
        'post_status'  => 'publish',
    );
    $pages=get_pages($args);
    $all_pages=array();
    $all_pages_data=array();
    foreach($pages as $page){
        $all_pages_data['title']=$page->post_title;
        $all_pages_data['id']=$page->ID;
        $all_pages[]=$all_pages_data;
    }
    $pixel_data = $wpdb->get_results("SELECT * FROM wp_affiliate_wp_affiliate_pixel_data where affiliate_id='".$affiliate->affiliate_id."'");
    if($pixel_data == NULL){
        addPixelFieldsInNew();
        return;
    }
    foreach($pixel_data as $pixel){
    ?>

		<tr class="form-row" id="affwp-global-tracking-pixel-row">

				<th scope="row">
					<label for="global_tracking_pixel"><?php _e( 'Global Tracking Pixel', 'affiliate-wp' ); ?></label>
				</th>

				<td>
					<label class="description">
					<textarea name="global_tracking_pixel" rows="5" cols="50" id="global_tracking_pixel" class="large-text"><?php echo stripslashes($pixel->wp_affiliate_global_tracking_pixel);?></textarea>

					</label>
				</td>

			</tr>

			<tr class="form-row" id="affwp-cpl-management-row">

				<th scope="row">
					<label for="cpl_management"><?php _e( 'CPL Management', 'affiliate-wp' ); ?></label>

				</th>

				<td>
					<label class="description"><input type="checkbox" name="cpl_activer" id="cpl_activer" value="1" <?php ($pixel->wp_affiliate_cpl_active) ? $checked="checked" : $checked= "" ; echo $checked;?>/><?php _e( 'Active', 'affiliate-wp' ); ?></label>
					<textarea name="cpl_management" rows="5" cols="50" id="cpl_management" class="large-text" ><?php echo stripslashes($pixel->wp_affiliate_cpl_management);?></textarea>
					<label for="active_forms"><?php _e( 'Active Forms', 'affiliate-wp' ); ?></label>
					<select name="active_forms" id="active_forms">

					<?php
					foreach($all_pages as $each_page){
					    ?>
					    <option value="<?php echo $each_page['id'];?>" <?php ($each_page['id']==$pixel->wp_affiliate_cpl_active_forms) ? $selected = "selected" : $selected="";echo $selected;?> <?php /* if($each_page['id']==831){?> selected="selected" <?php } */ ?>><?php echo $each_page['title'];?></option>
					    <?php

					}?>
					</select>

				</td>

			</tr>
			<tr class="form-row" id="affwp-cpl-management-row">

				<th scope="row">
					<label for="cpa_management"><?php _e( 'CPA Management', 'affiliate-wp' ); ?></label>

				</th>

				<td>
					<label class="description"><input type="checkbox" name="cpa_activer" id="cpa_activer" value="1" <?php ($pixel->wp_affiliate_cpa_active) ? $checked="checked" : $checked= "" ; echo $checked;?>/><?php _e( 'Active', 'affiliate-wp' ); ?></label>
					<textarea name="cpa_management" rows="5" cols="50" id="cpa_management" class="large-text" ><?php echo stripslashes($pixel->wp_affiliate_cpa_management);?></textarea>


				</td>

			</tr>
			<tr class="form-row" id="affwp-cpl-management-row">

				<th scope="row">
					<label for="s2s_postback_url"><?php _e( 'S2S Postback URL', 'affiliate-wp' ); ?></label>

				</th>

				<td>
					<label class="description">
						<input type="checkbox" name="s2s_activer" id="s2s_activer" value="1" <?php ($pixel->wp_affiliate_s2s_active) ? $checked="checked" : $checked= "" ; echo $checked;?>/><?php _e( 'Active', 'affiliate-wp' ); ?>
					</label>
					<table class="form-table postback_table">
						<tr>
							<td colspan="2"><div><strong>Postback URL</strong></div></td>
						</tr>
						<tr>
							<td colspan="2"><input type="text" name="s2s_postback_url" id="s2s_postback_url" class="large-text" value="<?php echo $pixel->wp_affiliate_s2s_postback_url;?>" />	</td>
						</tr>
						<tr>
							<td>
								<table>
									<tr>
										<th>Parameter Change</th>
										<th>Parameter Replace</th>
									</tr>
									<tr>
										<td><input type="text"  name="change_tag1" id="change_tag1" class="large-text" value="<?php echo $pixel->wp_affiliate_s2s_change_tag1;?>"/></td>
										<td><input type="text"  name="param_for_dynamic_replace1" id="param_for_dynamic_replace1" class="large-text" value="<?php echo $pixel->wp_affiliate_s2s_parameter_for_dynamic_replace1;?>" />	</td>
									</tr>
									<tr>
										<td><input type="text"  name="change_tag2" id="change_tag2" class="large-text" value="<?php echo $pixel->wp_affiliate_s2s_change_tag2;?>"/></td>
										<td><input type="text"  name="param_for_dynamic_replace2" id="param_for_dynamic_replace2" class="large-text" value="<?php echo $pixel->wp_affiliate_s2s_parameter_for_dynamic_replace2;?>" /></td>
									</tr>
									<tr>
										<td><input type="text"  name="change_tag3" id="change_tag3" class="large-text" value="<?php echo $pixel->wp_affiliate_s2s_change_tag3;?>"/></td>
										<td><input type="text"  name="param_for_dynamic_replace3" id="param_for_dynamic_replace3" class="large-text" value="<?php echo $pixel->wp_affiliate_s2s_parameter_for_dynamic_replace3;?>" />	</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>

    <?php }

}


//Insert Pixel tracking data on Insert of Affiliate
add_action('affwp_insert_affiliate', 'addFieldsToDB',0);
function addFieldsToDB($affiliate_id, $args){
    global $wpdb;
    $wpdb->insert(
    'wp_affiliate_wp_affiliate_pixel_data',
    array(
    'affiliate_id' => $affiliate_id,
    'wp_affiliate_global_tracking_pixel' => $_POST['global_tracking_pixel'],
    'wp_affiliate_cpl_active'=>$_POST['cpl_activer'],
    'wp_affiliate_cpl_management'=>$_POST['cpl_management'],
    'wp_affiliate_cpl_active_forms'=>$_POST['active_forms'],
    'wp_affiliate_cpa_active'=>$_POST['cpa_activer'],
    'wp_affiliate_cpa_management'=>$_POST['cpa_management'],
    'wp_affiliate_s2s_active'=>$_POST['s2s_activer'],
    'wp_affiliate_s2s_postback_url'=>$_POST['s2s_postback_url'],
    'wp_affiliate_s2s_change_tag1'=>$_POST['change_tag1'],
    'wp_affiliate_s2s_parameter_for_dynamic_replace1'=>$_POST['param_for_dynamic_replace1'],
    'wp_affiliate_s2s_change_tag2'=>$_POST['change_tag2'],
    'wp_affiliate_s2s_parameter_for_dynamic_replace2'=>$_POST['param_for_dynamic_replace2'],
    'wp_affiliate_s2s_change_tag3'=>$_POST['change_tag3'],
    'wp_affiliate_s2s_parameter_for_dynamic_replace3'=>$_POST['param_for_dynamic_replace3'],
    ),
        array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')
    );
}


//Update Pixel tracking data on Update of Affiliate
add_action('affwp_update_affiliate', 'updateFieldsToDB',0);
function updateFieldsToDB($data){
    global $wpdb;
    echo $aff_id = $wpdb->get_results("SELECT affiliate_id FROM wp_affiliate_wp_affiliate_pixel_data where affiliate_id='".$data['affiliate_id']."'");
    if(count($aff_id) == 0){
        addFieldsToDB($data['affiliate_id'], $_POST);
    }else{
        $wpdb->update(
        'wp_affiliate_wp_affiliate_pixel_data',
        array(
        'wp_affiliate_global_tracking_pixel' => $_POST['global_tracking_pixel'],
        'wp_affiliate_cpl_active'=>$_POST['cpl_activer'],
        'wp_affiliate_cpl_management'=>$_POST['cpl_management'],
        'wp_affiliate_cpl_active_forms'=>$_POST['active_forms'],
        'wp_affiliate_cpa_active'=>$_POST['cpa_activer'],
        'wp_affiliate_cpa_management'=>$_POST['cpa_management'],
        'wp_affiliate_s2s_active'=>$_POST['s2s_activer'],
        'wp_affiliate_s2s_postback_url'=>$_POST['s2s_postback_url'],
        'wp_affiliate_s2s_change_tag1'=>$_POST['change_tag1'],
        'wp_affiliate_s2s_parameter_for_dynamic_replace1'=>$_POST['param_for_dynamic_replace1'],
        'wp_affiliate_s2s_change_tag2'=>$_POST['change_tag2'],
        'wp_affiliate_s2s_parameter_for_dynamic_replace2'=>$_POST['param_for_dynamic_replace2'],
        'wp_affiliate_s2s_change_tag3'=>$_POST['change_tag3'],
        'wp_affiliate_s2s_parameter_for_dynamic_replace3'=>$_POST['param_for_dynamic_replace3'],
        ),
        array('affiliate_id'=>$data['affiliate_id']),
        array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')
        );

    }

}


//Delete Pixel tracking data on delete of Affiliate Plugin
add_action('affwp_delete_affiliates', 'deleteFieldsInDB',0);
function deleteFieldsInDB($data){
    global $wpdb;
    $affiliate_ids=$data['affwp_affiliate_ids'];
    foreach($affiliate_ids as $affiliate_id){
        $wpdb->delete('wp_affiliate_wp_affiliate_pixel_data', array('affiliate_id'=>"$affiliate_id"));
    }
}


?>
