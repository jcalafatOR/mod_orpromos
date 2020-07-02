<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_orpromos
 *
 * @copyright   Copyright (C) 2019 - 2020 openROOM. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if ($params->def('prepare_content', 1))
{
	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $module->content, '', 'mod_orpromos.content');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_orpromos', $params->get('layout', 'default'));
if (!class_exists('orPromoBanner')) {
	class orPromoBanner
	{
		public $now = date("Y-m-d H:i:s"); 
		public $lista = array();
		public $cuenta = 0;
		public $blockCss = 0;
		public function __construct($params, $moduleclass_sfx)
		{
			for($i=1; $i<=8; $i++)
			{
				if($params->get('b'.$i.'_activar') == 1 
				&& (empty($params->get('b'.$i.'_timein')) || $params->get('b'.$i.'_timein') <= $this->now) 
				&& (empty($params->get('b'.$i.'_timeout')) || $params->get('b'.$i.'_timeout') > $this->now))
				{
					$tmp_arrayBanner = array();
					$tmp_arrayBanner['img'] = $params->get('b'.$i.'_image');
					$tmp_arrayBanner['order'] = $params->get('b'.$i.'_order');
					$tmp_arrayBanner['content'] = $params->get('b'.$i.'_content');
					$tmp_arrayBanner['timein'] = !empty($params->get('b'.$i.'_timein')) ? $params->get('b'.$i.'_timein') : $this->now;
					$tmp_arrayBanner['timeout'] = $params->get('b'.$i.'_timeout');
					$this->lista[$tmp_arrayBanner['order']][$tmp_arrayBanner['timein']][$i] = $tmp_arrayBanner;
					$this->cuenta++;
				}
			}
			$this->blockCss = explode(" ", $moduleclass_sfx);
			$this->blockCss = implode(".", array_filter($this->blockCss, "strlen"));
			$this->blockCss = !empty($this->blockCss) ? ".".$this->blockCss : "";
			
			foreach($this->lista as $orId => $orContent)
			{
				krsort($this->lista[$orId]);
			}
		}

		public function cierres($num)
		{
			$rs = "";
			for($i=0;$num>$i; $i++)
			{
				$rs .="</div>";
			}
			return $rs;
		}
		
		public function abrir($clase) { return '<div class="or_promoBanner_container '.$clase.'">';	}
		public function contenido($nombre, $content) {return '<div id="or_promoBanner_'.$nombre.'">'.$content.'</div>';	}
	}
}