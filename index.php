<?php
/**
 * @template	Template by Jan Pavelka ( http://www.phoca.cz/ )
 * @copyright	Template - Copyright (C) 2011 Jan Pavelka
 * @copyright	Joomla! CMS - Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.
 * License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */
use Joomla\CMS\Factory;use Joomla\CMS\HTML\HTMLHelper;defined('_JEXEC') or die;


$app 				= Factory::getApplication();
$doc 				= Factory::getDocument();
$this->language 	= $doc->language;
$this->direction 	= $doc->direction;
$siteName 			= $app->get('sitename');
$paramsT			= $app->getTemplate(true)->params;

$logo       			= $this->params->get('display_logo', 1);
$siteTitle				= $paramsT->get('sitetitle', '');
$logoContent   			= $this->params->get('logo', '');
if($logoContent == '') {
	$logoContent = 'templates/phoca_pos/images/logo.png';
}

$view 		= $app->input->get('view', '');
$option 	= $app->input->get('option', '');

$dR	= ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$dL	= ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));
// Content
if (!$dL && !$dR)	{$c = 12;}
if ($dL || $dR)		{$c = 9;}
if ($dL && $dR)		{$c = 6;}

// Bottom
$b = $b2 = $b9 = $b10 = $b11 = 0;
if ($this->countModules('position-9')) 	{$b9 	= 1;}
if ($this->countModules('position-10'))	{$b10 	= 1;}
if ($this->countModules('position-11'))	{$b11 	= 1;}
$b2 = $b9 + $b10 + $b11;
if ($b2 > 0) {$b = 12/($b2);}
$b9 	= $b9 * $b;
$b10	= $b10 * $b;
$b11	= $b11 * $b;

// Content Bottom
$d = $d2 = $d19 = $d20 = $d21 = 0;
if ($this->countModules('position-19')) {$d19 	= 1;}
if ($this->countModules('position-20'))	{$d20 	= 1;}
if ($this->countModules('position-21'))	{$d21 	= 1;}
$d2 = $d19 + $d20 + $d21;

/*if ($c == 9 && $d2 == 2) {
	if ($d19 == 1) 	{$d19 = 4;} else {$d19 = 1;}
	if ($d20 == 1) 	{$d20 = 4;} else {$d20 = 1;}
	if ($d21 == 1) 	{$d21 = 4;} else {$d21 = 1;}
} else {
Columns 19  -  21 are independent to whole site, they always have 12
*/
	if ($d2 > 0) {$d = 12/($d2);}
	$d19 	= $d19 * $d;
	$d20	= $d20 * $d;
	$d21	= $d21 * $d;
//}

$tO = "col-xs-12 col-sm-12 col-md-12";
$hO = "col-xs-12 col-sm-6 col-md-6";

$cO = "col-xs-12 col-sm-$c col-md-$c";
$lO = "col-xs-12 col-sm-3 col-md-3";
$rO = "col-xs-12 col-sm-3 col-md-3";

if ($b9 == 0) {$xs = 0;} else {$xs = 12;}
$b9O  = "col-xs-$xs col-sm-$b9 col-md-$b9";
if ($b10 == 0) {$xs = 0;} else {$xs = 12;}
$b10O = "col-xs-$xs col-sm-$b10 col-md-$b10";
if ($b11 == 0) {$xs = 0;} else {$xs = 12;}
$b11O = "col-xs-$xs col-sm-$b11 col-md-$b11";


if ($d19 == 0) {$xs = 0;} else {$xs = 12;}
$d19O = "col-xs-$xs col-sm-$d19 col-md-$d19";
if ($d20 == 0) {$xs = 0;} else {$xs = 12;}
$d20O = "col-xs-$xs col-sm-$d20 col-md-$d20";
if ($d21 == 0) {$xs = 0;} else {$xs = 12;}
$d21O = "col-xs-$xs col-sm-$d21 col-md-$d21";

$logoO = '';
if ($logo == 1) {
	$logoO = '<img src="'.$this->baseurl.'/'. htmlspecialchars($logoContent). '"  alt="'.htmlspecialchars($siteTitle).'" />';
}
if ($logo == 0 ) {
	if (htmlspecialchars($siteTitle != '')) {
		$logoO = htmlspecialchars($siteTitle);
	} else {
		$logoO = htmlspecialchars($app->getCfg('sitename'));
	}
}


JHtml::_('bootstrap.framework');
//JHtmlBootstrap::loadCss(true, $this->direction);
JHtml::_('jquery.framework', false);

$document = Factory::getDocument();
$scripts = array_keys($document->_scripts);
/*
$bMinJs = JURI::base(true) . '/media/com_phocacart/bootstrap/js/bootstrap.min.js';
$bMinJsLoaded = false;
if (in_array($bMinJs, $scripts)) {
	$bMinJsLoaded = true;
}*/



?><!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<jdoc:include type="head" />
    <link href="<?php echo $this->baseurl ?>/templates/phoca_pos/bootstrap/css/bootstrap.min.css"  rel="stylesheet" media="screen">
    <link href="<?php echo $this->baseurl ?>/templates/phoca_pos/fontawesome/css/all.min.css"  rel="stylesheet" media="screen">
	<link href="<?php echo $this->baseurl ?>/templates/phoca_pos/css/template.css"  rel="stylesheet" media="screen">
	<link href="<?php echo $this->baseurl ?>/templates/phoca_pos/themes/main/theme.css"  rel="stylesheet" media="screen">
