<?php
function onclick_plugin_menu() {
  add_options_page (
    'onclick plugin 設定',  // 管理ページのタイトル
    'onclick plugin',       // 管理メニュー名
    'manage_options',       // 管理ページのコンテンツを表示するのに必要な権限
    'onclick-plugin-menu.php', // 管理ページのコンテンツを表示する phpファイル
    'onclick_plugin_admins_page'  // 管理ページのコンテンツを表示する関数
  );
}
add_action('admin_menu', 'onclick_plugin_menu');

function onclick_plugin_admins_page() {
  ?>
  <div class="wrap">
    <?php screen_icon(); ?>
    <h2>onclick plugin 設定</h2>
    <p>このショートコードをコピーしてください</p>
    <input type="text" onfocus="this.select()"
       style="font-size: 24px" value="[insert_onclick]"/>
  </div>
<?php 
}


// 修正時刻: Sat Nov 13 11:06:04 2021
