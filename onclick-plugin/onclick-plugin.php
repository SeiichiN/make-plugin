<?php
/*
 @wordpress-plugin                                                      // <1>
 Plugin Name: Onclick Plugin                                            // <2>
 Description: 'onclick'のテスト。ショートコードは [insert_onclick] です。 // <3>
 Version: 1.1                                                           // <4>
 Author: Seiichi Nukayama                                               // <5>
*/

require_once('onclick-plugin-menu.php');

function add_somefiles() {
  wp_enqueue_script('onclick', 
                    plugin_dir_url( __FILE__ ) . 'js/onclick.js', 
                    array('jquery'), '1.0', true);
  wp_enqueue_style('onclick', 
                    plugin_dir_url( __FILE__ ) . 'css/onclick.css',
                    array(), '1.0');
}
add_action('wp_enqueue_scripts', 'add_somefiles');
 
function go_test() {
 ob_start();
?>
 <section>
   <button id="start">クリックしてね</button>
   <div id="area">
     <img id="close" src="<?php echo plugin_dir_url( __FILE__ ) . 'img/close.gif'; ?>" alt="close">
     <p>これはクリックすると、文字列を表示するだけのシンプルなプラグインです。<br>
        プラグインの勉強のために作成しました。</p>
   </div>
 </section>
 <?php
 return ob_get_clean();
 // echo ob_get_clean();  だと、ショートコードを挿入した場所に、文字列が表示されない。
 // return で返す必要がある。
}
add_shortcode('insert_onclick', 'go_test');

 /* 修正時刻: Sat Nov 13 12:47:54 2021*/
