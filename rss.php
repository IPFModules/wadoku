<?php
/**
 * Generating an RSS feed
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

/** Include the module's header for all pages */
include_once 'header.php';
include_once ICMS_ROOT_PATH . '/header.php';

/** To come soon in imBuilding...

$clean_post_uid = isset($_GET['uid']) ? intval($_GET['uid']) : FALSE;

$wadoku_feed = new icms_feeds_Rss();

$wadoku_feed->title = $icmsConfig['sitename'] . ' - ' . $icmsModule->name();
$wadoku_feed->url = XOOPS_URL;
$wadoku_feed->description = $icmsConfig['slogan'];
$wadoku_feed->language = _LANGCODE;
$wadoku_feed->charset = _CHARSET;
$wadoku_feed->category = $icmsModule->name();

$wadoku_post_handler = icms_getModuleHandler("post", basename(dirname(__FILE__)), "wadoku");
//WadokuPostHandler::getPosts($start = 0, $limit = 0, $post_uid = FALSE, $year = FALSE, $month = FALSE
$postsArray = $wadoku_post_handler->getPosts(0, 10, $clean_post_uid);

foreach($postsArray as $postArray) {
	$wadoku_feed->feeds[] = array (
	  'title' => $postArray['post_title'],
	  'link' => str_replace('&', '&amp;', $postArray['itemUrl']),
	  'description' => htmlspecialchars(str_replace('&', '&amp;', $postArray['post_lead']), ENT_QUOTES),
	  'pubdate' => $postArray['post_published_date_int'],
	  'guid' => str_replace('&', '&amp;', $postArray['itemUrl']),
	);
}

$wadoku_feed->render();
*/