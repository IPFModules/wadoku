<?php
/**
 * Common file of the module included on all pages of the module
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

if (!defined("WADOKU_DIRNAME")) define("WADOKU_DIRNAME", $modversion["dirname"] = basename(dirname(dirname(__FILE__))));
if (!defined("WADOKU_URL")) define("WADOKU_URL", ICMS_URL."/modules/".WADOKU_DIRNAME."/");
if (!defined("WADOKU_ROOT_PATH")) define("WADOKU_ROOT_PATH", ICMS_ROOT_PATH."/modules/".WADOKU_DIRNAME."/");
if (!defined("WADOKU_IMAGES_URL")) define("WADOKU_IMAGES_URL", WADOKU_URL."images/");
if (!defined("WADOKU_ADMIN_URL")) define("WADOKU_ADMIN_URL", WADOKU_URL."admin/");

// Include the common language file of the module
icms_loadLanguageFile("wadoku", "common");
