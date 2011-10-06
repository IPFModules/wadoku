<?php
/**
 * Admin header file
 *
 * This file is included in all pages of the admin side and being so, it proceeds to a few
 * common things.
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

include_once "../../../include/cp_header.php";
include_once ICMS_ROOT_PATH . "/modules/" . basename(dirname(dirname(__FILE__))) . "/include/common.php";
if (!defined("WADOKU_ADMIN_URL")) define("WADOKU_ADMIN_URL", WADOKU_URL . "admin/");
include_once WADOKU_ROOT_PATH . "include/requirements.php";