<?php
/**
 * English language constants related to module information
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

define("_MI_WADOKU_MD_NAME", "wadoku");
define("_MI_WADOKU_MD_DESC", "ImpressCMS Simple wadoku");

define("_MI_WADOKU_JAPANESEWORDS", "WaDoku");
define("_MI_WADOKU_MODULEHELPS", "Help");
define("_MI_WADOKU_TEMPLATES", "Templates");

// Blocks
define("_MI_WADOKU_RANDOM_WADOKU", "Random words");
define("_MI_WADOKU_RANDOM_WADOKUDSC", "Displays random WaDoku words.");

// Notification
define("_MI_WADOKU_GLOBAL_NOTIFY", "Global");
define("_MI_WADOKU_GLOBAL_NOTIFY_DSC", "Global word notification options.");
define("_MI_WADOKU_GLOBAL_NEW_VOC_NOTIFY", "New word created");
define("_MI_WADOKU_GLOBAL_NEW_VOC_NOTIFY_CAP", "Notify me when a new word is created.");
define("_MI_WADOKU_GLOBAL_NEW_VOC_NOTIFY_DSC", "Receive notification when any new word is created.");
define("_MI_WADOKU_GLOBAL_NEW_VOC_NOTIFY_SBJ", "[{X_SITENAME}] {X_MODULE} auto-notify : New Japanese word is created");
define("_MI_WADOKU_GLOBAL_VOC_NOTIFY", "Word modifications");
define("_MI_WADOKU_GLOBAL_VOC_NOTIFY_CAP", "Notify me of any word modifications.");
define("_MI_WADOKU_GLOBAL_VOC_NOTIFY_DSC", "Receive notification when any word modification is submitted.");
define("_MI_WADOKU_GLOBAL_VOC_NOTIFY_SBJ", "[{X_SITENAME}] {X_MODULE} auto-notify : A new Japanese word was modified");
