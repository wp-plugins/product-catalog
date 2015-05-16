<?php	
    if(function_exists('current_user_can'))
    if(!current_user_can('manage_options')) {
    die('Access Denied');
}	
if(!function_exists('current_user_can')){
	die('Access Denied');
}

function showcatalog()
{
    global $wpdb;
  
    if(isset($_POST['search_events_by_title']))
        $_POST['search_events_by_title']=esc_html(stripslashes($_POST['search_events_by_title']));
    if(isset($_POST['asc_or_desc']))
        $_POST['asc_or_desc']=esc_js($_POST['asc_or_desc']);
    if(isset($_POST['order_by']))
        $_POST['order_by']=esc_js($_POST['order_by']);
        $where='';
  	$sort["custom_style"] ="manage-column column-autor sortable desc";
	$sort["default_style"]="manage-column column-autor sortable desc";
	$sort["sortid_by"]='id';
	$sort["1_or_2"]=1;
	$order='';
	
	if(isset($_POST['page_number']))
	{
            if($_POST['asc_or_desc'])
            {
                    $sort["sortid_by"]=$_POST['order_by'];
                    if($_POST['asc_or_desc']==1)
                    {
                            $sort["custom_style"]="manage-column column-title sorted asc";
                            $sort["1_or_2"]="2";
                            $order="ORDER BY ".$sort["sortid_by"]." ASC";
                    }
                    else
                    {
                            $sort["custom_style"]="manage-column column-title sorted desc";
                            $sort["1_or_2"]="1";
                            $order="ORDER BY ".$sort["sortid_by"]." DESC";
                    }
            }
            if($_POST['page_number'])
            {
                    $limit=($_POST['page_number']-1)*20; 
            }
		else
		{
			$limit=0;
		}
	}
	else
		{
			$limit=0;
		}
	if(isset($_POST['search_events_by_title'])){
            $search_tag=esc_html(stripslashes($_POST['search_events_by_title']));
        }
		
        else
        {
            $search_tag="";
        }		
		
	if(isset($_GET["catid"])){
	    $cat_id=$_GET["catid"];	
        }
       else
       {
           if(isset($_POST['cat_search'])){
		$cat_id=$_POST['cat_search'];
            }else{
		
		$cat_id=0;
            }
       }
     
    if ( $search_tag ) {
        $where= " WHERE name LIKE '%".$search_tag."%' ";
    }
    if($where){
        if($cat_id){
            $where.=" AND sl_width=" .$cat_id;
        }
	
    }
    else{
        if($cat_id){
          $where.=" WHERE sl_width=" .$cat_id;
          }
    }
	
	$cat_row_query="SELECT id,name FROM ".$wpdb->prefix."huge_it_catalogs WHERE sl_width=0";
	$cat_row=$wpdb->get_results($cat_row_query);
	
	// get the total number of records
	$query = "SELECT COUNT(*) FROM ".$wpdb->prefix."huge_it_catalogs". $where;
	
	$total = $wpdb->get_var($query);
	$pageNav['total'] =$total;
	$pageNav['limit'] =	 $limit/20+1;
	
	if($cat_id){
	$query ="SELECT  a.* ,  COUNT(b.id) AS count, g.par_name AS par_name FROM ".$wpdb->prefix."huge_it_catalogs  AS a LEFT JOIN ".$wpdb->prefix."huge_it_catalogs AS b ON a.id = b.sl_width LEFT JOIN (SELECT  ".$wpdb->prefix."huge_it_catalogs.ordering as ordering,".$wpdb->prefix."huge_it_catalogs.id AS id, COUNT( ".$wpdb->prefix."huge_it_catalog_products.catalog_id ) AS prod_count
FROM ".$wpdb->prefix."huge_it_catalog_products, ".$wpdb->prefix."huge_it_catalogs
WHERE ".$wpdb->prefix."huge_it_catalog_products.catalog_id = ".$wpdb->prefix."huge_it_catalogs.id
GROUP BY ".$wpdb->prefix."huge_it_catalog_products.catalog_id) AS c ON c.id = a.id LEFT JOIN
(SELECT ".$wpdb->prefix."huge_it_catalogs.name AS par_name,".$wpdb->prefix."huge_it_catalogs.id FROM ".$wpdb->prefix."huge_it_catalogs) AS g
 ON a.sl_width=g.id WHERE  a.name LIKE '%".$search_tag."%' group by a.id ". $order ." "." LIMIT ".$limit.",20" ; 

	 }
	 else{
	 $query ="SELECT  a.* ,  COUNT(b.id) AS count, g.par_name AS par_name FROM ".$wpdb->prefix."huge_it_catalogs  AS a LEFT JOIN ".$wpdb->prefix."huge_it_catalogs AS b ON a.id = b.sl_width LEFT JOIN (SELECT  ".$wpdb->prefix."huge_it_catalogs.ordering as ordering,".$wpdb->prefix."huge_it_catalogs.id AS id, COUNT( ".$wpdb->prefix."huge_it_catalog_products.catalog_id ) AS prod_count
FROM ".$wpdb->prefix."huge_it_catalog_products, ".$wpdb->prefix."huge_it_catalogs
WHERE ".$wpdb->prefix."huge_it_catalog_products.catalog_id = ".$wpdb->prefix."huge_it_catalogs.id
GROUP BY ".$wpdb->prefix."huge_it_catalog_products.catalog_id) AS c ON c.id = a.id LEFT JOIN
(SELECT ".$wpdb->prefix."huge_it_catalogs.name AS par_name,".$wpdb->prefix."huge_it_catalogs.id FROM ".$wpdb->prefix."huge_it_catalogs) AS g
 ON a.sl_width=g.id WHERE a.name LIKE '%".$search_tag."%'  group by a.id ". $order ." "." LIMIT ".$limit.",20" ; 
}

    $rows = $wpdb->get_results($query);
    global $glob_ordering_in_cat;
    if(isset($sort["sortid_by"]))
    {
        if($sort["sortid_by"]=='ordering'){
            if($_POST['asc_or_desc']==1){
                    $glob_ordering_in_cat=" ORDER BY ordering ASC";
            }
            else{
                    $glob_ordering_in_cat=" ORDER BY ordering DESC";
            }
        }
    }
    $rows=open_cat_in_tree($rows);
	$query ="SELECT  ".$wpdb->prefix."huge_it_catalogs.ordering,".$wpdb->prefix."huge_it_catalogs.id, COUNT( ".$wpdb->prefix."huge_it_catalog_products.catalog_id ) AS prod_count
