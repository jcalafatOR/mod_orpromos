<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_orpromos
 *
 * @copyright   Copyright (C) 2019 - 2020 openROOM. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$orPB_Class = new orPromoBanner($params, $moduleclass_sfx);
/*
$orPromos_now = date("Y-m-d H:i:s"); 
$orPromos_list = array();
$orPromos_cuenta = 0;
for($i=1; $i<=10; $i++)
{
	if($params->get('b'.$i.'_activar') == 1 
	&& (empty($params->get('b'.$i.'_timein')) || $params->get('b'.$i.'_timein') <= $orPromos_now) 
	&& (empty($params->get('b'.$i.'_timeout')) || $params->get('b'.$i.'_timeout') > $orPromos_now))
	{
		$tmp_arrayBanner = array();
		$tmp_arrayBanner['img'] = $params->get('b'.$i.'_image');
		$tmp_arrayBanner['order'] = $params->get('b'.$i.'_order');
		$tmp_arrayBanner['content'] = $params->get('b'.$i.'_content');
		$tmp_arrayBanner['timein'] = !empty($params->get('b'.$i.'_timein')) ? $params->get('b'.$i.'_timein') : $orPromos_now;
		$tmp_arrayBanner['timeout'] = $params->get('b'.$i.'_timeout');
		$orPromos_list[$tmp_arrayBanner['order']][$tmp_arrayBanner['timein']][$i] = $tmp_arrayBanner;
		$orPromos_cuenta++;
	}
}
$orPromosClases = explode(" ", $moduleclass_sfx);
$orPromosClases = implode(".", array_filter($orPromosClases, "strlen"));
$orPromosClases = !empty($orPromosClases) ? ".".$orPromosClases : "";

*/


