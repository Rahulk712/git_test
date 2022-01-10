=== ZeroBounce ===
Contributors: zerobounce
Tags: email, validation, bounce, abuse
Requires at least: 4.6
Tested up to: 4.8.2
Stable tag: 1.0.0
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The official plugin for the ZeroBounce e-mail vadlidation system. 

== Description ==
 
ZeroBounce will help you with: 

* Email Spam Trap Detection
* Email Abuse Detection
* Email Bounce Detection
* Disposable Email Detection
* Toxic Domain Detection
* Catch-All Domain Detection
* Social Append
* Email Gender Append 
* Selectable download options
* Email Validation API 

The plugin integrates the ZeroBounce API to deliver the following data upon validating an e-mail address:

* Address - The email address you are validating.
* Status - [Valid|Invalid|Catch-all|Spamtrap|Abuse|DoNotMail]
* Sub-status - [antispam_system|greylisted |mail_server_temporary_error|forcible_disconnect|mail_server_did_not_respond  |timeout_exceeded|failed_smtp_connection|mailbox_quota_exceeded|exception_occurred| ]
* Account - The portion of the email address before the "@" symbol.
* Domain - The portion of the email address after the "@" symbol.
* Disposable - [true|false] If the email domain is diposable, which are usually temporary email addresses.
* Toxic - [true|false] These domains are known for abuse, spam, and bot created.
* Firstname - The first name of the owner of the email when available or [null].
* Lastname - The last name of the owner of the email when available or [null].
* Gender - The gender of the owner of the email when available or [null].
* Creation date - The creation date of the email when available or [null].
* Location - The location of the owner of the email when available or [null].
* ProcessedAt - The UTC time the email was validated.

== Installation ==
 
1. Upload the plugin files to the `/wp-content/plugins/zerobounce` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->ZeroBounce screen to register the API key given to you after the account creation. You can find the key of your account here https://www.zerobounce.net/members/apikey/.


== Frequently Asked Questions ==

= Does the plugin come with the "Bulk Email Validator" feature? =

No, this version of the plugin does not offer the "Bulk Email Validator" feature. You can only validate one e-mail address at a time. We plan on adding more features on later versions, so check for updates regularly.

== Screenshots ==

1. The plugin offers an e-mail validation tool. 
2. The results for a valid address, "test@gmail.com".
3. The results for an invalid address, "test@gmal.com". 

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice == 

 
 