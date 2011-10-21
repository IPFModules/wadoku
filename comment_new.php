<?php
/**
 * New comment form
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

include_once "header.php";
$com_itemid = isset($_GET["com_itemid"]) ? (int)$_GET["com_itemid"] : 0;
if ($com_itemid > 0) {
	$wadoku_japaneseword_handler = icms_getModuleHandler("japaneseword", basename(dirname(__FILE__)), "wadoku");
	$japanesewordObj = $wadoku_japaneseword_handler->get($com_itemid);
	
	if ($japanesewordObj && !$japanesewordObj->isNew()) {
		$bodytext = $japanesewordObj->getVar('midashi_go_field');
		if ($bodytext != '') {
			$com_replytext .= $bodytext;
		}
		$com_replytitle = $japanesewordObj->getVar('japaneseword_id');
		include_once ICMS_ROOT_PATH .'/include/comment_new.php';
	}
}