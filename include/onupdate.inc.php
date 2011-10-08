<?php
/**
 * File containing onUpdate and onInstall functions for the module
 *
 * This file is included by the core in order to trigger onInstall or onUpdate functions when needed.
 * Of course, onUpdate function will be triggered when the module is updated, and onInstall when
 * the module is originally installed. The name of this file needs to be defined in the
 * icms_version.php
 *
 * <code>
 * $modversion['onInstall'] = "include/onupdate.inc.php";
 * $modversion['onUpdate'] = "include/onupdate.inc.php";
 * </code>
 *
 * @copyright	(c) by René Sato
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		佐藤レネー René Sato <rene.sato@gmx.de>
 * @package		wadoku
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

// this needs to be the latest db version
define('WADOKU_DB_VERSION', 1);

/**
 * it is possible to define custom functions which will be call when the module is updating at the
 * correct time in update incrementation. Simpy define a function named <direname_db_upgrade_db_version>
 */
/*
function wadoku_db_upgrade_1() {
}
function wadoku_db_upgrade_2() {
}
*/

function icms_module_update_wadoku($module) {
	/**
	 * Using the IcmsDatabaseUpdater to automaticallly manage the database upgrade dynamically
	 * according to the class defined in the module
	 */
	$icmsDatabaseUpdater = XoopsDatabaseFactory::getDatabaseUpdater();
	$icmsDatabaseUpdater->moduleUpgrade($module);
    return TRUE;
}

