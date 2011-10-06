<?php
/**
 * Footer page included at the end of each page on user side of the mdoule
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

$icmsTpl->assign("wadoku_adminpage", "<a href='" . ICMS_URL . "/modules/" . icms::$module->getVar("dirname") . "/admin/index.php'>" ._MD_WADOKU_ADMIN_PAGE . "</a>");
$icmsTpl->assign("wadoku_is_admin", icms_userIsAdmin(WADOKU_DIRNAME));
$icmsTpl->assign('wadoku_url', WADOKU_URL);
$icmsTpl->assign('wadoku_images_url', WADOKU_IMAGES_URL);

$xoTheme->addStylesheet(WADOKU_URL . 'module' . ((defined("_ADM_USE_RTL") && _ADM_USE_RTL) ? '_rtl' : '') . '.css');

include_once ICMS_ROOT_PATH . '/footer.php';