if(count($orPB_Class->lista) > 0) { ?>
<style>
	/*.or_promoBanner<?php echo $orPB_Class->blockCss; ?> > .or_promoBanner_content > .or_promoBanner_contentBlocks > [class^="or_promoBanner_"]
	{
		background-size : cover;
		background-position: center;
		background-repeat: no-repeat;
	}
	<?php
		$or_tmpCuerrentLang = JFactory::getLanguage();
        $or_tmpDefaultLang = JComponentHelper::getParams('com_languages')->get('site');
		$orsliderRouteFix = $or_tmpCuerrentLang->getTag() != $or_tmpDefaultLang ? "../" : "";
		foreach($orPromos_list as $or_promoBanner_id => $or_promoBanner_content) {
			if(JFile::exists(substr($or_promoBanner_content['img'],0,-3).'webp'))
			{ ?>
				.or_promoBanner<?php echo $orPromosClases; ?> > .or_promoBanner_content > .or_promoBanner_contentBlocks > .or_promoBanner_<?php echo ($or_promoBanner_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.substr($or_promoBanner_content['img'],0,-3).'webp';?>); }
				.isSafari .or_promoBanner<?php echo $orPromosClases; ?> > .or_promoBanner_content > .or_promoBanner_contentBlocks > .or_promoBanner_<?php echo ($or_promoBanner_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.$or_promoBanner_content['img'];?>); }
				@supports (-webkit-touch-callout: default) {
					.or_promoBanner<?php echo $orPromosClases; ?> > .or_promoBanner_content > .or_promoBanner_contentBlocks > .or_promoBanner_<?php echo ($or_promoBanner_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.$or_promoBanner_content['img'];?>); }
				}
			
			<?php } else { ?>
				.or_promoBanner<?php echo $orPromosClases; ?> > .or_promoBanner_content > .or_promoBanner_contentBlocks > .or_promoBanner_<?php echo ($or_promoBanner_id+1); ?> { background-image : url(<?php echo $orsliderRouteFix.$or_promoBanner_content['img'];?>); }
			<?php } ?>			
		
	<?php } ?>*/
</style>
<?php } ?>
<div class="or_promoBanner <?php echo $moduleclass_sfx; ?>"  >
	<?php if(!empty($module->content)){ ?>
	<div class="or_blockwidth">
		<?php echo $module->content; ?>
	</div>
	<?php }
	$orPromoBannerCount = 1;
	if(count($orPB_Class->lista) > 0) { 
		echo '<div class="or_promoBanner_block">';
		//$orPromos_list[$tmp_arrayBanner['order']][$tmp_arrayBanner['timein']][$i]
		foreach($orPB_Class->lista as $tmp_order => $tmp_arrayTime)
		{
			foreach($tmp_arrayTime as $tmp_time => $tmp_arrayBanner)
			{
				foreach($tmp_arrayBanner as $tmp_banner => $tmp_arrayData)
				{
					$orPromoBannerCierres = 0;
					/* Estructura según el número de banners */
					switch($orPromoBannerCount)
					{
						case 1: // Primer Banner
							$tmp_block_width = $orPromos_cuenta > 1 ? "orPBC_50" : "orPBC_100";	// si hay más de uno, reducimos a la mitad el tamaño, sino queocupe el 100%
							$tmp_block_width .= $orPromos_cuenta > 5 ? "orPBC_column" : "";	// si hay más de 5, el primer bloque contiene varios, añadimos "column effect"
							
							echo $orPromoBanner->abrir($tmp_block_width);
							if($orPromos_cuenta > 5)
							{
								$tmp_block_width = "orPBC_100";
								echo $orPromoBanner->abrir($tmp_block_width);
								if($orPromos_cuenta > 7)
								{
									$tmp_block_width = "orPBC_50";
									echo $orPromoBanner->abrir($tmp_block_width);
								}								
							}

							$orPromoBannerCierres = 1;
						break;
						case 2:	// 2º Banner
							// *** Aperturas
							$tmp_block_width = $orPromos_cuenta == 6 ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPromos_cuenta >= 3 && $orPromos_cuenta <= 5 ? "orPBC_column" : "";
							echo $orPromoBanner->abrir($tmp_block_width);
							if($orPromos_cuenta >= 3 || $orPromos_cuenta <= 5)
							{
								$tmp_block_width = "orPBC_100";
								echo $orPromoBanner->abrir($tmp_block_width);
								if($orPromos_cuenta == 4 || $orPromos_cuenta == 5)
								{
									$tmp_block_width = "orPBC_50";
									echo $orPromoBanner->abrir($tmp_block_width);
								}
							}
							// *** Cierres
							$orPromoBannerCierres = $orPromos_cuenta < 6 ? 1 : 2;

						break;
						case 3:	// 3º Banner
							// *** Aperturas
							$tmp_block_width = ($orPromos_cuenta == 3 || $orPromos_cuenta == 8 || $orPromos_cuenta == 7) ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPromos_cuenta == 6 ? "orPBC_column" : "";
							echo $orPromoBanner->abrir($tmp_block_width);
							if($orPromos_cuenta == 8 || $orPromos_cuenta == 6)
							{
								if($orPromos_cuenta == 6)
								{
									$tmp_block_width = "orPBC_100";
									echo $orPromoBanner->abrir($tmp_block_width);
								}
								$tmp_block_width = "orPBC_50";
								echo $orPromoBanner->abrir($tmp_block_width);
							}

							// *** Cierres
							$orPromoBannerCierres = ($orPromos_cuenta >=3 && $orPromos_cuenta <=5) || $orPromos_cuenta == 7 ? 2 : 1;

						break;
						case 4:	// 4º Banner
							// *** Aperturas
							$tmp_block_width = $orPromos_cuenta == 4 || $orPromos_cuenta == 5 ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPromos_cuenta == 7 ? "orPBC_column" : "";
							echo $orPromoBanner->abrir($tmp_block_width);
							if($orPromos_cuenta == 7 || $orPromos_cuenta == 5)
							{
								if($orPromos_cuenta == 7)
								{
									$tmp_block_width = "orPBC_100";
									echo $orPromoBanner->abrir($tmp_block_width);
								}
								$tmp_block_width = "orPBC_50";
								echo $orPromoBanner->abrir($tmp_block_width);
							}

							// *** Cierres
							$orPromoBannerCierres = ($orPromos_cuenta == 4 || $orPromos_cuenta == 6) ? 2 : 1;
							$orPromoBannerCierres = $orPromos_cuenta == 8 ? 3 : $orPromoBannerCierres;
						break;
						case 5:	// 5º Banner
							// *** Aperturas
							$tmp_block_width = $orPromos_cuenta == 6 ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPromos_cuenta == 8 ? "orPBC_column" : "";
							echo $orPromoBanner->abrir($tmp_block_width);

							if($orPromos_cuenta == 6 || $orPromos_cuenta == 8)
							{
								if($orPromos_cuenta == 8)
								{
									$tmp_block_width = "orPBC_100";
									echo $orPromoBanner->abrir($tmp_block_width);
								}
								$tmp_block_width = "orPBC_50";
								echo $orPromoBanner->abrir($tmp_block_width);
							}
							// *** Cierres
							$orPromoBannerCierres = $orPromos_cuenta == 7 ? 2 : 1;
							$orPromoBannerCierres = $orPromos_cuenta == 5 ? 3 : $orPromoBannerCierres;
						break;

						case 6:	// 6º Banner
							// *** Aperturas
							$tmp_block_width = $orPromos_cuenta == 7 ? "orPBC_100" : "orPBC_50";
							echo $orPromoBanner->abrir($tmp_block_width);

							if( $orPromos_cuenta == 7)
							{
								$tmp_block_width = "orPBC_50";
								echo $orPromoBanner->abrir($tmp_block_width);
							}
							// *** Cierres
							$orPromoBannerCierres = $orPromos_cuenta == 8 ? 2 : 1;
							$orPromoBannerCierres = $orPromos_cuenta == 6 ? 3 : $orPromoBannerCierres;
						break;
						

						case 7:	// 8º Banner
							// *** Aperturas
							$tmp_block_width = $orPromos_cuenta == 8 ? "orPBC_100" : "orPBC_50";
							echo $orPromoBanner->abrir($tmp_block_width);

							if( $orPromos_cuenta == 8)
							{
								$tmp_block_width = "orPBC_50";
								echo $orPromoBanner->abrir($tmp_block_width);
							}
							// *** Cierres
							$orPromoBannerCierres = $orPromos_cuenta == 7 ? 3 : 1;
						break;
						
						case 7:	// 8º Banner
							// *** Aperturas
							$tmp_block_width = "orPBC_50";
							echo $orPromoBanner->abrir($tmp_block_width);

							// *** Cierres
							$orPromoBannerCierres = 3;
						break;
					}

					echo $orPromoBanner->contenido($module->id.'_'.$tmp_banner, $tmp_arrayData['_contet']);
					echo $orPromoBanner->cierres($orPromoBannerCierres);
					$orPromoBannerCount++;	// Añadimos Banner al contador
				}
			}
		}		
		
		echo '</div>';
	} ?>
</div>