function icms_module_install_wadoku($module) {
	global $xoopsDB;
	
	// insert some licenses so that it is ready for use on installation
	$queries = array();
	
	// a generic tag to hold untagged content
	$queries[] = "INSERT into " . $xoopsDB->prefix('wadoku_japaneseword') . " (`japaneseword_id`, `midashi_go_field`, `hiragana_field`, `romaji_field`, `transkription_field`, `translation_field`, `entry_tags_field`, `userid_field`, `word_date_field`, `admin_extra_field`, `counter`, `meta_keywords`, `meta_description`, `short_url`) values 
	(1, '和独', 'わどく', 'WaDoku', '[N.]', '[1] Japanisch und Deutsch || (als adnominales Attribut) japanisch-deutsch (z.B. Wörterbuch) || Japan (n) und Deutschland (n). [2] japanisch-deutsches Wörterbuch n. => <Wadoku·jiten> (和独辞典)', '', 5, 1317395400, '', 0, '', '和独', '%E5%92%8Cc%8B%AC'),
	(2, '調べる', 'しらべる', 'shiraberu', '[1‑st. trans. V. auf <‑e>]', 'untersuchen; prüfen; erforschen; ermitteln; nachforschen; durchsehen; nachschlagen; verhören; zensieren.', '', 5, 1317395400, '', 0, '', '調べる', 'e%AA%BF%E3%81%B9%E3%82%8B'),
	(3, '払う', 'はらう', 'harau', '[5‑st. trans. V. auf ‑[w]a mit Geminaten-Onbin = <‑tte>]', '[1] bezahlen; zahlen; begleichen. [2] abwischen; abstauben; abfegen; wegfegen; wegbürsten; ausbürsten. [3] vertreiben; beschwören; besprechen.', '', 5, 1317870000, '', 0, '', '払う', '%E6%89%95%E3%81%86'),
	(4, '届ける', 'とどける', 'todokeru', '[1‑st. trans. V. auf <‑e>]', '[1] melden; benachrichtigen. [2] senden; liefern; schicken; zuschicken; abgeben.', '', 5, 1317882600, '', 0, '', '届ける', '%E5%B1%8A%E3%81%91%E3%82%8B'),
	(5, '閉める', 'しめる', 'shimeru', '[1‑st. trans. V. auf <‑e>]', 'schließen; zuschließen.', '', 5, 1317883200, '', 0, '', '閉める', 'e%96%89%E3%82%81%E3%82%8B'),
	(6, '選ぶ; △択ぶ; ×撰ぶ', 'えらぶ', 'erabu', '[5‑st. trans. V. auf <‑ba>; mit regelm. Nasal‑Onbin = <‑nde>]', '[1] auswählen; auserwählen; auslesen. [2] wählen. [3] lieber mögen; vorziehen. [4] festlegen.', '', 5, 1317883200, '', 0, '', '選ぶ △択ぶ ×撰ぶ', 'e%81%B8%E3%81%B6-a%96%B3%E6%8A%9E%E3%81%B6-%C3%97%E6%92-%E3%81%B6'),
	(7, '×噛む', 'かむ', 'kamu', '[5‑st. trans. V. auf <‑ma>; mit regelm. Nasal‑Onbin = <‑nde>]', '[1] beißen. [2] kauen; nagen. [3] ugs. stammeln; sich versprechen.', '', 5, 1317883200, '', 0, '', '×噛む', '%C3%97%E5%99%9B%E3%82%80'),
	(8, '塗る', 'ぬる', 'nuru', '[5‑st. trans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>]', '[1] streichen; anstreichen; malen || bewerfen (mit Putz); stuckieren || tünchen; firnissen; glasieren || schminken. [2] die Schuld aufbürden; anschwärzen; in die Schuhe schieben; zur Last legen.', '', 5, 1317883800, '', 0, '', '塗る', '%E5%A1%97%E3%82%8B'),
	(9, '驚く; ×愕く; ×駭く', 'おどろく', 'odoroku', '[5‑st. intrans. V. auf <‑ka> mit i‑Onbin = <‑ite>]', '[1] erstaunt sein; sich wundern; überrascht sein; erschrecken; einen Schrecken bekommen; bestürzt sein; verwirrt sein; verblüfft sein. [2] beeindruckt sein; bewundern. [3] mit einem Schrecken bemerken. [4] aufwachen.', '', 5, 1317884400, '', 0, '', '驚く ×愕く ×駭く', 'e%A9%9A%E3%81%8F-%C3%97%E6%84%95%E3%81%8F-%C3%97e%A7%AD%E3%81%8F'),
	(10, '飾る', 'かざる', 'kazaru', '[5‑st. trans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>]', '[1] schmücken; verzieren; dekorieren; garnieren. [2] sich aufputzen; sich herausputzen; sich ausstaffieren. [3] ausstellen. [4] ausschmücken (z.B. eine Rede).', '', 5, 1317884400, '', 0, '', '飾る', 'e%A3%BE%E3%82%8B'),
	(11, '眠る', 'ねむる', 'nemuru', '[5‑st. intrans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>]', '[1] schlafen; schlummern; einschlafen. [2] entschlafen; sterben. [3] ertraglos liegen; nutzlos liegen.', '', 5, 1317885000, '', 0, '', '眠る', 'c%9C%A0%E3%82%8B'),
	(12, '×叱る; ×呵る', 'しかる', 'shikaru', '[5‑st. trans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>]', 'schimpfen; schelten; rügen; zurechtweisen (um den anderen zur besseren Einsicht zu bringen).', '', 5, 1317885000, '', 0, '', '×叱る ×呵る', '%C3%97%E5%8F%B1%E3%82%8B-%C3%97%E5%91%B5%E3%82%8B'),
	(13, '沸かす', 'わかす', 'wakasu', '[5‑st. trans. V. auf <‑sa>]', '[1] heiß machen; kochen; zum Kochen bringen; sieden. [2] aufregen; begeistern; erregen.', '', 5, 1317885600, '', 0, '', '沸かす、　沸す', '%E6%B2%B8%E3%81%8B%E3%81%99%E3%80%81%E3%80%80%E6%B2%B8%E3%81%99'),
	(22, '約束', 'やくそく', 'yakusoku', '[N.; mit <suru> trans. V.]', '[1] Versprechen n; Abmachung f; Vertrag m; Bedingungf. [2] Verabredung f; Rendezvousn; Daten. [3] Konvention f; Statutenfpl. [4] Bestimmung f; vorbestimmtes Schicksaln.', '', 5, 1317889800, '', 0, '', '約束', 'c%B4%84%E6%9D%9F'),
	(14, '冷える', 'ひえる', 'hieru', '[1‑st. intrans. V. auf <‑e>]', 'kalt werden; erkalten; abkühlen (auch übertr.)', '', 5, 1317885600, '', 0, '', '冷える', '%E5%86%B7%E3%81%88%E3%82%8B'),
	(15, '下がる', 'さがる', 'sagaru', '[5‑st. intrans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>]', '[1] herabhängen; herunterhängen. [2] fallen; sinken; sich senken. [3] verlassen; weggehen; sich zurückziehen. [4] zurücktreten; rückwärts gehen. [5] verliehen werden; bewilligt werden; gewährt werden.', '', 5, 1317885600, '', 0, '', '下がる、下る', 'a%B8%8B%E3%81%8C%E3%82%8B%E3%80%81a%B8%8B%E3%82%8B'),
	(16, '挙げる', 'あげる', 'ageru', '[1‑st. trans. od. intrans. V. auf <‑e>]', '[1] heben. [2] geben; anführen; erbringen. [3] (eine Zeremonie) abhalten. [4] gefangen genommen werden; festgenommen werden. [5] gebären.', '', 5, 1317885600, '', 0, '', '挙げる', '%E6%8C%99%E3%81%92%E3%82%8B'),
	(17, '治る', 'なおる', 'naoru', '[5‑st. intrans. V. auf <‑ra>; mit regelm. Geminaten-Onbin = <‑tte>]', 'genesen; heilen; wieder gesund werden.', '', 5, 1317886200, '', 0, '', '治る', '%E6%B2%BB%E3%82%8B'),
	(18, '戻す', 'もどす', 'modosu', '[5‑st. trans. V. auf <‑sa>]', '[1] zurückgeben; wiedergeben; wiederbringen; zurücksenden; zurücklegen; zurückzahlen. [2] zurückstellen; rückgängig machen; wiederherstellen; zurückfahren. [3] abweisen; zurückweisen. [4] sich übergeben; sich erbrechen.', '', 5, 1317886200, '', 0, '', '戻す', '%E6%88%BB%E3%81%99'),
	(19, '暮れる', 'くれる', 'kureru', '[1‑st. intrans. V. auf <‑e>]', '[1] dämmern; dunkel werden. [2] sich neigen; zu Ende gehen; Nacht werden; Abend werden. [3] ratlos sein.', '', 5, 1317886200, '', 0, '', '暮れる', '%E6%9A%AE%E3%82%8C%E3%82%8B'),
	(20, '×濡れる', 'ぬれる', 'nureru', '[1‑st. intrans. V. auf <‑e>]', 'nass werden; durchnässt werden.', '', 5, 1317886200, '', 0, '', '×濡れる', '%C3%97%E6%BF%A1%E3%82%8C%E3%82%8B'),
	(21, '売り場', 'うりば', 'uriba', '[N.]', 'Verkaufsstand m; Verkaufsabteilung f.', '', 5, 1317886800, '', 0, '', '売り場', '%E5%A3%B2%E3%82%8A%E5%A0%B4');
	";
	foreach($queries as $query) {
	$result = $xoopsDB->query($query);
	}
	return TRUE;
}