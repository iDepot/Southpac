<?php
if(function_exists('current_user_can'))
    if(!current_user_can('manage_options')) {
        die('Access Denied');
    }
if(!function_exists('current_user_can')){
    die('Access Denied');
}

function html_showsliders( $rows,  $pageNav,$sort,$cat_row){
    global $wpdb;
    ?>
    <script language="javascript">
        function ordering(name,as_or_desc)
        {
            document.getElementById('asc_or_desc').value=as_or_desc;
            document.getElementById('order_by').value=name;
            document.getElementById('admin_form').submit();
        }
        function saveorder()
        {
            document.getElementById('saveorder').value="save";
            document.getElementById('admin_form').submit();

        }
        function listItemTask(this_id,replace_id)
        {
            document.getElementById('oreder_move').value=this_id+","+replace_id;
            document.getElementById('admin_form').submit();
        }
        function doNothing() {
            var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
            if( keyCode == 13 ) {


                if(!e) var e = window.event;

                e.cancelBubble = true;
                e.returnValue = false;

                if (e.stopPropagation) {
                    e.stopPropagation();
                    e.preventDefault();
                }
            }
        }
    </script>

    <div class="wrap">
        <?php $path_site2 = plugins_url("images", __FILE__); ?>
        <div class="slider-options-head">
            <div style="float: left;">
                <div><a href="http://huge-it.com/wordpress-plugins-slider-user-manual/" target="_blank">User Manual</a></div>
                <div>This section allows you to configure the Slider options. <a href="http://huge-it.com/wordpress-plugins-slider-user-manual/" target="_blank">More...</a></div>
            </div>
            <div style="float: right;">
                <a class="header-logo-text" href="http://huge-it.com/slider/" target="_blank" >
                    <div><img width="250px" src="<?php echo $path_site2; ?>/huge-it1.png" /></div>
                    <div>Get the full version</div>
                </a>
            </div>
        </div>
        <div id="poststuff">
            <div id="sliders-list-page">
                <form method="post"  onkeypress="doNothing()" action="admin.php?page=sliders_huge_it_slider" id="admin_form" name="admin_form">
                    <h2>Huge Sliders
                        <a onclick="window.location.href='admin.php?page=sliders_huge_it_slider&task=add_cat'" class="add-new-h2" >Add New Slider</a>
                    </h2>
                    <?php
                    $serch_value='';
                    if(isset($_POST['serch_or_not'])) {if($_POST['serch_or_not']=="search"){ $serch_value=esc_html(stripslashes($_POST['search_events_by_title'])); }else{$serch_value="";}}
                    $serch_fields='<div class="alignleft actions"">
				<label for="search_events_by_title" style="font-size:14px">Filter: </label>
					<input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
			</div>
			<div class="alignleft actions">
				<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
				 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
				 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=sliders_huge_it_slider\'" class="button-secondary action">
			</div>';

                    print_html_nav($pageNav['total'],$pageNav['limit'],$serch_fields);
                    ?>
                    <table class="wp-list-table widefat fixed pages" style="width:95%">
                        <thead>
                        <tr>
                            <th scope="col" id="id" style="width:30px" ><span>ID</span><span class="sorting-indicator"></span></th>
                            <th scope="col" id="name" style="width:85px" ><span>Name</span><span class="sorting-indicator"></span></th>
                            <th scope="col" id="prod_count"  style="width:75px;" ><span>Images</span><span class="sorting-indicator"></span></th>
                            <th style="width:40px">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $trcount=1;
                        for($i=0; $i<count($rows);$i++){
                            $trcount++;
                            $ka0=0;
                            $ka1=0;
                            if(isset($rows[$i-1]->id)){
                                if($rows[$i]->sl_width==$rows[$i-1]->sl_width){
                                    $x1=$rows[$i]->id;
                                    $x2=$rows[$i-1]->id;
                                    $ka0=1;
                                }
                                else
                                {
                                    $jj=2;
                                    while(isset($rows[$i-$jj]))
                                    {
                                        if($rows[$i]->sl_width==$rows[$i-$jj]->sl_width)
                                        {
                                            $ka0=1;
                                            $x1=$rows[$i]->id;
                                            $x2=$rows[$i-$jj]->id;
                                            break;
                                        }
                                        $jj++;
                                    }
                                }
                                if($ka0){
                                    $move_up='<span><a href="#reorder" onclick="return listItemTask(\''.$x1.'\',\''.$x2.'\')" title="Move Up">   <img src="'.plugins_url('images/uparrow.png',__FILE__).'" width="16" height="16" border="0" alt="Move Up"></a></span>';
                                }
                                else{
                                    $move_up="";
                                }
                            }else{$move_up="";}


                            if(isset($rows[$i+1]->id)){

                                if($rows[$i]->sl_width==$rows[$i+1]->sl_width){
                                    $x1=$rows[$i]->id;
                                    $x2=$rows[$i+1]->id;
                                    $ka1=1;
                                }
                                else
                                {
                                    $jj=2;
                                    while(isset($rows[$i+$jj]))
                                    {
                                        if($rows[$i]->sl_width==$rows[$i+$jj]->sl_width)
                                        {
                                            $ka1=1;
                                            $x1=$rows[$i]->id;
                                            $x2=$rows[$i+$jj]->id;
                                            break;
                                        }
                                        $jj++;
                                    }
                                }

                                if($ka1){
                                    $move_down='<span><a href="#reorder" onclick="return listItemTask(\''.$x1.'\',\''. $x2.'\')" title="Move Down">  <img src="'.plugins_url('images/downarrow.png',__FILE__).'" width="16" height="16" border="0" alt="Move Down"></a></span>';
                                }else{
                                    $move_down="";
                                }
                            }

                            $uncat=$rows[$i]->par_name;
                            if(isset($rows[$i]->prod_count))
                                $pr_count=$rows[$i]->prod_count;
                            else
                                $pr_count=0;


                            ?>
                            <tr <?php if($trcount%2==0){ echo 'class="has-background"';}?>>
                                <td><?php echo $rows[$i]->id; ?></td>
                                <td><a  href="admin.php?page=sliders_huge_it_slider&task=edit_cat&id=<?php echo $rows[$i]->id?>"><?php echo esc_html(stripslashes($rows[$i]->name)); ?></a></td>
                                <td>(<?php if(!($pr_count)){echo '0';} else{ echo $rows[$i]->prod_count;} ?>)</td>
                                <td><a  href="admin.php?page=sliders_huge_it_slider&task=remove_cat&id=<?php echo $rows[$i]->id?>">Delete</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="oreder_move" id="oreder_move" value="" />
                    <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo $_POST['asc_or_desc'];?>"  />
                    <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo $_POST['order_by'];?>"  />
                    <input type="hidden" name="saveorder" id="saveorder" value="" />

                    <?php
                    ?>
                </form>
            </div>
        </div>
    </div>
<?php

}
function Html_editslider($ord_elem, $count_ord,$images,$row,$cat_row, $rowim, $rowsld, $paramssld, $rowsposts, $rowsposts8, $postsbycat)

{
    global $wpdb;

    if(isset($_GET["addslide"])){
        if($_GET["addslide"] == 1){
            header('Location: admin.php?page=sliders_huge_it_slider&id='.$row->id.'&task=apply');
        }
    }


    ?>
    <script type="text/javascript">
        function submitbutton(pressbutton)
        {
            if(!document.getElementById('name').value){
                alert("Name is required.");
                return;

            }

            document.getElementById("adminForm").action=document.getElementById("adminForm").action+"&task="+pressbutton;
            document.getElementById("adminForm").submit();

        }
        function change_select()
        {
            submitbutton('apply');

        }
    </script>

    <!-- GENERAL PAGE, ADD IMAGES PAGE -->
    <?php $path_site2 = plugins_url("images", __FILE__); ?>
    <div class="wrap">
    <div class="slider-options-head">
        <div style="float: left;">
            <div><a href="http://huge-it.com/wordpress-plugins-slider-user-manual/" target="_blank">User Manual</a></div>
            <div>This section allows you to configure the Slider options. <a href="http://huge-it.com/wordpress-plugins-slider-user-manual/" target="_blank">More...</a></div>
        </div>
        <div style="float: right;">
            <a class="header-logo-text" href="http://huge-it.com/slider/" target="_blank" >
                <div><img width="250px" src="<?php echo $path_site2; ?>/huge-it1.png" /></div>
                <div>Get the full version</div>
            </a>
        </div>
    </div>
    <div style="clear:both;"></div>
    <form action="admin.php?page=sliders_huge_it_slider&id=<?php echo $row->id; ?>" method="post" name="adminForm" id="adminForm">
    <div id="poststuff" >
    <div id="slider-header">
        <ul id="sliders-list">

            <?php
            foreach($rowsld as $rowsldires){
                if($rowsldires->id != $row->id){
                    ?>
                    <li>
                        <a href="#" onclick="window.location.href='admin.php?page=sliders_huge_it_slider&task=edit_cat&id=<?php echo $rowsldires->id; ?>'" ><?php echo $rowsldires->name; ?></a>
                    </li>
                <?php
                }
                else{ ?>
                    <li class="active" style="background-image:url(<?php echo plugins_url('images/edit.png', __FILE__) ;?>)">
                        <input class="text_area" onfocus="this.style.width = ((this.value.length + 1) * 8) + 'px'" type="text" name="name" id="name" maxlength="250" value="<?php echo esc_html(stripslashes($row->name));?>" />
                    </li>
                <?php
                }
            }
            ?>
            <li class="add-new">
                <a onclick="window.location.href='admin.php?page=sliders_huge_it_slider&amp;task=add_cat'">+</a>
            </li>
        </ul>
    </div>
    <div id="post-body" class="metabox-holder columns-2">
    <!-- Content -->
    <div id="post-body-content">


        <?php add_thickbox(); ?>

        <div id="post-body">
            <div id="post-body-heading">
                <h3>Slides</h3>

                <input type="hidden" name="imagess" value="" />
                <a href="" class="button button-primary add-new-image"  id="slideup">
                    <span class="wp-media-buttons-icon"></span>Add Image Slide
                </a>





                <a href="admin.php?page=sliders_huge_it_slider&task=popup_posts&id=<?php echo $_GET['id']; ?>&TB_iframe=1" class="button button-primary add-post-slide thickbox"  id="slideup2s" value="iframepop">
                    <input  title="Add Post" class="thickbox" type="button" value="Add Post" />
                    <span class="wp-media-buttons-icon"></span>Add Post Slide
                </a>


                <script>
                    jQuery(document).ready(function ($) {

                        jQuery("#slideup").click(function () {
                            window.parent.uploadID = jQuery(this).prev('input');
                            formfield = jQuery('.upload').attr('name');
                            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                            return false;
                        });
                        window.send_to_editor = function (html) {
                            imgurl = jQuery('img', html).attr('src');
                            window.parent.uploadID.val(imgurl);
                            tb_remove();
                            $("#save-buttom").click();

                        };
                    });

                </script>

                <!--<a class="button button-primary" href="admin.php?page=sliders_huge_it_slider&id=<?php echo $row->id; ?>&task=apply&addslide=1">Add Image</a>-->

            </div>
            <ul id="images-list">

                <?php
                $i=2;
                //$rowim = array_reverse($rowim);
                foreach ($rowim as $key=>$rowimages){ ?>
                    <li <?php if($i%2==0){echo "class='has-background'";}$i++; ?>>
                        <input class="order_by" type="hidden" name="order_by_<?php echo $rowimages->id; ?>" value="<?php echo $rowimages->ordering; ?>" />
                        <div class="image-container">
                            <img src="<?php echo $rowimages->image_url; ?>" />
                            <div>
                                <script>
                                    jQuery(document).ready(function ($) {

                                        jQuery("#slideup<?php echo $key; ?>").click(function () {
                                            window.parent.uploadID = jQuery(this).prev('input');
                                            formfield = jQuery('.upload').attr('name');
                                            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

                                            return false;
                                        });
                                        window.send_to_editor = function (html) {
                                            imgurl = jQuery('img', html).attr('src');
                                            window.parent.uploadID.val(imgurl);

                                            tb_remove();
                                            $("#save-buttom").click();
                                        };
                                    });

                                </script>
                                <input type="hidden" name="imagess<?php echo $rowimages->id; ?>" value="<?php echo $rowimages->image_url; ?>" />
                                <a href="" class="edit-image"  id="slideup<?php echo $key; ?>">Edit Image</a>
                            </div>
                        </div>
                        <div class="image-options">
                            <div>
                                <label for="titleimage<?php echo $rowimages->id; ?>">Title:</label>
                                <input  class="text_area" type="text" id="titleimage<?php echo $rowimages->id; ?>" name="titleimage<?php echo $rowimages->id; ?>" id="titleimage<?php echo $rowimages->id; ?>"  value="<?php echo $rowimages->name; ?>">
                            </div>
                            <div class="description-block">
                                <label for="im_description<?php echo $rowimages->id; ?>">Description:</label>
                                <textarea id="im_description<?php echo $rowimages->id; ?>" name="im_description<?php echo $rowimages->id; ?>" ><?php echo $rowimages->description; ?></textarea>
                            </div>
                            <div class="link-block">
                                <label for="sl_url<?php echo $rowimages->id; ?>">URL:</label>
                                <input class="text_area url-input" type="text" id="sl_url<?php echo $rowimages->id; ?>" name="sl_url<?php echo $rowimages->id; ?>"  value="<?php echo $rowimages->sl_url; ?>" >
                                <label class="long" for="sl_link_target<?php echo $rowimages->id; ?>">Open in new tab</label>
                                <input type="hidden" name="sl_link_target<?php echo $rowimages->id; ?>" value="" />
                                <input  <?php if($rowimages->link_target == 'on'){ echo 'checked="checked"'; } ?>  class="link_target" type="checkbox" id="sl_link_target<?php echo $rowimages->id; ?>" name="sl_link_target<?php echo $rowimages->id; ?>" />

                                <!--<input type="checkbox" name="pause_on_hover" id="pause_on_hover"  <?php if($row->pause_on_hover == 'on'){ echo 'checked="checked"'; } ?>  class="link_target"/>-->
                            </div>
                            <div class="remove-image-container">
                                <a class="button remove-image" href="admin.php?page=sliders_huge_it_slider&id=<?php echo $row->id; ?>&task=apply&removeslide=<?php echo $rowimages->id; ?>">Remove Image</a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </li>
                <?php } ?>
            </ul>
        </div>

    </div>

    <!-- SIDEBAR -->
    <div id="postbox-container-1" class="postbox-container">
        <div id="side-sortables" class="meta-box-sortables ui-sortable">
            <div id="slider-unique-options" class="postbox">
                <h3 class="hndle"><span>Current Slider Options</span></h3>
                <ul id="slider-unique-options-list">

                    <li>
                        <label for="sl_width">Width</label>
                        <input type="text" name="sl_width" id="sl_width" value="<?php echo $row->sl_width; ?>" class="text_area" />
                    </li>
                    <li>
                        <label for="sl_height">Height</label>
                        <input type="text" name="sl_height" id="sl_height" value="<?php echo $row->sl_height; ?>" class="text_area" />
                    </li>
                    <li>
                        <label for="pause_on_hover">Pause on hover</label>
                        <input type="hidden" value="off" name="pause_on_hover" />
                        <input type="checkbox" name="pause_on_hover"  value="on" id="pause_on_hover"  <?php if($row->pause_on_hover  == 'on'){ echo 'checked="checked"'; } ?> />
                    </li>
                    <li>
                        <label for="slider_effects_list">Effects</label>
                        <select name="slider_effects_list" id="slider_effects_list">
                            <option <?php if($row->slider_list_effects_s == 'none'){ echo 'selected'; } ?>  value="none">None</option>
                            <option <?php if($row->slider_list_effects_s == 'cubeH'){ echo 'selected'; } ?>   value="cubeH">Cube Horizontal</option>
                            <option <?php if($row->slider_list_effects_s == 'cubeV'){ echo 'selected'; } ?>  value="cubeV">Cube Vertical</option>
                            <option <?php if($row->slider_list_effects_s == 'fade'){ echo 'selected'; } ?>  value="fade">Fade</option>
                            <option <?php if($row->slider_list_effects_s == 'sliceH'){ echo 'selected'; } ?>  value="sliceH">Slice Horizontal</option>
                            <option <?php if($row->slider_list_effects_s == 'sliceV'){ echo 'selected'; } ?>  value="sliceV">Slice Vertical</option>
                            <option <?php if($row->slider_list_effects_s == 'slideH'){ echo 'selected'; } ?>  value="slideH">Slide Horizontal</option>
                            <option <?php if($row->slider_list_effects_s == 'slideV'){ echo 'selected'; } ?>  value="slideV">Slide Vertical</option>
                            <option <?php if($row->slider_list_effects_s == 'scaleOut'){ echo 'selected'; } ?>  value="scaleOut">Scale Out</option>
                            <option <?php if($row->slider_list_effects_s == 'scaleIn'){ echo 'selected'; } ?>  value="scaleIn">Scale In</option>
                            <option <?php if($row->slider_list_effects_s == 'blockScale'){ echo 'selected'; } ?>  value="blockScale">Block Scale</option>
                            <option <?php if($row->slider_list_effects_s == 'kaleidoscope'){ echo 'selected'; } ?>  value="kaleidoscope">Kaleidoscope</option>
                            <option <?php if($row->slider_list_effects_s == 'fan'){ echo 'selected'; } ?>  value="fan">Fan</option>
                            <option <?php if($row->slider_list_effects_s == 'blindH'){ echo 'selected'; } ?>  value="blindH">Blind Horizontal</option>
                            <option <?php if($row->slider_list_effects_s == 'blindV'){ echo 'selected'; } ?>  value="blindV">Blind Vertical</option>
                            <option <?php if($row->slider_list_effects_s == 'random'){ echo 'selected'; } ?>  value="random">Random</option>
                        </select>
                    </li>

                    <li>
                        <label for="sl_pausetime">Pause time</label>
                        <input type="text" name="sl_pausetime" id="sl_pausetime" value="<?php echo $row->description; ?>" class="text_area" />
                    </li>
                    <li>
                        <label for="sl_changespeed">Change speed</label>
                        <input type="text" name="sl_changespeed" id="sl_changespeed" value="<?php echo $row->param; ?>" class="text_area" />
                    </li>
                    <li>
                        <label for="slider_position">Slider Position</label>
                        <select name="sl_position" id="slider_position">
                            <option <?php if($row->sl_position == 'left'){ echo 'selected'; } ?>  value="left">Left</option>
                            <option <?php if($row->sl_position == 'right'){ echo 'selected'; } ?>   value="right">Right</option>
                            <option <?php if($row->sl_position == 'center'){ echo 'selected'; } ?>  value="center">Center</option>
                        </select>
                    </li>

                </ul>
                <div id="major-publishing-actions">
                    <div id="publishing-action">
                        <input type="button" onclick="submitbutton('apply')" value="Save Slider" id="save-buttom" class="button button-primary button-large">
                    </div>
                    <div class="clear"></div>
                    <!--<input type="button" onclick="window.location.href='admin.php?page=sliders_huge_it_slider'" value="Cancel" class="button-secondary action">-->
                </div>
            </div>
        </div>
        <div id="slider-shortcode-box" class="postbox shortcode ms-toggle">
            <h3 class="hndle"><span>Usage</span></h3>
            <div class="inside">
                <ul>
                    <li rel="tab-1" class="selected">
                        <h4>Shortcode</h4>
                        <p>Copy &amp; paste the shortcode directly into any WordPress post or page.</p>
                        <textarea class="full" readonly="readonly">[huge_it_slider id="<?php echo $row->id; ?>"]</textarea>
                    </li>
                    <li rel="tab-2">
                        <h4>Template Include</h4>
                        <p>Copy &amp; paste this code into a template file to include the slideshow within your theme.</p>
                        <textarea class="full" readonly="readonly">&lt;?php echo do_shortcode("[huge_it_slider id='<?php echo $row->id; ?>']"); ?&gt;</textarea>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    <input type="hidden" name="task" value="" />
    </form>
    </div>

<?php

}


function html_popup_posts($ord_elem, $count_ord,$images,$row,$cat_row, $rowim, $rowsld, $paramssld, $rowsposts, $rowsposts8, $postsbycat){
    global $wpdb;

    ?>
    <style>
        html.wp-toolbar {
            padding:0px !important;
        }
        #wpadminbar,#adminmenuback,#screen-meta, .update-nag,#dolly {
            display:none;
        }
        #wpbody-content {
            padding-bottom:30px;
        }
        #adminmenuwrap {display:none !important;}
        .auto-fold #wpcontent, .auto-fold #wpfooter {
            margin-left: 0px;
        }
        #wpfooter {display:none;}
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function() {


            jQuery('.huge-it-insert-post-button').on('click', function() {
                alert("Add Post Slide feature is disabled in free version. If you need this functionality, you need to buy the commercial version.");
                return false;
            });


            $('.huge-it-post-checked').change(function(){
                if($(this).is(':checked')){
                    $(this).addClass('active');
                    $(this).parent().addClass('active');
                }else {
                    $(this).removeClass('active');
                    $(this).parent().removeClass('active');
                }

                var inputval="";
                $('#huge-it-add-posts-params').val("");
                $('.huge-it-post-checked').each(function(){
                    if($(this).is(':checked')){
                        inputval+=$(this).val()+";";
                    }
                });
                $('#huge-it-add-posts-params').val(inputval);
            });


            jQuery("#huge-it-categories-list").change(function(){
                var currentCategoryID=jQuery(this).val();

                jQuery('#huge-it-posts-list li').not("#huge-it-posts-list-heading").css({"display":"none"});
                jQuery('li[data-id*="'+currentCategoryID+'"]').css({"display":"block"});

            });
            //jQuery("#huge-it-categories-list").change();

            jQuery('#huge_it_slider_add_posts_wrap .view-type-block a').click(function(){
                jQuery('#huge_it_slider_add_posts_wrap .view-type-block a').removeClass('active');
                jQuery(this).addClass('active');
                var strtype=jQuery(this).attr('href').replace('#','');
                jQuery('#huge-it-posts-list').removeClass('list').removeClass('thumbs');
                jQuery('#huge-it-posts-list').addClass(strtype);
                return false;
            });


            jQuery('.updated').css({"display":"none"});
            <?php	if($_GET["closepop"] == 1){ ?>
            $("#closepopup").click();
            self.parent.location.reload();
            <?php	} ?>
        });

    </script>
    <a id="closepopup"  onclick=" parent.eval('tb_remove()')" style="display:none;" > [X] </a>


    <div id="huge_it_slider_add_posts">
        <div id="huge_it_slider_add_posts_wrap">
            <h2>Add post</h2>
            <span class="buy-pro">This feature is disabled in free version. </br>If you need this functionality, you need to <a href="http://huge-it.com/slider/" target="_blank">buy the commercial version</a>.</span>
            <div class="control-panel">
                <form method="post"  onkeypress="doNothing()" action="admin.php?page=sliders_huge_it_slider&task=popup_posts&id=<?php echo $_GET['id']; ?>" id="huge-it-category-form" name="admin_form">
                    <label for="huge-it-categories-list">Select Category <select id="huge-it-categories-list" name="iframecatid" onchange="this.form.submit()">

                            <?php $categories = get_categories( ); ?>

                            <?php	 foreach ($categories as $strcategories){
                                if(isset($_POST["iframecatid"])){
                                    ?>
                                    <option value="<?php echo $strcategories->cat_ID; ?>" <?php if($strcategories->cat_ID == $_POST["iframecatid"]){echo 'selected="selected"';} ?>><?php echo $strcategories->cat_name; ?></option>';

                                <?php }
                                else
                                {
                                    ?>
                                    <option value="<?php echo $strcategories->cat_ID; ?>"><?php echo $strcategories->cat_name; ?></option>';
                                <?php
                                }							}
                            ?>
                        </select></label>
                </form>
                <form method="post"  onkeypress="doNothing()" action="admin.php?page=sliders_huge_it_slider&task=popup_posts&id=<?php echo $_GET['id']; ?>&closepop=1" id="admin_form" name="admin_form">
                    <button class='save-slider-options button-primary huge-it-insert-post-button' id='huge-it-insert-post-button-top'>Insert Posts</button>
                    <label for="huge-it-description-length">Description Length <input id="huge-it-description-length" type="text" name="posthuge-it-description-length" value="<?php echo $row->published; ?>" placeholder="Description length" /></label>
                    <div class="view-type-block">
                        <a class="view-type list active" href="#list">View List</a>
                        <a class="view-type thumbs" href="#thumbs">View List</a>
                    </div>
            </div>
            <div style="clear:both;"></div>
            <ul id="huge-it-posts-list" class="list">
                <li id="huge-it-posts-list-heading" class="hascolor">
                    <div class="huge-it-posts-list-image">Image</div>
                    <div class="huge-it-posts-list-title">Title</div>
                    <div class="huge-it-posts-list-description">
                        Description

                    </div>
                    <div class="huge-it-posts-list-link">Link</div>
                    <div class="huge-it-posts-list-category">Category</div>
                </li>
                <?php



                $strx=1;
                foreach($rowsposts8 as $rowspostspop1){
                    $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."posts where post_type = 'post' and post_status = 'publish' and ID = %d  order by ID ASC", $rowspostspop1->object_id);
                    $rowspostspop=$wpdb->get_results($query);
                    //print_r($rowspostspop);


                    $post_categories =  wp_get_post_categories( $rowspostspop[0]->ID, $rowspostspop[0]->ID );
                    $cats = array();


                    foreach($post_categories as $c){
                        $cat = get_category( $c );
                        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'id' => $cat->term_id );
                        //echo	$cat->slug;
                    }
                    if(get_the_post_thumbnail($rowspostspop[0]->ID, 'thumbnail') != ''){
                        $strx++;
                        $hascolor="";
                        if($strx%2==0){$hascolor='class="hascolor"';}
                        ?>

                        <li <?php echo $hascolor; ?>>
                            <input type="checkbox" class="huge-it-post-checked"  value="<?php echo $rowspostspop[0]->ID; ?>">
                            <div class="huge-it-posts-list-image"><?php echo get_the_post_thumbnail($rowspostspop[0]->ID, 'thumbnail'); ?></div>
                            <div class="huge-it-posts-list-title"><?php echo $rowspostspop[0]->post_title;	?></div>
                            <div class="huge-it-posts-list-description"><?php echo	$rowspostspop[0]->post_content;	?></div>
                            <div class="huge-it-posts-list-link"><?php echo	$rowspostspop[0]->guid; ?></div>
                            <div class="huge-it-posts-list-category"><?php echo	$cat->slug;	?></div>
                        </li>
                    <?php }
                }	?>
            </ul>
            <input id="huge-it-add-posts-params" type="hidden" name="popupposts" value="" />
            <div class="clear"></div>
            <button class='save-slider-options button-primary huge-it-insert-post-button' id='huge-it-insert-post-button-bottom'>Insert Posts</button>
            </form>

        </div>
    </div>


<?php




}
?>


