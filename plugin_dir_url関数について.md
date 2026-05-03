wordpressのプラグインで、次のようなコードを書きました。

```
function add_somefiles() {
  wp_enqueue_script('onclick',
                    plugin_dir_url( __FILE__ ) . 'js/onclick.js',
                    array('jquery'), '1.0', true);
  wp_enqueue_style('onclick', plugin_dir_url( __FILE__ ) . 'css/onclick.css',
                    array(), '1.0');
}
add_action('wp_enqueue_scripts', 'add_somefiles');
```

この中で、`plugin_dir_url()` というwordpress関数について、教えてください。
今までは、`plugins_url('js/onclick.js', __FILE__)` としていたのですが、
`plugin_dir_url(__FILE__) . 'js/onclick.js'`のほうがわかりやすいです。



---

`plugin_dir_url()` は、**「そのPHPファイルが含まれているプラグインのディレクトリURL」を返す関数**です。

---

## 基本の動き

```php
plugin_dir_url(__FILE__)
```

と書くと、

* `__FILE__` → 現在のPHPファイルのフルパス
* そのファイルがあるフォルダ（プラグインのディレクトリ）
* そのフォルダに対応する **URL（http〜）**

が返ってきます。

例えばプラグイン構成がこうなら：

```
wp-content/plugins/my-plugin/
  my-plugin.php
  js/onclick.js
  css/onclick.css
```

`my-plugin.php` の中で

```php
plugin_dir_url(__FILE__)
```

はだいたいこうなります：

```
https://example.com/wp-content/plugins/my-plugin/
```

なので：

```php
plugin_dir_url(__FILE__) . 'js/onclick.js'
```

→

```
https://example.com/wp-content/plugins/my-plugin/js/onclick.js
```

---

## `plugins_url()` との違い

あなたが書いていたこちら：

```php
plugins_url('js/onclick.js', __FILE__)
```

も結果はほぼ同じURLになります。

### 違いは役割の粒度

| 関数                             | 役割                   |
| ------------------------------ | -------------------- |
| `plugin_dir_url(__FILE__)`     | ディレクトリURLを返す（ベースURL） |
| `plugins_url($path, __FILE__)` | ファイルURLを直接生成         |

---

## 書き方の比較

### ① `plugins_url()`

```php
plugins_url('js/onclick.js', __FILE__)
```

* 1発でURLが完成
* 短い
* でもパスが文字列として埋め込まれる

---

### ② `plugin_dir_url()`

```php
plugin_dir_url(__FILE__) . 'js/onclick.js'
```

* ベース + 相対パスで構築
* **ディレクトリ構造が見えやすい**
* 複数ファイルを扱うときに便利

---

## 実務での使い分け

あなたの感覚はかなり正しいです。

### 👍 `plugin_dir_url()` が向いているケース

```php
$base = plugin_dir_url(__FILE__);

wp_enqueue_script('a', $base . 'js/a.js');
wp_enqueue_script('b', $base . 'js/b.js');
wp_enqueue_style('c', $base . 'css/c.css');
```

→ 同じディレクトリを何度も使うときは読みやすい

---

### 👍 `plugins_url()` が向いているケース

```php
wp_enqueue_script('a', plugins_url('js/a.js', __FILE__));
```

→ 単発ならシンプル

---

## 注意点（意外と重要）

### 1. 必ず `__FILE__` を渡す

```php
plugin_dir_url(__FILE__)
```

これを省略すると：

```php
plugin_dir_url()
```

→ ❌ 正しく動かない（非推奨）

---

### 2. 末尾に `/` が付く

```php
plugin_dir_url(__FILE__)
```

は必ず

```
.../my-plugin/
```

のように **スラッシュ付きで終わる** ので、

```php
... . 'js/onclick.js'
```

と素直に書けます（ここは便利ポイント）

---

## まとめ

* `plugin_dir_url(__FILE__)` は「このプラグインのURLの基点」
* `plugins_url()` は「ファイルURLを直接作る関数」
* 複数ファイルを扱うなら `plugin_dir_url()` のほうが可読性が高い

---

もし興味があれば、「`plugin_dir_path()`（ファイルパス版）」や「`__DIR__`との違い」も重要なので、そのあたりも解説できます。
