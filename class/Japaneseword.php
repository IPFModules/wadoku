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
		$this->quickInitVar("userid_field", XOBJ_DTYPE_INT, FALSE);
		$this->quickInitVar("word_date_field", XOBJ_DTYPE_LTIME, FALSE);
		$this->quickInitVar("admin_extra_field", XOBJ_DTYPE_TXTAREA, FALSE);
		$this->initCommonVar("counter");
		$this->setControl("userid_field", "user");
		
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
}
