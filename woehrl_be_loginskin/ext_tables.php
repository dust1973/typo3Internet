<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

/**
 * Definieren Sie mit $TBE_STYLES['logo_login'] Ihre Wunschgrafik
 * Die Formate jpg, png und gif sollten ohne Probleme funktionieren
 * Ohne weitere Anpassungen sollte die sie nicht mehr als eine width von 430px
 **/
$TBE_STYLES['logo_login'] = '../typo3conf/ext/bootstrap_package/Resources/Public/Images/Backend/LoginLogo.png';

/**
 * Überschreiben Sie mit $TBE_STYLES['inDocStyles_TBEstyle'] die vorhanden Styles
 * oder Ihr eigenes Stylesheet einbinden:
 * $TBE_STYLES['inDocStyles_TBEstyle'] .= '@import "../fileadmin/deinPfad/deineCSS.css";
 **/
$TBE_STYLES['inDocStyles_TBEstyle'] .='
body#typo3-index-php {
background: none!importent;
background: #333;
}

#t3-copyright-notice {
	display:none;
}
#typo3-index-php .t3-login-field input.t3-login-submit {
	background-image: none;
	border-color: #fff;
	margin-bottom: 0px;
	height: auto;
	line-height: 34px;
	text-shadow: none;
	background-color: #333!important;
}
';
