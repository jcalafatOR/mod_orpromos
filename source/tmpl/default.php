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

if(count($orPB_Class->lista) > 0) { ?>
<style>
	.or_promoBanner_block
	{
		width: 100%;
		max-width: var(--or-width);
		margin-left: auto;
		margin-right: auto;
		display: flex;
	}
	.or_promoBanner_block .or_promoBanner_container { display: flex; min-height:200px; }
	.or_promoBanner_block .or_promoBanner_container.orPBC_100 { width: 100%; }
	.or_promoBanner_block .or_promoBanner_container.orPBC_50 { width: 50%; }
	.or_promoBanner_block .or_promoBanner_container.orPBC_column { flex-direction: column; }

	.or_promoBanner .or_promoBannerItem
	{
		background-size : cover;
		background-position: center;
		background-repeat: no-repeat;
		width: 100%;
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
		min-height: 200px;
		max-height: 400px;
	}
	<?php
		$or_tmpCuerrentLang = JFactory::getLanguage();
        $or_tmpDefaultLang = JComponentHelper::getParams('com_languages')->get('site');
		$orsliderRouteFix = $or_tmpCuerrentLang->getTag() != $or_tmpDefaultLang ? "../" : "";
		foreach($orPB_Class->lista as $tmp_order => $tmp_arrayTime) {
			
			foreach($tmp_arrayTime as $tmp_time => $tmp_arrayBanner)
			{
				foreach($tmp_arrayBanner as $tmp_banner => $tmp_arrayData)
				{
					if(JFile::exists(substr($tmp_arrayData['img'],0,-3).'webp'))
					{ ?>
						.or_promoBanner #or_promoBanner_<?php echo $module->id.'_'.$tmp_banner; ?> { background-image : url(<?php echo $orsliderRouteFix.substr($tmp_arrayData['img'],0,-3).'webp';?>); }
						.isSafari .or_promoBanner #or_promoBanner_<?php echo $module->id.'_'.$tmp_banner; ?> { background-image : url(<?php echo $orsliderRouteFix.$tmp_arrayData['img'];?>); }
						@supports (-webkit-touch-callout: default) {
							.or_promoBanner #or_promoBanner_<?php echo $module->id.'_'.$tmp_banner; ?> { background-image : url(<?php echo $orsliderRouteFix.$tmp_arrayData['img'];?>); }
						}
					
					<?php } else { ?>
						.or_promoBanner #or_promoBanner_<?php echo $module->id.'_'.$tmp_banner; ?> { background-image : url(<?php echo $orsliderRouteFix.$tmp_arrayData['img'];?>); }
					<?php } 
				}
			}?>			
		
	<?php } ?>
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
							$tmp_block_width = $orPB_Class->cuenta > 1 ? "orPBC_50" : "orPBC_100";	// si hay más de uno, reducimos a la mitad el tamaño, sino queocupe el 100%
							$tmp_block_width .= $orPB_Class->cuenta > 5 ? " orPBC_column" : "";	// si hay más de 5, el primer bloque contiene varios, añadimos "column effect"
							
							echo $orPB_Class->abrir($tmp_block_width);
							if($orPB_Class->cuenta > 5)
							{
								$tmp_block_width = "orPBC_100";
								echo $orPB_Class->abrir($tmp_block_width);
								if($orPB_Class->cuenta > 7)
								{
									$tmp_block_width = "orPBC_50";
									echo $orPB_Class->abrir($tmp_block_width);
								}								
							}

							$orPromoBannerCierres = 1;
						break;
						case 2:	// 2º Banner
							// *** Aperturas
							$tmp_block_width = $orPB_Class->cuenta == 6 ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPB_Class->cuenta >= 3 && $orPB_Class->cuenta <= 5 ? " orPBC_column" : "";
							echo $orPB_Class->abrir($tmp_block_width);
							if($orPB_Class->cuenta >= 3 || $orPB_Class->cuenta <= 5)
							{
								$tmp_block_width = "orPBC_100";
								echo $orPB_Class->abrir($tmp_block_width);
								if($orPB_Class->cuenta == 4 || $orPB_Class->cuenta == 5)
								{
									$tmp_block_width = "orPBC_50";
									echo $orPB_Class->abrir($tmp_block_width);
								}
							}
							// *** Cierres
							$orPromoBannerCierres = $orPB_Class->cuenta < 6 ? 1 : 2;

						break;
						case 3:	// 3º Banner
							// *** Aperturas
							$tmp_block_width = ($orPB_Class->cuenta == 3 || $orPB_Class->cuenta == 8 || $orPB_Class->cuenta == 7) ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPB_Class->cuenta == 6 ? " orPBC_column" : "";
							echo $orPB_Class->abrir($tmp_block_width);
							if($orPB_Class->cuenta == 8 || $orPB_Class->cuenta == 6)
							{
								if($orPB_Class->cuenta == 6)
								{
									$tmp_block_width = "orPBC_100";
									echo $orPB_Class->abrir($tmp_block_width);
								}
								$tmp_block_width = "orPBC_50";
								echo $orPB_Class->abrir($tmp_block_width);
							}

							// *** Cierres
							$orPromoBannerCierres = ($orPB_Class->cuenta >=3 && $orPB_Class->cuenta <=5) || $orPB_Class->cuenta == 7 ? 2 : 1;

						break;
						case 4:	// 4º Banner
							// *** Aperturas
							$tmp_block_width = $orPB_Class->cuenta == 4 || $orPB_Class->cuenta == 5 ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPB_Class->cuenta == 7 ? " orPBC_column" : "";
							echo $orPB_Class->abrir($tmp_block_width);
							if($orPB_Class->cuenta == 7 || $orPB_Class->cuenta == 5)
							{
								if($orPB_Class->cuenta == 7)
								{
									$tmp_block_width = "orPBC_100";
									echo $orPB_Class->abrir($tmp_block_width);
								}
								$tmp_block_width = "orPBC_50";
								echo $orPB_Class->abrir($tmp_block_width);
							}

							// *** Cierres
							$orPromoBannerCierres = ($orPB_Class->cuenta == 4 || $orPB_Class->cuenta == 6) ? 2 : 1;
							$orPromoBannerCierres = $orPB_Class->cuenta == 8 ? 3 : $orPromoBannerCierres;
						break;
						case 5:	// 5º Banner
							// *** Aperturas
							$tmp_block_width = $orPB_Class->cuenta == 6 ? "orPBC_100" : "orPBC_50";
							$tmp_block_width .= $orPB_Class->cuenta == 8 ? " orPBC_column" : "";
							echo $orPB_Class->abrir($tmp_block_width);

							if($orPB_Class->cuenta == 6 || $orPB_Class->cuenta == 8)
							{
								if($orPB_Class->cuenta == 8)
								{
									$tmp_block_width = "orPBC_100";
									echo $orPB_Class->abrir($tmp_block_width);
								}
								$tmp_block_width = "orPBC_50";
								echo $orPB_Class->abrir($tmp_block_width);
							}
							// *** Cierres
							$orPromoBannerCierres = $orPB_Class->cuenta == 7 ? 2 : 1;
							$orPromoBannerCierres = $orPB_Class->cuenta == 5 ? 3 : $orPromoBannerCierres;
						break;

						case 6:	// 6º Banner
							// *** Aperturas
							$tmp_block_width = $orPB_Class->cuenta == 7 ? "orPBC_100" : "orPBC_50";
							echo $orPB_Class->abrir($tmp_block_width);

							if( $orPB_Class->cuenta == 7)
							{
								$tmp_block_width = "orPBC_50";
								echo $orPB_Class->abrir($tmp_block_width);
							}
							// *** Cierres
							$orPromoBannerCierres = $orPB_Class->cuenta == 8 ? 2 : 1;
							$orPromoBannerCierres = $orPB_Class->cuenta == 6 ? 3 : $orPromoBannerCierres;
						break;
						

						case 7:	// 8º Banner
							// *** Aperturas
							$tmp_block_width = $orPB_Class->cuenta == 8 ? "orPBC_100" : "orPBC_50";
							echo $orPB_Class->abrir($tmp_block_width);

							if( $orPB_Class->cuenta == 8)
							{
								$tmp_block_width = "orPBC_50";
								echo $orPB_Class->abrir($tmp_block_width);
							}
							// *** Cierres
							$orPromoBannerCierres = $orPB_Class->cuenta == 7 ? 3 : 1;
						break;
						
						case 7:	// 8º Banner
							// *** Aperturas
							$tmp_block_width = "orPBC_50";
							echo $orPB_Class->abrir($tmp_block_width);

							// *** Cierres
							$orPromoBannerCierres = 3;
						break;
					}

					echo $orPB_Class->contenido($module->id.'_'.$tmp_banner, $tmp_arrayData['content']);
					echo $orPB_Class->cierres($orPromoBannerCierres);
					$orPromoBannerCount++;	// Añadimos Banner al contador
				}
			}
		}		
		
		echo '</div>';
	} ?>
</div>
