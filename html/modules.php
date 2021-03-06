<?php
/**
 * @template	Template by Jan Pavelka ( http://www.phoca.cz/ )
 * @copyright	Template - Copyright (C) 2011 Jan Pavelka
 * @copyright	Joomla! CMS - Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.
 * License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 *
 * Based on:
 * @version		$Id: modules.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	tpl_beez2
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * beezDivision chrome.
 *
 * @since	1.6
 */
function modChrome_phocaDivision($module, &$params, &$attribs)
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
	if (!empty ($module->content)) { ?>
<div class="moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
<?php if ($module->showtitle) { ?> <h<?php echo $headerLevel; ?>><span
	class="backh"><span class="backh2"><span class="backh3"><?php echo $module->title; ?></span></span></span></h<?php echo $headerLevel; ?>>
<?php }; ?> <?php echo $module->content; ?></div>
<?php };
}

function modChrome_phocaBasic($module, &$params, &$attribs)
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
	if (!empty ($module->content)) : ?>
	<div class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
        <div class="phoca-in">
		<?php if ($module->showtitle != 0) : ?>
		<h<?php echo $headerLevel; ?> class="module-title"><?php echo $module->title; ?></h<?php echo $headerLevel; ?>>
		<?php endif; ?>
	    <div class="module-content">
	        <?php echo $module->content; ?>
        </div>
        </div>
	</div>
	<?php endif;    
}

/**
 * beezHide chrome.
 *
 * @since	1.6
 */
function modChrome_phocaHide($module, &$params, &$attribs)
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
	$state=isset($attribs['state']) ? (int) $attribs['state'] :0;

	if (!empty ($module->content)) { ?>

<div
	class="moduletable_js <?php echo htmlspecialchars($params->get('moduleclass_sfx'));?>"><?php if ($module->showtitle) : ?>
<h<?php echo $headerLevel; ?> class="js_heading"><span class="backh"> <span
	class="backh1"><?php echo $module->title; ?> <a href="#"
	title="<?php echo JText::_('TPL_PHOCA_POS_CLICK'); ?>"
	onclick="auf('module_<?php echo $module->id; ?>'); return false"
	class="opencloselink" id="link_<?php echo $module->id?>"> <span
	class="no"><img src="templates/phoca_pos/images/plus.png"
	alt="<?php if ($state == 1) { echo JText::_('TPL_PHOCA_POS_ALTOPEN');} else {echo JText::_('TPL_PHOCA_POS_ALTCLOSE');} ?>" />
</span></a></span></span></h<?php echo $headerLevel; ?>> <?php endif; ?>
<div class="module_content <?php if ($state==1){echo "open";} ?>"
	id="module_<?php echo $module->id; ?>" tabindex="-1"><?php echo $module->content; ?></div>
</div>
	<?php }
}

/**
 * beezTabs chrome.
 *
 * @since	1.6
 */
function modChrome_phocaTabs($module, $params, $attribs)
{
	$area = isset($attribs['id']) ? (int) $attribs['id'] :'1';
	$area = 'area-'.$area;

	static $modulecount;
	static $modules;

	if ($modulecount < 1) {
		$modulecount = count(JModuleHelper::getModules($attribs['name']));
		$modules = array();
	}

	if ($modulecount == 1) {
		$temp = new stdClass();
		$temp->content = $module->content;
		$temp->title = $module->title;
		$temp->params = $module->params;
		$temp->id=$module->id;
		$modules[] = $temp;
		// list of moduletitles
		// list of moduletitles
		echo '<div id="'. $area.'" class="tabouter"><ul class="tabs">';

		foreach($modules as $rendermodule) {
			echo '<li class="tab"><a href="#" id="link_'.$rendermodule->id.'" class="linkopen" onclick="tabshow(\'module_'. $rendermodule->id.'\');return false">'.$rendermodule->title.'</a></li>';
		}
		echo '</ul>';
		$counter=0;
		// modulecontent
		foreach($modules as $rendermodule) {
			$counter ++;

			echo '<div tabindex="-1" class="tabcontent tabopen" id="module_'.$rendermodule->id.'">';
			echo $rendermodule->content;
			if ($counter!= count($modules))
			{
			echo '<a href="#" class="unseen" onclick="nexttab(\'module_'. $rendermodule->id.'\');return false;" id="next_'.$rendermodule->id.'">'.JText::_('TPL_PHOCA_POS_NEXTTAB').'</a>';
			}
			echo '</div>';
		}
		$modulecount--;
		echo '</div>';
	} else {
		$temp = new stdClass();
		$temp->content = $module->content;
		$temp->params = $module->params;
		$temp->title = $module->title;
		$temp->id = $module->id;
		$modules[] = $temp;
		$modulecount--;
	}
}
