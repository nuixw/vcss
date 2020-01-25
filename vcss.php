<?php
/**
 *
 * @package    Vcss v1
 * @author     nuixw.fr
 * @copyright  © 2020
 * https://github.com/nuixw/vcss
 *
*/

Class Vcss{

    public function __construct($file){

        if(file_exists($file)){

            $this->var = NULL;
            $this->time = time();
            $this->file = $file;
            $this->cache = 1;
            $this->name = $this->getName();
            $this->css = $this->getContent($file);
            $this->directory = $this->getDirectory();
            $this->css = $this->Import();
            $this->var = $this->ReplaceVar();
            $this->compress = $this->Compress();

            return $this; 

        }else{

            echo 'Css "'. $file .'" not found';
            die();

        }

    }

    private function getContent($file){

        return file_get_contents($file);

    }

    private function getName(){

        return basename($this->file, ".css");

    }

    private function getDirectory(){

        return dirname($this->file);

    }

    public function Cache($bool){

        if($bool == 1){
            $this->cache = 1;
        }else{
            $this->cache = 0;
        }

    }

    private function Compress(){

        $css = preg_replace('/\/\*((?!\*\/).)*\*\//','', $this->css);
        $css = preg_replace('/\s{2,}/',' ', $css);
        $css = preg_replace('/\s*([:;{}])\s*/','$1', $css);
        $css = preg_replace('/;}/','}', $css);

        return $css;

    }

    private function Import(){

        $reg = "/@import '(.*?)';/";
        $css = $this->css;

        preg_match_all($reg, $css, $import, PREG_PATTERN_ORDER);

        foreach($import[1] as $imp){

            if(file_exists($imp)){

                $imp = $this->getContent($imp);

                if(strpos($css, 'var.json') !== false){

                    $this->var = json_decode($imp);

                }else{

                    $css = $imp.$css;

                }

                $css = preg_replace($reg, '', $css);

            }

        }

        return $css;

    }

    private function ReplaceVar(){

        $var = $this->var;

        if($var != NULL){

            $var = json_decode(json_encode($var), true);
            $find = array_keys($var);
            $replace = array_values($var);
            $css = str_ireplace($find, $replace, $this->css);

        }

        $this->css = $css;

    }

    public function Create(){

        $name = $this->name.'.vcss.css';
        $name = $this->directory.'/'.$name;

        if(file_exists($name)){

            if(filemtime($name) != filemtime($this->file)){

                file_put_contents($name, $this->compress);

                touch($name, $this->time);
                touch($this->file, $this->time);

            }

        }else{
            
            file_put_contents($name, $this->compress);

        }

        if($this->cache == 0){

            file_put_contents($name, $this->compress);

        }

        echo $name;

    }

}