FROM ".$wpdb->prefix."huge_it_catalog_products, ".$wpdb->prefix."huge_it_catalogs
WHERE ".$wpdb->prefix."huge_it_catalog_products.catalog_id = ".$wpdb->prefix."huge_it_catalogs.id
GROUP BY ".$wpdb->prefix."huge_it_catalog_products.catalog_id " ;
	$prod_rows = $wpdb->get_results($query);
		
    foreach($rows as $row)
    {
            foreach($prod_rows as $row_1)
            {
                    if ($row->id == $row_1->id)
                    {
                        $row->ordering = $row_1->ordering;
                        $row->prod_count = $row_1->prod_count;
                    }
            }

    }
	

	 

	 
    $cat_row=open_cat_in_tree($cat_row);
    html_showcatalogs( $rows, $pageNav,$sort,$cat_row);
}

function open_cat_in_tree($catt,$tree_problem='',$hihiih=1){

    global $wpdb;
    global $glob_ordering_in_cat;
    static $trr_cat=array();
    if(!isset($search_tag))
    $search_tag='';
    if($hihiih)
    $trr_cat=array();
    foreach($catt as $local_cat){
            $local_cat->name=$tree_problem.$local_cat->name;
            array_push($trr_cat,$local_cat);
	$new_cat_query=	"SELECT  a.* ,  COUNT(b.id) AS count, g.par_name AS par_name FROM ".$wpdb->prefix."huge_it_catalogs  AS a LEFT JOIN ".$wpdb->prefix."huge_it_catalogs AS b ON a.id = b.sl_width LEFT JOIN (SELECT  ".$wpdb->prefix."huge_it_catalogs.ordering as ordering,".$wpdb->prefix."huge_it_catalogs.id AS id, COUNT( ".$wpdb->prefix."huge_it_catalog_products.catalog_id ) AS prod_count
FROM ".$wpdb->prefix."huge_it_catalog_products, ".$wpdb->prefix."huge_it_catalogs
WHERE ".$wpdb->prefix."huge_it_catalog_products.catalog_id = ".$wpdb->prefix."huge_it_catalogs.id
GROUP BY ".$wpdb->prefix."huge_it_catalog_products.catalog_id) AS c ON c.id = a.id LEFT JOIN
(SELECT ".$wpdb->prefix."huge_it_catalogs.name AS par_name,".$wpdb->prefix."huge_it_catalogs.id FROM ".$wpdb->prefix."huge_it_catalogs) AS g
 ON a.sl_width=g.id WHERE a.name LIKE '%".$search_tag."%' AND a.sl_width=".$local_cat->id." group by a.id  ".$glob_ordering_in_cat; 
 $new_cat=$wpdb->get_results($new_cat_query);
 open_cat_in_tree($new_cat,$tree_problem. "— ",0);
    }
