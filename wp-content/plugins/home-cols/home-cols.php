<?php
/*
Plugin Name: Southpac Services Home Columns
Plugin URI: http://
Description: Home Columns.
Version:1.0
Author: shaoqing Yu
License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
Domain Path: /languages/
*/



function southpac_home_columns_shortcode(){

           $img_folder =plugins_url('home-cols/images');

           load_plugin_textdomain( 'home-cols', false, dirname( plugin_basename( __FILE__ ) ) .  '/languages' );

          $content = '<div class="grid_3">
                      <div class="box ">
                       <div class="maxheight">
                       <div class="box_inner">
                       <img alt="" src="' . $img_folder .'/page1_img1.jpg" /><h3> bussiness Immigration </h3>
                              澳大利亚商业移民分为两类，一类是一步到位直接获永居的132类别，另一类是先申请4年临时居留签证，到澳洲建立生意2年或投资4年后再转永居。
                         </div>
                        </div>
                         <p><a href="../services/immigration"> More Information </a></p>
                        </div>
                        </div>';

//          $content =+'<div class="grid_3">
//                                <div class="box">
//                                <div class="maxheight">
//                                <div class="box_inner">
//                                <img alt="" src="'.wp_plugin_directory_constants().'"images/page1_img2.jpg" />
//                            <h3>家庭团聚</h3>
//                              澳大利亚家庭团聚分为配偶、子女、父母和最后一个亲属等几种。
//                            </div>
//                            </div>
//                            <a href="../services/visa">更多信息</a>
//                            </div>
//                            </div>';
//
//          $content =+'<div class="grid_3">
//                            <div class="box ">
//                            <div class="maxheight">
//                            <div class="box_inner">
//                            <img alt="" src="../wp-content/themes/southpac/images/page1_img3.jpg" />
//                            <h3>学生签证</h3>
//                            澳洲政府容许非澳洲市民或非永久居民在澳洲求学，任何非澳洲居民都有权提出留学申请，但同学必须获得学生签証才可以开始在澳洲留学。
//                            </div>
//                            </div>
//                            <a href="../services/visa">更多信息</a>
//                            </div>
//                            </div>';
//
//             $content =+'<div class="grid_3">
//                            <div class="box ">
//                            <div class="maxheight">
//                            <div class="box_inner">
//                            <img alt="" src="../wp-content/themes/southpac/images/page1_img4.jpg" />
//                            <h3>访问签证</h3>
//                            澳大利亚访问签证（600类别）允许申请人赴澳旅游、从事商务活动或探亲访友。该签证是一种临时签证。
//                            </div>
//                            </div>
//                            <a href="../services/visa">更多信息</a>
//                            </div>
//                             </div>';

             echo $content;
};


add_shortcode('southpac_home_columns', 'southpac_home_columns_shortcode');

















?>