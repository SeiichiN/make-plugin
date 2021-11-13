<?php
/*
 * @wordpress-plugin                                                      // <1>
 * Plugin Name: Onclick Plugin                                            // <2>
 * Description: 'onclick'のテスト。ショートコードは '[insert_onclick]' 。 // <3>
 * Version: 1.0                                                           // <4>
 * Author: Seiichi Nukayama                                               // <5>
 */

require_once('onclick_plugin_menu.php');

function add_somefiles() {
  wp_enqueue_script('onclick', plugins_url('js/onclick.js', __FILE__), array('jquery'), '1.0', true);
  wp_enqueue_style('onclick', plugins_url('css/onclick.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'add_somefiles');
 
function go_test() {
 ob_start();
?>
 <section>
   <button id="start">クリックしてね</button>
   <div id="area">
     <img id="close" src="<?php echo plugins_url('img/close.gif', __FILE__); ?>" alt="close">
     <p>これはクリックすると、文字列を表示するだけのシンプルなプラグインです。<br>
        プラグインの勉強のために作成しました。</p>
   </div>
 </section>
 <?php
 return ob_get_clean();
}
add_shortcode('insert_onclick', 'go_test');

 /* 修正時刻: Sat Nov 13 12:47:54 2021*/