return $trr_cat;

}

function edit_catalog($id)
{
    global $wpdb;
//  var_dump($id);exit;
    if(isset($_GET["removeslide"])){
        if($_GET["removeslide"] != ''){
            $wpdb->query("DELETE FROM ".$wpdb->prefix."huge_it_catalog_products  WHERE id = ".$_GET["removeslide"]." ");
        }
    }

    $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalogs WHERE id= %d",$id);
    $row=$wpdb->get_row($query);
    if(!isset($row->catalog_list_effects_s))
        return 'id not found';
    $images=explode(";;;",$row->catalog_list_effects_s);
    $par=explode('	',$row->param);
    $count_ord=count($images);
    $cat_row=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."huge_it_catalogs WHERE id!=" .$id." and sl_width=0");
    $cat_row=open_cat_in_tree($cat_row);
    $query=$wpdb->prepare("SELECT name,ordering FROM ".$wpdb->prefix."huge_it_catalogs WHERE sl_width=%d  ORDER BY `ordering` ",$row->sl_width);
    $ord_elem=$wpdb->get_results($query);
    $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products where catalog_id = %d order by ordering ASC  ",$row->id);
    $rowim=$wpdb->get_results($query);
    if(isset($_GET["addslide"])){
        if($_GET["addslide"] == 1){
            $table_name = $wpdb->prefix . "huge_it_catalog_products";
            $sql_2 = "
            INSERT INTO 

            `" . $table_name . "` ( `name`, `catalog_id`, `description`, `image_url`, `sl_url`, `ordering`, `published`, `published_in_sl_width`,) VALUES
            ( '', '".$row->id."', '', '', '', 'par_TV', 2, '1' )";

            $wpdb->query($sql_huge_it_catalog_products);
            $wpdb->query($sql_2);

        }
    }

    $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalogs order by id ASC";
    $rowsld=$wpdb->get_results($query);
//    $query = "SELECT *  from " . $wpdb->prefix . "huge_it_catalog_params ";
//    $rowspar = $wpdb->get_results($query);
    $paramssld = array();
//    foreach ($rowspar as $rowpar) {
//        $key = $rowpar->name;
//        $value = $rowpar->value;
//        $paramssld[$key] = $value;
//    }
	
    $query="SELECT * FROM ".$wpdb->prefix."posts where post_type = 'post' and post_status = 'publish' order by id ASC";
    $rowsposts=$wpdb->get_results($query);
	 
    $rowsposts8 = '';
    $postsbycat = '';
    if(isset($_POST["iframecatid"])){
        $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."term_relationships where term_taxonomy_id = %d order by object_id ASC",$_POST["iframecatid"]);
        $rowsposts8=$wpdb->get_results($query);
        foreach($rowsposts8 as $rowsposts13){
            $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."posts where post_type = 'post' and post_status = 'publish' and ID = %d  order by ID ASC",$rowsposts13->object_id);
            $rowsposts1=$wpdb->get_results($query);
            $postsbycat = $rowsposts1;
        }
    }
    $allAlbumsArray = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_albums");
    $catalogsInAlbum = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_album_catalog_contact,".$wpdb->prefix."huge_it_catalogs WHERE ".$wpdb->prefix."huge_it_catalog_album_catalog_contact.catalog_id= %d AND ".$wpdb->prefix."huge_it_catalog_album_catalog_contact.catalog_id=".$wpdb->prefix."huge_it_catalogs.id",$id);
    $catalogsInAlbumArray = $wpdb->get_results($catalogsInAlbum);
    $catalogAlbumIdesArray = $wpdb->get_results($wpdb->prepare("SELECT album_id FROM ".$wpdb->prefix."huge_it_catalog_album_catalog_contact WHERE catalog_id= %d",$id));
    
    Html_edit_catalog($catalogsInAlbumArray,$allAlbumsArray,$catalogAlbumIdesArray,$ord_elem, $count_ord, $images, $row, $cat_row, $rowim, $rowsld, $paramssld, $rowsposts, $rowsposts8, $postsbycat);
}
  
