=== Plugin Name ===
Contributors: Eternus web
Tags: WPML dictionary, dict, dictionary, eternus dict, eternus
Requires at least: 3.0.3
Tested up to: 3.0.3
Stable tag: 1.0

Eternus dict is plugin for simple text editing, it works like a dictionary. For more info visit www.eternus-dict.com

== Description ==

[Eternus dict](http://www.eternus-dict.com/) is plugin for simple text editing, works like a dictionary. This plugin allows you to place content anywhere on the web page, simply by adding call_key ('<?=eternus_dict('call_key')?>') into your template. Call key will be created when you enter a new word into the Eternus dict

You can use this plugin for multilingual sites with **WPML plugin**. You only need to put call_key into your template file where you want to see some text and that's it. When you change the default language of your site, you automatically display call_key for that language. Example : Croatian site -> Dobar dan svijete! English site -> Hello world! ; different text but same call_key ('<?=eternus_dict('call_key')?>').

Features:

*    Automatically creates link in admin menu
*    Allows you to enter a word
*    Allows you to edit a word ( you can edit word without change call_key )
*    **Full compatibility with WPML plugin** ( for multilingual sites )
*    Automatically creates two or more input fields with the same call_key, depends how many active languages in WPML
*    Full back-end management (in Wordpress admin panel)

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Download and unzip the file
2. Upload `eternus_dict` folder to the `/wp-content/plugins/` directory
3. Log in into your WordPress control panel
4. Click the Plugins tab
5. Activate the "Eternus dict" plugin through the 'Plugins' menu in WordPress
6. Go to "Add word" and enter a word
7. Place `<?=eternus_dict('call_key')?>` in your templates

For help, visit http://www.eternus-dict.com/ and fill contact form.


== Frequently Asked Questions ==

= Is Eternus dict compatible with WPML plugin?  =

Yes. Eternus dict is fully compatible with all versions of WPML.

= Does Eternus dict work without WPML plugin? =

Yes. Eternus dict works without WPML. You can use Eternus dict like a single plugin.

== Screenshots ==

1. http://www.eternus-dict.com/img/1-addPlugin.png

2. http://www.eternus-dict.com/img/2-findPlugin.png

3. http://www.eternus-dict.com/img/3-selectPlugin.png

4. http://www.eternus-dict.com/img/4-activatePlugin.png

5. http://www.eternus-dict.com/img/5-showdictPlugin.png

6. http://www.eternus-dict.com/img/6-addWord.png

7. http://www.eternus-dict.com/img/7-edictLookUp.png

8. http://www.eternus-dict.com/img/8-HowToUse.png

== Changelog ==

= 1.0 =
* Initial Version