<?php // $Id: locale_settings.php 12923 2011-03-03 14:23:57Z abourguignon $
/**
 * CLAROLINE
 *
 * @version 1.8 $Revision: 12923 $
 *
 * @copyright   (c) 2001-2011, Universite catholique de Louvain (UCL)
 *
 * @author: claro team <cvs@claroline.net>
 *
 * @package LANG-PL
*/
$englishLangName = "Polish";

$iso639_1_code = "pl";
$iso639_2_code = "pol";

$langNameOfLang['english']         = 'Angielski';
$langNameOfLang['arabic']          = 'Arabski';
$langNameOfLang['brazilian']       = 'Brazylijski';
$langNameOfLang['bulgarian']       = 'Bu�garski';
$langNameOfLang['zh_tw']           = 'Chi�ski tradycyjny';
$langNameOfLang['simpl_chinese']   = 'Chi�ski uproszczony';
$langNameOfLang['croatian']        = 'Chorwacki';
$langNameOfLang['czech']           = 'Czeski';
$langNameOfLang['czechSlovak']     = 'Czesko-s�owacki';
$langNameOfLang['danish']          = 'Du�ski';
$langNameOfLang['esperanto']       = 'Esperanto';
$langNameOfLang['estonian']        = 'Esto�ski';
$langNameOfLang['finnish']         = 'Fi�ski';
$langNameOfLang['french']          = 'Francuski';
$langNameOfLang['french_corp']     = 'Francuski Korp.';
$langNameOfLang['galician']        = 'Galicyjski';
$langNameOfLang['greek']           = 'Grecki';
$langNameOfLang['georgian']        = 'Gruzi�ski';
$langNameOfLang['guarani']         = 'Guarani';
$langNameOfLang['spanish']         = 'Hiszpa�ski';
$langNameOfLang['spanish_latin']   = 'Hiszpa�ski (Amer.�aci�ska)';
$langNameOfLang['dutch']           = 'Holenderski';
$langNameOfLang['indonesian']      = 'Indonezyjski';
$langNameOfLang['japanese']        = 'Japo�ski';
$langNameOfLang['catalan']         = 'Katalo�ski';
$langNameOfLang['lao']             = 'Laota�ski';
$langNameOfLang['malay']           = 'Malajski';
$langNameOfLang['german']          = 'Niemiecki';
$langNameOfLang['armenian']        = 'Ormia�ski';
$langNameOfLang['persian']         = 'Perski';
$langNameOfLang['polish']          = 'Polski';
$langNameOfLang['portuguese']      = 'Portugalski';
$langNameOfLang['russian']         = 'Rosyjski';
$langNameOfLang['romanian']        = 'Rumu�ski';
$langNameOfLang['slovenian']       = 'S�owe�ski';
$langNameOfLang['swedish']         = 'Szwedzki';
$langNameOfLang['thai']            = 'Tajski';
$langNameOfLang['turkish']         = 'Turecki';
$langNameOfLang['turkce']          = 'Turecki';
$langNameOfLang['ukrainian']       = 'Ukrai�ski';
$langNameOfLang['vietnamese']      = 'Wietnamski';
$langNameOfLang['hungarian']       = 'W�gierski';
$langNameOfLang['italian']         = 'W�oski';;

$charset = 'iso-8859-2';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, helvetica, arial, geneva, sans-serif';
$right_font_family = 'helvetica, arial, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('bajt�w', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$langDay_of_weekNames['init'] = array('N', 'P', 'W', '�', 'C', 'Pt', 'S');
$langDay_of_weekNames['short'] = array('Nie', 'Pon', 'Wt', '�r', 'Czw', 'Pt', 'Sob');
$langDay_of_weekNames['long'] = array('Niedziela', 'Poniedzia�ek', 'Wtorek', '�roda', 'Czwartek', 'Pi�tek', 'Sobota');

$langMonthNames['init']  = array('S', 'L', 'M', 'K', 'M', 'C', 'L', 'S', 'W', 'P', 'L', 'G');
$langMonthNames['short'] = array('Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'Pa�', 'Lis', 'Gru');
$langMonthNames['long'] = array('Stycze�', 'Luty', 'Marzec', 'Kwiecie�', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpie�', 'Wrzesie�', 'Pa�dziernik', 'Listopad', 'Grudzie�');

// Voir http://www.php.net/manual/en/function.strftime.php pour la variable
// ci-dessous

$dateFormatShort =  "%d %B %Y";
$dateFormatLong  = '%A, %d %B %Y';
$dateTimeFormatLong  = '%d %B %Y, %H:%M';
$timeNoSecFormat = '%H:%M';
$timespanfmt = '%s dni, %s godzin, %s minut i %s sekund';

?>