function add_catalog()
{
    global $wpdb;
	
    $table_name = $wpdb->prefix . "huge_it_catalogs";
    $sql_2 = "
INSERT INTO 

`" . $table_name . "` ( `name`, `sl_height`, `sl_width`, `pause_on_hover`, `catalog_list_effects_s`, `description`, `param`, `sl_position`, `ordering`, `published`, `categories`, `ht_show_sorting`, `ht_show_filtering`) VALUES
( 'New Catalog', '375', '600', 'on', 'cubeH', '4000', '1000', 'center', '1', '300', 'param1,param2,', 'off', 'off')";

      $wpdb->query($sql_2);

   $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalogs order by id ASC";
			   $rowsldcc=$wpdb->get_results($query);
			   $last_key = key( array_slice( $rowsldcc, -1, 1, TRUE ) );
			   
			   
	foreach($rowsldcc as $key=>$rowsldccs){
            if($last_key == $key){
                    header('Location: admin.php?page=catalogs_huge_it_catalog&id='.$rowsldccs->id.'&task=apply');
            }
	}	
}

function popup_posts($id)
{
          global $wpdb;
           if(isset($_GET["removeslide"])){
                if($_GET["removeslide"] != ''){

                   $wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."huge_it_catalog_products WHERE id = '%s'", $_GET["removeslide"]));
              }
           }

	   $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalogs WHERE id= %d",$id);
	   $row=$wpdb->get_row($query);
	   if(!isset($row->catalog_list_effects_s))
	   return 'id not found';
           $images=explode(";;;",$row->catalog_list_effects_s);
	   $par=explode('	',$row->param);
	   $count_ord=count($images);
	   $cat_row=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."huge_it_catalogs WHERE id!=" .$id." and sl_width=0");
           $cat_row=open_cat_in_tree($cat_row);
           $query=$wpdb->prepare("SELECT name,ordering FROM ".$wpdb->prefix."huge_it_catalogs WHERE sl_width=%d  ORDER BY `ordering` ",$row->sl_width);
	   $ord_elem=$wpdb->get_results($query);
	   
	   $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products where catalog_id = %d order by id ASC  ",$row->id);
           $rowim=$wpdb->get_results($query);

           if(isset($_GET["addslide"])){
               if($_GET["addslide"] == 1){
	
$table_name = $wpdb->prefix . "huge_it_catalog_products";
    $sql_2 = "
INSERT INTO 

`" . $table_name . "` ( `name`, `catalog_id`, `description`, `image_url`, `sl_url`, `ordering`, `published`, `published_in_sl_width`) VALUES
( '', '".$row->id."', '', '', '', 'par_TV', 2, '1' )";

                  $wpdb->query($sql_huge_it_catalog_products);
	

                  $wpdb->query($sql_2);
	
                }
            }
	
	   
	   $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalogs order by id ASC";
           $rowsld=$wpdb->get_results($query);
			  
//	   $query = "SELECT *  from " . $wpdb->prefix . "huge_it_catalog_params ";
//
//           $rowspar = $wpdb->get_results($query);

