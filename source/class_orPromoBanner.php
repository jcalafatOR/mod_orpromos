<?php
class orPromoBanner
{
    public $now; 
    public $lista;
    public $cuenta;
    public $blockCss;
    public function __construct($params, $moduleclass_sfx)
    {
        $this->now = date("Y-m-d H:i:s");
        $this->lista = array();
        $this->cuenta = 0;
        $this->blockCss = "";
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
    public function contenido($nombre, $content) {return '<div id="or_promoBanner_'.$nombre.'" class="or_promoBannerItem">'.$content.'</div>';	}
}
?>