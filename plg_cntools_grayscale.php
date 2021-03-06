<?php
/**
 * plg_cntools_grayscale - Joomla Plugin
 *
 * @package    Joomla
 * @subpackage Plugin
 * @author Clemens Neubauer
 * @link https://github.com/cn-tools/
 * @license		GNU/GPL, see LICENSE.php
 * plg_cntools_grayscale is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class PlgSystemPlg_CNTools_GrayScale extends JPlugin
{
	//-- constructor ----------------------------------------------------------
	public function __construct(&$subject, $config)
	{
		parent::__construct( $subject, $config );
	}

	//-- onBeforeRender -------------------------------------------------------
	function onBeforeRender ()
	{
		$app = JFactory::getApplication();
		if($app->isAdmin() === true)
		{
			return;
		}

		$document = JFactory::getDocument();
		
		//-- add jQuery javascript file if needed -----------------------------
		if ($this->params->get('jquery', '-1') != '-1')
		{
			$document->addScript(JURI::root() . 'plugins/system/plg_cntools_grayscale/assets/jquery/' . $this->params->get('jquery', 'jquery-2.1.4.min.js'));
		}

		if ($this->params->get('use', 'cdn') == 'cdn')
		{
			$document->addStyleSheet('//npmcdn.com/jquery-gray@1.6.0/css/gray.min.css');
			$document->addScript('//npmcdn.com/jquery-gray@1.6.0/js/jquery.gray.min.js');
		} else {
			$document->addStyleSheet(JURI::base() . 'plugins/system/plg_cntools_grayscale/assets/css/' . $this->params->get('cssfile', 'gray.min.css') . '?v=1.6.0');
			$document->addScript(JURI::root() . 'plugins/system/plg_cntools_grayscale/assets/js/' . $this->params->get('jsfile', 'jquery.gray.min.js') . '?v=1.6.0');
		}

		$lScript = 'jQuery(function($) { $(\'' . $this->params->get('selector', '') . '\').addClass(\'' . $this->params->get('style', '') . '\') });';
		$document->addScriptDeclaration($lScript, 'text/javascript');

		return true;
	}
}
?>