//           $paramssld = array();
//           foreach ($rowspar as $rowpar) {
//               $key = $rowpar->name;
//               $value = $rowpar->value;
//               $paramssld[$key] = $value;
//           }
	
	  $query="SELECT * FROM ".$wpdb->prefix."posts where post_type = 'post' and post_status = 'publish' order by id ASC";
          $rowsposts=$wpdb->get_results($query);

          $categories = get_categories(  );
		if(isset($_POST["iframecatid"])){
		$iframecatid = $_POST["iframecatid"];
		}
		else
		{
		$iframecatid = $categories[0]->cat_ID;
		}
	 
	 	  $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."term_relationships where term_taxonomy_id = %d order by object_id ASC",$iframecatid);
		$rowsposts8=$wpdb->get_results($query);


	 

			   foreach($rowsposts8 as $rowsposts13){
	 $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."posts where post_type = 'post' and post_status = 'publish' and ID = %d  order by ID ASC",$rowsposts13->object_id);
			   $rowsposts1=$wpdb->get_results($query);
			   
			   $postsbycat = $rowsposts1;
			   
	 }

	  if(isset($_GET["closepop"])){
            if($_GET["closepop"] == 1){

                if($_POST["popupposts"] != 'none' and $_POST["popupposts"] != ''){

                  /*  	echo $_GET["closepop"].'sdasdasdsad';
                  echo $_POST["popupposts"].'dddddddd';*/

                  $popuppostsposts = explode(";", $_POST["popupposts"]);

                  array_pop($popuppostsposts);

                  foreach($popuppostsposts as $popuppostsposts1){
                  $my_id = $popuppostsposts1;

                  $post_id_1 = get_post($my_id); 



                  $post_image = wp_get_attachment_url( get_post_thumbnail_id($popuppostsposts1) );
                  $posturl=get_permalink($popuppostsposts1);
                  $table_name = $wpdb->prefix . "huge_it_catalog_products";

                  $descnohtmlnoq=strip_tags($post_id_1->post_content);
                  $descnohtmlnoq1 = html_entity_decode($descnohtmlnoq);
                  $descnohtmlnoq1 = htmlentities($descnohtmlnoq1, ENT_QUOTES, "UTF-8");


          $sql_posts = "
INSERT INTO 

`" . $table_name . "` ( `name`, `catalog_id`, `description`, `image_url`, `sl_url`, `sl_type`, `link_target`, `ordering`, `published`, `published_in_sl_width`) VALUES
( '".$post_id_1->post_title."', '".$row->id."', '".$descnohtmlnoq1."', '".$post_image ."', '".$posturl."', 'image', 'on', '0', '2', '1' )";



                    $wpdb->query($sql_posts);
	  
	

                    }

              }
              if(!($_POST["lastposts"])){
                  $wpdb->query("UPDATE ".$wpdb->prefix."huge_it_catalogs SET published = '".$_POST["posthuge-it-description-length"]."' WHERE id = '".$_GET['id']."' ");
              }
	    }
        }

        if(isset($_POST["lastposts"])){
            $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."posts where post_type = 'post' and post_status = 'publish' order by id DESC LIMIT 0, ".$_POST["lastposts"]."");
            $rowspostslast=$wpdb->get_results($query);
            foreach($rowspostslast as $rowspostslastfor){

                $my_id = $rowspostslastfor;
                $post_id_1 = get_post($my_id); 



                $post_image = wp_get_attachment_url( get_post_thumbnail_id($rowspostslastfor) );
                $posturl=get_permalink($rowspostslastfor);
                $table_name = $wpdb->prefix . "huge_it_catalog_products";
                $descnohtmlno=strip_tags($post_id_1->post_content);
                $descnohtmlno1 = html_entity_decode($descnohtmlno);
                $lengthtextpost = '300';
                $descnohtmlno2 = substr_replace($descnohtmlno1, "", $lengthtextpost);
                $descnohtmlno3 = htmlentities($descnohtmlno2, ENT_QUOTES, "UTF-8");
                $posttitle = htmlentities($post_id_1->post_title, ENT_QUOTES, "UTF-8");
                $posturl2 = htmlentities($posturl, ENT_QUOTES, "UTF-8");

			   
            $sql_lastposts = "INSERT INTO 
`" . $table_name . "` ( `name`, `catalog_id`, `description`, `image_url`, `sl_url`, `ordering`, `published`, `published_in_sl_width`) VALUES
( '".$posttitle."', '".$row->id."', '".$descnohtmlno3."', '".$post_image ."', '".$posturl."', 'par_TV', 2, '1' )";

                $wpdb->query($sql_huge_it_catalog_products);

                $wpdb->query($sql_lastposts);
            }
}
	   	   
    Html_popup_posts($ord_elem, $count_ord, $images, $row, $cat_row, $rowim, $rowsld, $paramssld, $rowsposts, $rowsposts8, $postsbycat);
}

function catalog_reviews($id)
{
   Html_catalog_reviews();
}

function catalog_ratings($id)
{
   Html_catalog_ratings();
}

function removecatalog($id)
{

	global $wpdb;
	$sql_remov_tag=$wpdb->prepare("DELETE FROM ".$wpdb->prefix."huge_it_catalogs WHERE id = %d", $id);
    if(!$wpdb->query($sql_remov_tag))
    {
             ?>
             <div id="message" class="error"><p>catalog Not Deleted</p></div>
         <?php

    }
    else{
       ?>
       <div class="updated"><p><strong><?php _e('Item Deleted.' ); ?></strong></p></div>
       <?php
   }
}

