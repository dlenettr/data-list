<?php
/*
=============================================
 Name      : MWS Data List v1.0
 Author    : Mehmet Hanoğlu ( MaRZoCHi )
 Site      : http://dle.net.tr/
 License   : MIT License
 Date      : 06.03.2018
=============================================
*/

session_start();

if ( ! defined( 'E_DEPRECATED' ) ) {
	@error_reporting ( E_ALL ^ E_NOTICE ^ E_STRICT );
	@ini_set ( 'error_reporting', E_ALL ^ E_NOTICE ^ E_STRICT );
} else {
	@error_reporting ( E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT );
	@ini_set ( 'error_reporting', E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT );
}

define ( 'DATALIFEENGINE', true );
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );
define ( 'LANG_DIR', ROOT_DIR . '/language/' );

require_once ENGINE_DIR . "/inc/include/functions.inc.php";
require_once ENGINE_DIR . "/data/config.php";
require_once ENGINE_DIR . "/classes/mysql.php";
require_once ENGINE_DIR . "/data/dbconfig.php";
require_once ENGINE_DIR . "/modules/sitelogin.php";
require_once ENGINE_DIR . "/api/api.class.php";
require_once ENGINE_DIR . "/classes/install.class.php";

date_default_timezone_set ( $config['date_adjust'] );

@header( "Content-type: text/html; charset=" . $config['charset'] );
require_once(ROOT_DIR."/language/".$config['langs']."/adminpanel.lng");

$Turkish = array ( 'm01' => "Kuruluma Başla", 'm02' => "Yükle", 'm03' => "Kaldır", 'm04' => "Yapımcı", 'm05' => "Çıkış Tarihi", 'm08' => "Kurulum Tamamlandı", 'm10' => "dosyasını silerek kurulumu bitirebilirsiniz", 'm11' => "Modül Kaldırıldı", 'm21' => "Kuruluma başlamadan önce olası hatalara karşı veritabanınızı yedekleyin", 'm22' => "Eğer herşeyin tamam olduğuna eminseniz", 'm23' => "butonuna basabilirsiniz.", 'm24' => "Güncelle", 'm25' => "Site", 'm26' => "Çeviri", 'm27' => "Hata", 'm28' => "Bu modül DLE sürümünüz ile uyumlu değil.", 'm29' => "Buradan sürümünüze uygun modülü isteyebilirsiniz" );
$English = array ( 'm01' => "Start Installation", 'm02' => "Install", 'm03' => "Uninstall", 'm04' => "Author", 'm05' => "Release Date", 'm06' => "Module Page", 'm07' => "Support Forum", 'm08' => "Installation Finished", 'm10' => "delete this file to finish installation", 'm11' => "Module Uninstalled", 'm21' => "Back up your database before starting the installation for possible errors", 'm22' => "If you are sure that everything is okay, ", 'm23' => "click button.", 'm24' => "Upgrade", 'm25' => "Site", 'm26' => "Translation", 'm27' => "Error", 'm28' => "This module not compatible with your DLE.", 'm29' => "You can ask for compatible version from here" );
$Russian = array ( 'm01' => "Начало установки", 'm02' => "Установить", 'm03' => "Удалить", 'm04' => "Автор", 'm05' => "Дата выпуска", 'm06' => "Страница модуля", 'm07' => "Форум поддержки", 'm08' => "Установка завершена", 'm10' => "удалите этот файл для окончания установки", 'm11' => "Модуль удален", 'm21' => "Сделайте резервное копирование базы данных для избежания возможных ошибок", 'm22' => "Если вы уверены что всё в порядке, ", 'm23' => "нажмите кнопку.", 'm24' => "Обновить", 'm25' => "сайт", 'm26' => "перевод", 'm27' => "Ошибка", 'm28' => "Этот модуль не совместим с вашей версией DLE.", 'm29' => "Вы можете сделать запрос относительно совместимой версии отсюда" );
$Ukrainian = array ( 'm01' => "Початок встановлення", 'm02' => "Встановити", 'm03' => "Видалити", 'm04' => "Автор", 'm05' => "Дата релізу", 'm06' => "Сторінка модуля", 'm07' => "Форум підтримки", 'm08' => "Встановлення завершено", 'm10' => "Видаліть цей файл, щоб завершити встановлення", 'm11' => "Модуль деінстальовано", 'm21' => "Зробіть резервне копіювання бази даних для уникнення можливих помилок", 'm22' => "Якщо ви впевнені що все гаразд, ", 'm23' => "натисніть кнопку.", 'm24' => "Оновити", 'm25' => "Сайт", 'm26' => "Переклад", 'm27' => "Помилка", 'm28' => "Цей модуль не сумісний з вашою версією DLE.", 'm29' => "Ви можете зробити запит щодо сумісної версії звідси" );
$lang = array_merge( $lang, ${$config['langs']} );

