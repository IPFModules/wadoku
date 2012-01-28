<?php
/**
 * Class representing wadoku japaneseword objects
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_wadoku_Japaneseword extends icms_ipf_seo_Object {
	
	//counter
	public $updating_counter = FALSE;
	
	/**
	 * Constructor
	 *
	 * @param mod_wadoku_Japaneseword $handler Object handler
	 */
	public function __construct(&$handler) {
		icms_ipf_object::__construct($handler);

		$this->quickInitVar("japaneseword_id", XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar("online_status", XOBJ_DTYPE_INT, TRUE, FALSE, FALSE, 1);
		$this->quickInitVar("midashi_go_field", XOBJ_DTYPE_TXTBOX, TRUE);
		$this->quickInitVar("hiragana_field", XOBJ_DTYPE_TXTBOX, TRUE);
		$this->quickInitVar("romaji_field", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("transkription_field", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("translation_field", XOBJ_DTYPE_TXTAREA, TRUE);
		$this->quickInitVar("entry_tags_field", XOBJ_DTYPE_TXTBOX, FALSE);
		//$this->quickInitVar("daijirin_field", XOBJ_DTYPE_TXTAREA, FALSE);
		//$this->quickInitVar("daijisen_field", XOBJ_DTYPE_TXTAREA, FALSE);
		$this->quickInitVar("userid_field", XOBJ_DTYPE_INT, TRUE, FALSE, FALSE, 1);
		$this->quickInitVar("word_date_field", XOBJ_DTYPE_LTIME, FALSE);
		$this->quickInitVar("admin_extra_field", XOBJ_DTYPE_TXTAREA, FALSE);
		
		//notifications
		$this->quickInitVar("notification_sent", XOBJ_DTYPE_INT, FALSE);
		
		$this->initCommonVar("counter");
		$this->setControl("userid_field", "user");
		
		//notifications
		$this->hideFieldFromForm("notification_sent");
		
		$this->setControl('online_status', 'yesno');
		$this->initiateSEO();
	}

	/**
	 * Overriding the icms_ipf_Object::getVar method to assign a custom method on some
	 * specific fields to handle the value before returning it
	 *
	 * @param str $key key of the field
	 * @param str $format format that is requested
	 * @return mixed value of the field that is requested
	 */
	public function getVar($key, $format = "s") {
		if ($format == "s" && in_array($key, array('online_status'))) {
			return call_user_func(array ($this,	$key));
		}
		return parent::getVar($key, $format);
	}
	
	/**
	* Converts the online status of an object to a human readable icon with link toggle
	*
	* @return string
	*/
	public function online_status() {
		$status = $button = '';
	
		$status = $this->getVar('online_status', 'e');
		$button = '<a href="' . ICMS_URL . '/modules/' . basename(dirname(dirname(__FILE__))) . '/admin/japaneseword.php?japaneseword_id=' . $this->getVar('japaneseword_id') . '&amp;op=changeStatus">';
		if (!$status) {
			$button .= '<img src="'. ICMS_IMAGES_SET_URL . '/actions/button_cancel.png" alt="' . _CO_WADOKU_JAPANESEWORD_OFFLINE . '" title="' . _CO_WADOKU_JAPANESEWORD_OFFLINE . '" /></a>';
				
		} else {
				
			$button .= '<img src="'. ICMS_IMAGES_SET_URL . '/actions/button_ok.png" alt="' . _CO_WADOKU_JAPANESEWORD_ONLINE	. '" title="' . _CO_WADOKU_JAPANESEWORD_ONLINE . '" /></a>';
		}
		return $button;
	}
	
	//counter
	function getReads() {
		return $this->getVar('counter');
	}
	
	function setReads($qtde = null) {
		$t = $this->getVar('counter');
		if (isset($qtde)) {
			$t += $qtde;
		} else {
			$t++;
		}
		$this->setVar('counter', $t);
	}
	
	//detailpage ACP (Aktions)
	public function getViewItemLink() {
		$ret = '<a href="' . WADOKU_ADMIN_URL . 'japaneseword.php?op=view&amp;japaneseword_id=' . $this->getVar('japaneseword_id', 'e') . '" title="' . _CO_JAPANESEWORD_VIEW . '"><img src="' . ICMS_IMAGES_SET_URL . '/actions/viewmag.png" /></a>';
		return $ret;
	}
	
	//detailpage ACP (go detailpage frontend)
	function getPreviewItemLink() {
		$ret = '<a href="' . WADOKU_URL . 'japaneseword.php?japaneseword_id=' . $this->getVar('japaneseword_id', 'e') . '" title="' . _CO_WADOKU_PREVIEW . '" target="_blank">' . $this->getVar('midashi_go_field') . '</a>';
		return $ret;
	}
	
	//detailpage for frontend
	function getItemLink($onlyUrl = FALSE) {
		$url = WADOKU_URL . 'japaneseword.php?japaneseword_id=' . $this -> getVar( 'japaneseword_id' );
		if ($onlyUrl) return $url;
		return '<a href="' . $url . '" title="' . $this -> getVar( 'midashi_go_field' ) . ' ">' . $this -> getVar( 'midashi_go_field' ) . '</a>';
	}
	
	//notifications
	function sendNotifVocabularyPublished() {
		$module = icms::handler('icms_module')->getByDirname(basename(dirname(dirname(__FILE__))));
		$tags ['WADOKU_TITLE'] = $this->getVar('midashi_go_field');
		$tags ['WADOKU_URL'] = $this->getItemLink(false);
		icms::handler('icms_data_notification')->triggerEvent('global', 0, 'new_vocabulary', $tags, array(), $module->getVar('mid'));
	}
	//notifications
	function sendNotifVocabularyUpdated() {
		$module = icms::handler('icms_module')->getByDirname(basename(dirname(dirname(__FILE__))));
		$tags ['WADOKU_TITLE'] = $this->getVar('midashi_go_field');
		$tags ['WADOKU_URL'] = $this->getItemLink(false);
		icms::handler('icms_data_notification')->triggerEvent('global', 0, 'vocabulary_modified', $tags, array(), $module->getVar('mid'));
	}
}