function apply_cat($id)
{
            global $wpdb;
            if(!is_numeric($id)){
                    echo 'insert numerc id';
                   return '';
            }
            if(!(isset($_POST['sl_width']) && isset($_POST["name"]) ))
            {
                    return '';
            }
            $cat_row=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalogs WHERE id!= %d ", $id));
            $corent_ord=$wpdb->get_var($wpdb->prepare('SELECT `ordering` FROM '.$wpdb->prefix.'huge_it_catalogs WHERE id = %d AND sl_width=%d',$id,$_POST['sl_width']));
            $max_ord=$wpdb->get_var('SELECT MAX(ordering) FROM '.$wpdb->prefix.'huge_it_catalogs');
	 
            $query=$wpdb->prepare("SELECT sl_width FROM ".$wpdb->prefix."huge_it_catalogs WHERE id = %d", $id);
            $id_bef=$wpdb->get_var($query);
      
            if(isset($_POST["content"])){
                $script_cat = preg_replace('#<script(.*?)>(.*?)</script>#is', '', stripslashes($_POST["content"]));
            }

                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  name                    = '%s'  WHERE id = '%s' ", $_POST["name"]                , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  sl_width                = '%s'  WHERE id = '%s' ", $_POST["sl_width"]            , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  sl_height               = '%s'  WHERE id = '%s' ", $_POST["sl_height"]           , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  pause_on_hover          = '%s'  WHERE id = '%s' ", $_POST["pause_on_hover"]      , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  catalog_list_effects_s  = '%s'  WHERE id = '%s' ", $_POST["catalog_effects_list"], $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  description             = '%s'  WHERE id = '%s' ", $_POST["sl_pausetime"]        , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  param                   = '%s'  WHERE id = '%s' ", $_POST["sl_changespeed"]      , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  sl_position             = '%s'  WHERE id = '%s' ", $_POST["sl_position"]         , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  ordering                = '1'   WHERE id = '%s' ", $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  categories              = '%s'  WHERE id = '%s' ", $_POST["allCategories"]       , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  ht_show_sorting         = '%s'  WHERE id = '%s' ", $_POST["ht_show_sorting"]     , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  ht_show_filtering       = '%s'  WHERE id = '%s' ", $_POST["ht_show_filtering"]   , $id));
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  cat_thumb               = '%s'  WHERE id = '%s' ", $_POST["cat_thumb"]           , $id));


                $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalogs WHERE id = %d", $id);
                $row=$wpdb->get_row($query);

                $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products where catalog_id = %d order by id ASC", $row->id);
                $rowim=$wpdb->get_results($query);
			   
                foreach ($rowim as $key=>$rowimages){
                    $title = stripslashes($_POST["titleimage".$rowimages->id]);
                    $description = stripslashes($_POST["im_description".$rowimages->id]);
                    $parameters = stripslashes($_POST["parameter".$rowimages->id]);
                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  ordering = '%s'  WHERE ID = %d ", $_POST["order_by_".$rowimages->id.""], $rowimages->id));
//                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  link_target = '%s'  WHERE ID = %d ",$_POST["sl_link_target".$rowimages->id.""], $rowimages->id));
//                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  sl_url = '%s' WHERE ID = %d ", $_POST["sl_url".$rowimages->id.""], $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  name = '%s'  WHERE ID = %d ", $title, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  description = '%s'  WHERE ID = %d ", $description, $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  image_url = '%s'  WHERE ID = %d ", $_POST["imagess".$rowimages->id.""], $rowimages->id));
//                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  category = '%s'  WHERE ID = %d ", $_POST["category".$rowimages->id.""], $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  price = '%s'  WHERE ID = %d ", $_POST["price".$rowimages->id.""], $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  market_price = '%s'  WHERE ID = %d ", $_POST["market_price".$rowimages->id.""], $rowimages->id));
                    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  parameters = '%s'  WHERE ID = %d ", $parameters, $rowimages->id));
                    //$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  cat_thumb = '".$_POST["cat_thumb".$rowimages->id.""]."'  WHERE ID = %d ", $rowimages->id));

                }

