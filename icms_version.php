<?php
/**
 * wadoku version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/**  General Information  */
$modversion = array(
	"name"						=> _MI_WADOKU_MD_NAME,
	"version"					=> 1.0,
	"description"				=> _MI_WADOKU_MD_DESC,
	"author"					=> "佐藤レネー René Sato",
	"credits"					=> "ドイツ語と日本語。「独和辞典」の略。⇔ 和独 (deutsch-japanisches Wörterbuch - Abk.: WaDoku)",
	"help"						=> "",
	"license"					=> "GNU General Public License (GPL)",
	"official"					=> 0,
	"dirname"					=> basename(dirname(__FILE__)),
	"modname"					=> "wadoku",

/**  Images information  */
	"iconsmall"					=> "images/icon_small.png",
	"iconbig"					=> "images/icon_big.png",
	"image"						=> "images/icon_big.png", /* for backward compatibility */

/**  Development information */
	"status_version"			=> "1.0",
	"status"					=> "Beta2",
	"date"						=> "Unreleased",
	"author_word"				=> "",
	"warning"					=> _CO_ICMS_WARNING_BETA,

/** Contributors */
	"developer_website_url"		=> "http://japan.internet-box.info/",
	"developer_website_name"	=> "japan.internet-box.info",
	"developer_email"			=> "rene.sato@gmx.de",

/** Administrative information */
	"hasAdmin"					=> 1,
	"adminindex"				=> "admin/index.php",
	"adminmenu"					=> "admin/menu.php",

/** Install and update informations */
	"onInstall"					=> "include/onupdate.inc.php",
	"onUpdate"					=> "include/onupdate.inc.php",

/** Search information */
	"hasSearch"					=> 1,
	"search"					=> array("file" => "include/search.inc.php", "func" => "wadoku_search"),

/** Menu information */
	"hasMain"					=> 1,
	
/** Notification information */
	"hasNotification"			=> 0,
	
/** Comments information */
	"hasComments"				=> 1,
	"comments"					=> array(
									"itemName" => "post_id",
									"pageName" => "post.php",
									"callbackFile" => "include/comment.inc.php",
									"callback" => array("approve" => "wadoku_com_approve",
														"update" => "wadoku_com_update")));

/** other possible types: testers, translators, documenters and other */
$modversion['people']['developers'][] = "[url=http://www.impresscms.de/]佐藤レネー René Sato[/url]";

/** Manual */
//$modversion['manual']['wiki'][] = "<a href='http://www.impresscms.de/' target='_blank'>Hilfe</a>";

/** Database information */
$modversion['object_items'][1] = 'japaneseword';
$modversion['object_items'][] = 'modulehelp';

$modversion["tables"] = icms_getTablesArray($modversion['dirname'], $modversion['object_items']);

/** Templates information */
$modversion['templates'] = array(
	array("file" => "wadoku_admin_japaneseword.html", "description" => "japaneseword Admin Index"),
	array("file" => "wadoku_japaneseword.html", "description" => "japaneseword Index"),
	array("file" => "wadoku_admin_modulehelp.html", "description" => "modulehelp Admin Index"),
	array("file" => "wadoku_modulehelp.html", "description" => "modulehelp Index"),

	array('file' => 'wadoku_header.html', 'description' => 'Module Header'),
	array('file' => 'wadoku_footer.html', 'description' => 'Module Footer'));

/** Blocks information */
$modversion['blocks'][1] = array(
	"file"						=> "wadoku_random_wadoku.php",
	"name"						=> _MI_WADOKU_RANDOM_WADOKU,
	"description"				=> _MI_WADOKU_RANDOM_WADOKUDSC,
	"show_func"					=> "wadoku_random_wadoku_show",
	"edit_func"					=> "wadoku_random_wadoku_edit",
	"options"					=> "0",
	"template"					=> "wadoku_random_wadoku.html");

/** Preferences information */
/** To come soon in imBuilding... */

/** Notification information */
/** To come soon in imBuilding... */