function mainTable_head( $title ) {
	echo <<< HTML
	<div class="panel panel-default">
		<div class="panel-heading">
			{$title}
		</div>
		<div class="panel-body">
			<table>
HTML;
}

function mainTable_foot() {
	echo <<< HTML
			</table>
		</div>
	</div>
HTML;
}

$module = array(
	'name'		=> "MWS Data List v1.0",
	'desc'		=> "Sınırsız sayıda eklenebilen ilave alanlar",
	'id'		=> "datalist",
	'icon'		=> "datalist.png",
	'date'		=> "06.03.2018",
	'ifile'		=> "install_module.php",
	'link'		=> "http://dle.net.tr",
	'image'		=> "http://img.dle.net.tr/mws/datalist.png",
	'author_n'	=> "Mehmet Hanoğlu (MaRZoCHi)",
	'author_s'	=> "http://mehmethanoglu.com.tr",
);


if ( $is_logged && $member_id['user_group'] == "1" ) {

	echoheader("");

	if ($_REQUEST['action'] == "install") {
		//$dle_api->install_admin_module($module['id'], $module['name'], $module['desc'], $module['icon'] , "1");
		$db->query("CREATE TABLE dle_data_list ( id INT(11) NOT NULL AUTO_INCREMENT , news_id INT(11) NOT NULL , data MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , PRIMARY KEY (id), UNIQUE (news_id)) ENGINE = InnoDB;");

		$mod = new VQEdit();
		$mod->bootup( $path = ROOT_DIR, $logging = True );
		$mod->file( ROOT_DIR. "/install/xml/datalist.xml" );
		$mod->close();

		mainTable_head($lang['m08']);
		$stat_info = str_replace("install.php", $module['ifile'], $lang['stat_install']);
		echo <<< HTML
	<table width="100%">
		<tr>
			<td width="210" align="center" valign="middle" style="padding:4px;">
				<img src="{$module['image']}" alt="" />
			</td>
			<td style="padding-left:20px;padding-top: 4px;" valign="top">
				<b><a href="{$module['link']}">{$module['name']}</a></b><br /><br />
				<b>{$lang['m04']}</b> : <a href="{$module['author_s']}">{$module['author_n']}</a><br />{$translation}
				<b>{$lang['m05']}</b> : <font color="#555555">{$module['date']}</font><br />
				<b>{$lang['m25']}</b> : <a href="{$module['link']}">{$module['link']}</a><br />
				<br /><br />
				<b><font color="#BF0000">{$module['ifile']}</font> {$lang['m10']}</b><br />
			</td>
		</tr>
	</table>
HTML;
		mainTable_foot();
	} else {
		mainTable_head($lang['m01']);
		echo <<< HTML
	<table width="100%">
		<tr>
			<td width="210" align="center" valign="middle" style="padding:4px;">
				<img src="{$module['image']}" alt="" /><br /><br />
			</td>
			<td style="padding-left:20px;padding-top: 4px;" valign="top">
				<b><a href="{$module['link']}">{$module['name']}</a></b><br /><br />
				<b>{$lang['m04']}</b> : <a href="{$module['author_s']}">{$module['author_n']}</a><br />{$translation}
				<b>{$lang['m05']}</b> : <font color="#555555">{$module['date']}</font><br />
				<b>{$lang['m25']}</b> : <a href="{$module['link']}">{$module['link']}</a><br />
				<br /><br />
				<b><font color="#BF0000">{$lang['m01']} ...</font></b><br /><br />
				<b>*</b> {$lang['m21']}<br />
				<b>*</b> {$lang['m22']} <font color="#51A351"><b>{$lang['m02']}</b></font> {$lang['m23']}<br />
			</td>
		</tr>
		<tr>
			<td width="150" align="left" style="padding:4px;"></td>
			<td colspan="2" style="padding:4px;" align="right">
				<form method="post" action="{$PHP_SELF}">
					<input type="hidden" value="install" name="action" />
					<input type="submit" value="{$lang['m02']}" class="btn bg-teal btn-raised" />
				</form>
			</td>
		</tr>
	</table>
HTML;
		mainTable_foot();
	}
	echofooter();
} else {
	msg("home", $lang['mws_noauth'], $lang['mws_noauth_text'], $config["http_home_url"]);
}
?>