<?php
namespace PAL;

class PAL {
    private static int $counter = 0;

    private string $id = '';
    private string $tag = 'div';
    private string $selector = '';
    private array $styles = [];
    private array $states = [];
    private array $animations = [];
    private array $customKeyframes = [];
    private array $pseudoElements = [];
    private string $text = '';

    private array $bg = ['color'=>null,'image'=>null,'size'=>null,'position'=>null,'repeat'=>null];

    private array $predefinedAnimations = [
        'bounce' => "0%,20%,50%,80%,100%{transform:translateY(0);}40%{transform:translateY(-20px);}60%{transform:translateY(-10px);}",
        'shake'  => "0%,100%{transform:translateX(0);}10%,30%,50%,70%,90%{transform:translateX(-5px);}20%,40%,60%,80%{transform:translateX(5px);}",
        'pulse'  => "0%{transform:scale(1);}50%{transform:scale(1.1);}100%{transform:scale(1);}",
        'fade'   => "0%{opacity:1;}50%{opacity:0.5;}100%{opacity:1;}",
        'spin'   => "0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}",
        'float'  => "0%{transform:translateY(0);}50%{transform:translateY(-10px);}100%{transform:translateY(0);}"
    ];

    // ---------- CREATE ----------
    public static function create(string $tag='div'): self {
        self::$counter++;
        $obj = new self();
        $obj->id = "pal-{$tag}-".self::$counter;
        $obj->tag = $tag;
        return $obj;
    }

    public function text(string $text): self { $this->text = $text; return $this; }

    // ---------- SELECT ----------
    public static function select(string $selector): self {
        $obj = new self();
        $obj->selector = $selector;
        return $obj;
    }

    // ---------- ANIMATE ----------
    public function animate(string $name,string $duration='1s',string $iteration='infinite',string $state='hover',string $delay='0s'): self {
        $this->animations[] = compact('name','duration','iteration','state','delay');
        return $this;
    }

    public function keyframes(string $name,array $frames): self {
        $this->customKeyframes[$name]=$frames;
        return $this;
    }

    // ---------- BACKGROUND ----------
    public function background(): self { return $this; }
    public function color(string $color): self { $this->bg['color']=$color; return $this; }
    public function image(string $url): self { $this->bg['image']="url('$url')"; return $this; }
    public function size(string $size): self { $this->bg['size']=$size; return $this; }
    public function position(string $pos): self { $this->bg['position']=$pos; return $this; }
    public function repeat(bool $repeat=true): self { $this->bg['repeat']=$repeat?'repeat':'no-repeat'; return $this; }

    // ---------- TRANSFORM & STATES ----------
    public function transform(string $transform,string $state='hover'): self {
        $this->states[$state]['transform']=$transform;
        return $this;
    }

    public function transition(string $duration='0.3s',string $easing='ease',string $state='default'): self {
        $this->states[$state]['transition']="all $duration $easing";
        return $this;
    }

    public function pseudo(string $pseudo,array $styles): self {
        $this->pseudoElements[$pseudo]=$styles;
        return $this;
    }

    private function buildBackground(): void {
        $parts=[];
        if($this->bg['color']) $parts[]=$this->bg['color'];
        if($this->bg['image']) $parts[]=$this->bg['image'];
        if(!empty($parts)) $this->styles['background']=implode(' ',$parts);
        if($this->bg['size']) $this->styles['background-size']=$this->bg['size'];
        if($this->bg['position']) $this->styles['background-position']=$this->bg['position'];
        if($this->bg['repeat']) $this->styles['background-repeat']=$this->bg['repeat'];
    }

    private function buildCSS(): string {
        $this->buildBackground();
        $selector = $this->selector ?: "#{$this->id}";
        $main=''; foreach($this->styles as $k=>$v) $main.="$k:$v;";
        $css = "$selector { $main }";

        foreach(['hover','focus','active','default'] as $state){
            if(isset($this->states[$state])){
                $rules=''; foreach($this->states[$state] as $k=>$v) $rules.="$k:$v;";
                $s = $state=='default'?'':":$state";
                $css.="$selector$s { $rules }";
            }
        }

        foreach($this->animations as $anim){
            $state = $anim['state'];
            $rule = "animation: {$anim['name']} {$anim['duration']} {$anim['iteration']} {$anim['delay']};";
            $s = $state=='default'?'':":$state";
            $css.="$selector$s { $rule }";
        }

        foreach($this->pseudoElements as $pseudo=>$styles){
            $rules=''; foreach($styles as $k=>$v) $rules.="$k:$v;";
            $css.="$selector::$pseudo { $rules }";
        }

        $allKeyframes = $this->predefinedAnimations + $this->customKeyframes;
        foreach($allKeyframes as $name=>$frames){
            $css.="@keyframes $name {";
            if(is_array($frames)){
                foreach($frames as $percent=>$rule) $css.="$percent { $rule }";
            } else { $css.=$frames; }
            $css.="}";
        }

        return "<style>$css</style>";
    }

    public function render(): string {
        if($this->selector) return $this->buildCSS();
        return $this->buildCSS() . "<{$this->tag} id='{$this->id}'>{$this->text}</{$this->tag}>";
    }
}