</head>
<?php if ($option == 'com_phocacart' && $view == 'pos') {

// POS VIEW
echo '<body id="phocaPosSite">';
echo '<jdoc:include type="message" />';
echo '<jdoc:include type="component" />';
echo '<jdoc:include type="modules" name="debug" style="none" />';
echo '</body>';

} else {

?><body id="phoca-site">

<div class="phoca-slideshow-top-image-box">

<?php /*
<div class="phoca-header">
	<div class="container">
		<div class="row">
			<div class="<?php echo $hO; ?>">
				<a class="navbar-brand" href="<?php echo $this->baseurl ?>"><?php echo $logoO; ?></a>
			</div>
			<div class="<?php echo $hO; ?>">
				<?php if ($this->countModules('position-15')) { ?>
				<div class="phoca-banner pull-right"><jdoc:include type="modules" name="position-15" /></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div> */ ?>

<div class="phoca-nav-top"></div>
<div id="phnav" class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#phoca-nav">
		  <span class="sr-only"><?php echo JText::_('TPL_phoca_pos_TOGGLE_NAVIGATION') ?></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<div class="navbar-collapse nav-collapse collapse" id="phoca-nav">
			<a class="navbar-brand" href="<?php echo $this->baseurl ?>"><?php echo $logoO; ?></a>
			<jdoc:include type="modules" name="position-1" style="phocaTopMenu" />
		</div>
	</div>

	<div class="phoca-top-utils">
				<?php if ($this->countModules('position-22')) { ?>
				<div class=" phoca-cart-box"><jdoc:include type="modules" name="position-22"  /></div>
				<?php } ?>

				<div class=" phoca-search" role="search"><jdoc:include type="modules" name="position-0" /></div>
			</div>

</div>
<div class="phoca-nav-bottom"></div>

<?php if ($this->countModules('position-15')) { ?>
<div class="phoca-banner"><jdoc:include type="modules" name="position-15" /></div>
<?php } ?>

<?php if ($this->countModules('position-26')) { ?>
<div class="phoca-slideshow"><jdoc:include type="modules" name="position-26"  /></div>
<?php } ?>


</div>

<?php if ($this->countModules('position-2')) { ?>
<div class="container phoca-breadcrumbs-box">
	<div class="row">
		<div class="<?php echo $tO; ?>">
			<div class="breadcrumbs phoca-breadcrumbs"><jdoc:include type="modules" name="position-2" /></div>
		</div>
	</div>
</div>
<?php } else {

	echo '<div class="ph-top-container">&nbsp;</div>';
}?>

<div class="phoca-body container">
	<div class="row">
		<?php if ($dL) { ?>
		<div class="<?php echo $lO;?>">
			<jdoc:include type="modules" name="position-7" style="phocaBasic" headerLevel="3" />
			<jdoc:include type="modules" name="position-4" style="phocaBasic" headerLevel="3" />
			<jdoc:include type="modules" name="position-5" style="phocaDivision" headerLevel="2" />
		</div>
		<div class="clearfix visible-xs"></div>
		<?php } ?>

		<div class="<?php echo $cO; ?>">
			<?php if ($this->countModules('position-12')) { ?>
			<div class="phoca-body-top"><jdoc:include type="modules" name="position-12" /></div>
			<?php } ?>
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			<div class="phoca-hr clearfix visible-xs">&nbsp;</div>
				<div class="row">
					<div class="<?php echo $d19O; ?> phoca-module"><jdoc:include type="modules" name="position-19" style="phocaBasic" headerlevel="3" /></div><div class="clearfix visible-xs"></div>
					<div class="<?php echo $d20O; ?> phoca-module"><jdoc:include type="modules" name="position-20" style="phocaBasic" headerlevel="3" /></div><div class="clearfix visible-xs"></div>
					<div class="<?php echo $d21O; ?> phoca-module"><jdoc:include type="modules" name="position-21" style="phocaBasic" headerlevel="3" /></div><div class="clearfix visible-xs"></div>
				</div>
			<?php if ($d19 || $d20 || $d21) { ?>
				<div class="clearfix visible-xs"></div>
			<?php } ?>
		</div>

		<?php if ($dR) { ?>
		<div class="<?php echo $rO;?>">
			<jdoc:include type="modules" name="position-6" style="phocaBasic"  headerLevel="3"/>
			<jdoc:include type="modules" name="position-8" style="phocaBasic"  headerLevel="3"  />
			<jdoc:include type="modules" name="position-3" style="phocaBasic"  headerLevel="3"  />
		</div>
		<div class="clearfix visible-xs"></div>
		<?php } ?>
	</div>
</div>


<div class="phoca-bottom">
	<div class="container">
		<div class="row">
			<div class="<?php echo $b9O; ?>"><jdoc:include type="modules" name="position-9" style="phocaDivision" headerlevel="3" /></div>
			<div class="<?php echo $b10O; ?>"><jdoc:include type="modules" name="position-10" style="phocaDivision" headerlevel="3" /></div>
			<div class="<?php echo $b11O; ?>"><jdoc:include type="modules" name="position-11" style="phocaDivision" headerlevel="3" /></div>
		</div>
		<?php if ($b9 || $b10 || $b11) { ?>
				<div class="phoca-hrg clearfix visible-xs">&nbsp;</div>
		<?php } ?>

		<?php if ($this->countModules('position-14')) { ?>
			<div class="row">
				<div class="<?php echo $tO; ?>">
					<div class="phoca-footer-top"><jdoc:include type="modules" name="position-14" /></div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<div class="phoca-footer-bottom">
	<div class="container">
		<div class="row">
			<div><?php include_once('templates.php'); ?></div>
		</div>
	</div>
</div>
<jdoc:include type="modules" name="debug" style="none" />

</body><?php
} ?>
</html>