if(isset($_POST["catalog_cats"])) {
        
        $catalog_cats = explode(',', $_POST["catalog_cats"]);
        $catalog_old_cats = explode(',', $_POST["catalog_old_cats"]);
        
        $table_name = "huge_it_catalog_album_catalog_contact";
        foreach ($catalog_old_cats as $catalog_old_cat) {
            $wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix.$table_name." WHERE catalog_id = %d AND album_id = %d", $id, $catalog_old_cat));
//            echo "DELETE FROM ".$wpdb->prefix.$table_name." WHERE catalog_id = %d AND album_id = %d", $id, $catalog_old_cat;
        }
//        exit;
        foreach ($catalog_cats as $replaceKey => $catalog_cat) {
            if($catalog_cat != ""){
                
                $catalog_album_contact_inserting = $wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix.$table_name." ( `catalog_id`, `album_id` ) VALUES (  '%s', '%s')", $id, $catalog_cat ));
            }
        }
}

if (isset($_POST['params'])) {
      $params = $_POST['params'];
      foreach ($params as $key => $value) {
          $wpdb->update($wpdb->prefix . 'huge_it_catalog_params',
              array('value' => $value),
              array('name' => $key),
              array('%s')
          );
      }
     
    }
	
    if($_POST["imagess"] != ''){
            $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products where catalog_id = %d order by id ASC", $row->id);
            $rowim=$wpdb->get_results($query);
	    foreach ($rowim as $key=>$rowimages){
                $orderingplus = $rowimages->ordering+1;
                $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET  ordering = %d  WHERE ID = %d ", $orderingplus, $rowimages->id));
            }
	
        $table_name = $wpdb->prefix . "huge_it_catalog_products";
	$imagesnewuploader = explode(";;;", $_POST["imagess"]);
	
	array_pop($imagesnewuploader);

        $getCatalogParams = $wpdb->get_row($wpdb->prepare("SELECT categories FROM ".$wpdb->prefix."huge_it_catalogs where id = %d order by id ASC", $row->id));
        $paramsStringForAddingInNewProduct = str_replace(',', '@@', $getCatalogParams->categories);
//        var_dump($paramsStringForAddingInNewProduct);EXIT;
	foreach($imagesnewuploader as $imagesnewupload){
            $sql_2 = "
INSERT INTO 

`" . $table_name . "` ( `name`, `catalog_id`, `description`, `image_url`, `sl_url`, `ordering`, `published`, `published_in_sl_width`, `price`, `market_price`, `parameters`) VALUES
( '', '".$row->id."', '', '".$imagesnewupload.";', '', 'par_TV', 2, '1', '', '', '".$paramsStringForAddingInNewProduct."')";

//            $sql_2 = $wpdb->query($wpdb->prepare("INSERT INTO `".$table_name."`"
//                    . "( `name`, `catalog_id`, `description`, `image_url`, `sl_url`, `ordering`, `published`, `published_in_sl_width`, `price`, `market_price`, `parameters` ) VALUES"
//                    . "( '', %d, '', '%s', '', 'par_TV', 2, 1, '', '', '%s' )", $row->id, $imagesnewupload, $paramsStringForAddingInNewProduct ));
	

            $wpdb->query($sql_2);
        }
    }
	   
	if(isset($_POST["posthuge-it-description-length"])){
	    $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET  published = %d WHERE id = %d ", $_POST["posthuge-it-description-length"], $_GET['id']));
        }
	?>
	<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
	<?php
	
    return true;
	
}

function getComments() {
   global $wpdb;
        $reviewId = $_GET['prod_id'];
        $getReviewsArray = $wpdb->prepare("SELECT *  FROM " . $wpdb->prefix . "huge_it_catalog_reviews WHERE product_id= %d",$reviewId);
        $getReviews = $wpdb->get_results($getReviewsArray);
        return $getReviews;
}

function getParams() {
   global $wpdb;
        $getAllParamsSql = "SELECT * FROM " . $wpdb->prefix . "huge_it_catalog_products";
        $getAllParamsArray = $wpdb->get_results($getAllParamsSql);
        return $getAllParamsArray;
}


function getRatings() {
   global $wpdb;
        $ratingId = $_GET['prod_id'];
        $getAllRatingsSql = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_it_catalog_rating  WHERE prod_id = '%s'",$ratingId);
        $getAllRatingsArray = $wpdb->get_results($getAllRatingsSql);
        return $getAllRatingsArray;
}
?>