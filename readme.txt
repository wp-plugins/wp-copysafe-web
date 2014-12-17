=== CopySafe Web Protection ===

Contributors: ArtistScope
Donate link: http://www.artistscope.com/copysafe_web_protection_wordpress_plugin.asp
Tags: protect, secure, prevent
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Insert CopySafe Web encrypted images to copy protect all media in posts and pages from right-click-save, mouse-drag, Print Screen and screen capture.

== Description ==

Insert [CopySafe Web Protection](http://www.artistscope.com/copysafe_web_protection.asp) using encrypted images to copy protect all media including image, Flash, PDF and video from right-click-saving and mouse-drag and [prevent Print Screen and screen capture]( http://www.artistscope.com/prevent-screen-capture.asp). This plugin can add [copy protection](http://www.artistscope.com/copy-protect-web-pages.asp) to any page or post by simply adding a small CopySafe [encrypted image]( http://www.artistscope.com/image-encryption.asp).

* Easy install.
* Upload and embed CopySafe Web using WordPress native media tools.
* Insert encrypted images into posts or pages using a media button.
* Ability to set varying levels of protection per page or post.
* Control which web browsers can access your protected pages.
* Checks the CopySafe Web plugin for redirection and install.
* Manage settings to control image display options.
* Add copy protection to by adding just a 20 x 20 pixel image.
* Protection for all media from Printscreen and screen capture.

The use of CopySafe Web [encrypted images](http://www.artistscope.com/image-encryption.asp) is the most secure image protection solution because those images are [domain locked]( http://www.artistscope.com/domain-lock.asp) and cannot be used on any other website. They are also safe from your webmaster. 

**How it works**

CopySafe Web uses a web browser plugin (like the Flash browser plugin) [prevent Print Screen and screen capture]( http://www.artistscope.com/prevent-screen-capture.asp). That plugin is activated when CopySafe Web image loads and it deactivates when the visitor leaves the page. 

When a visitor loads a CopySafe Web [copy protected page]( http://www.artistscope.com/copy-protect-web-pages.asp) their browser is checked for the plugin and if it is not detected then they are redirected to a download page with instructions for installation. After installing the plugin the visitor can return to explore your protected web pages. The download pages are included with this WP plugin and can be customized to suit your own messages and design.

More information and online demos protecting a variety of different media can be seen at the [CopySafe Web Protection](http://www.artistscope.com/copysafe_web_protection.asp) website. 

You can see this plugin and our other WP [copy protection plugins] in action on our WordPress demo site.

**Implementation**

Click on the [C] media button above a post to upload and embed CopySafe Web encrypted images in your current post or page. When inserting a protected image object, the necessary shortcode is automatically inserted into the post editor. 

You can upload new image class documents or select from a list of already uploaded class files. After selecting an image class file you can then set the security options to apply to the page such as:

* Enable or disable protection from Printscreen and screen capture
* Enable or disable the option viewing by computers using remote or virtual connections
* Enable or disable use of browser menus
* Enable or disable use of the keyboard

For more information visit the [CopySafe Web Protection](http://www.artistscope.com/docs/CopySafeWeb_WordPress_Installation.pdf) plugin page at ArtistScope.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the "wp-copysafe-web" folder and its contents to the "/wp-content/plugins/" directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create a new folder at "/wp-content/uploads/copysafe-web"
4. Set write permissions on this new folder
5. Check and modify the default settings to suit your pages
6. You can now add CopySafe Web images using its media button above the post editor

Click to download the [CopySafe Web Installation Guide](http://www.artistscope.com/docs/CopySafeWeb_WordPress_Installation.pdf)

If you do not have any CopySafe Web encrypted images for testing, you can download this [test file](http://www.artistscope.com/download/cs/icon_0020_0020_C.zip) which satisfies the file type criteria. It is licensed for "localhost" so you can activate capture protection on your test server.

== Frequently Asked Questions ==

= Can this plugin be used without CopySafe? =

Yes. By leaving mode set to demo, an icon will be displayed instead of the object code, but no-right-click saving and drag-n-drop will still be prevented, and you will still be able to control which web browsers can access the page.

= Which web browsers are supported by this plugin? =

All popular web browsers are supported on all Windows platforms since XP (92% of net users).

= What can be done for Mac or Linux computers? =

Nothing that is safe from Print Screen or screen capture. However if you want to use encrypted images for Mac and Linux computers, which are a much more secure solution than anything based on JavaScript, you could use the WP Secure Image plugin. Instead of using ActiveX, Secure Image uses a java security applet to display the image that is supported in all browsers and on all platforms.

== Screenshots ==

1. To add a CopySafe Web image at the last cursor position in the text area, click the [C] media button.
2. After uploading or selecting an existing class image, nominate the settings to apply to the page or post.
3. Here you can nominate the default settings that apply to all CopySafe Web pages.
4. A file list can be displayed showing all CopySafe Web images that have been uploaded.

== Changelog ==

= 1.7 =
* Tested for compatibilty with WP 4.1.

= 1.6 =
* Minor adjustment for WP 4

= 1.5 =
* Tested and verified on WordPress version 4.0
* Adjusted upload save form to better fit small screen sizes.

= 1.4 =
* Tested and verified on WordPress version 3.9.2
* Added alternative user check in case session logging not supported by webhost.
* Added settings option to allow uploads by admin only.
* Upload will progress only on same host IP.
* Referrer user agent must be Shockwave Flash
* Referrer url must match with the same script name.
* Save settings page options altered for show in smaller screens.
* No need to click "Insert File to editor" button after Save button clicked.

= 1.3 =
* Added login requirements to upload functions.

= 1.2 =
* Fixed security flaw in upload function.
* Tested and aproved for WordPress 3.9.

= 1.1 =
* Removed alert that displays image size.
* Tested and aproved for WordPress 3.8.

= 1.0 =
* Fixed detection bug for Internet Explorer 11 and Windows 8.1.

= 0.9 =
* Added support for Windows 8.1
* Plugin version incremented to 4.7.2.0
* Tested and verified for WP 3.7.1

= 0.8 =
* Added allowance for Firefox 20 and later.

= 0.7 =
* Added option to manually set image width and height.
* If image size is not set then the filename dimensions are used.

= 0.6 =
* Removed dependency on wp-load.php.

= 0.5 =
* Updated for JQuery 1.8

= 0.4 =
* Clean up and clarified definitions used in settings.

= 0.3 =
* Added Netscape Navigator browser option in default settings.
* Fixed bug with progress bar displayed when uploading.

= 0.2 =
* Added parameters to shorcode for editing of existing image inserts.
* Same images can be used on multiple posts with unique settings.
* Revised default settings options.
* Revised functions to comply with CodePlex recommendations.

= 0.1 =
* First release.

== About ==

**About CopySafe Web**

* CopySafe Web is the most secure copy protection for web pages.
* The CopySafe Web plugin is a free download to the public.
* The CopySafe Web is supported on all Windows computers since XP.
* CopySafe Web images are encrypted and domain locked.
* CopySafe Web images cannot be copied or used on other websites.
* When a CopySafe Web image loads, copy protection is activated.
* All media can be protected by using only a tiny encrypted image.

**Limitations**

* CopySafe Web is not supported on Mac. However it is supported on all Windows computers since XP (92% of net users). It is not possible to properly secure web content on Mac, Linux or any handheld devices not running Windows 8. All other platforms in total remain a minority. As such supporting them is not viable and doing so would only undermine the standard that CopySafe Web clients require.

**Licensing benefits**

* CopySafe Web is the most secure image protection on the planet.
* CopySafe Web images cannot be copied or used on other sites.

**Other modules**

CopySafe Web is specially designed for a wide variety of scenarios.

* The [CopySafe Web converter]( http://www.artistscope.com/copysafe_web_protection_gui.asp) is available as Windows desktop software.
* Converter [runs by Command-line]( http://www.artistscope.com/copysafe_web_protection_cmd.asp) on Windows computers and servers.
* Custom DLL to [interface ommand-line with web pages]( http://www.artistscope.com/copysafe_web_protection_cmd.asp#server-side).

**Alternatives**

CopySafe Web is most secure for "images" and while it can prevent Print Screen and screen capture for all other media displayed on a web page, other solutions are available that may be more specifically suited media such as [CopySafe PDF Protector](http://www.artistscope.com/copysafe_pdf_protection.asp) is specially designed for PDF documents. For viewing online, the [ArtistScope Site Protection System (ASPS)](http://www.artistscope.com/artis-secure-web-reader.asp) uses a secure web browser that is properly designed to protect web media rather than expose it. Soon [ArtistScope Secure Video](http://www.artistscope.com/secure_video_protection.asp) will be available specially for video files. WordPress plugins or widgets are available for all of these copy protection solutions for easy integration into your WordPress project. 

