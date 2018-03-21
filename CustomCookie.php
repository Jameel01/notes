<?php
/**
 * cookie的设置、读取、更新、删除
 */
    class CustomCookie{
        static private $_instance=null;
        private $expire=0;
        private $path='';
        private $domain='';
        private $secure=false;
        private $httponly=false;
        /**
         * 构造函数完成cookie参数初始化工作
         * @param [array] $option cookie相关选项
         */
        private function _construct(array $options=[]){
            $this->setOptions($options);
        }
        /**
         * 设置cookie相关选项
         * @param [array]   $option cookie相关选项
         * @return [object]     对象实例
         */
        private function setOptions(array $options=[]){
            if(isset($options['expire'])){
                $this->expire=(int)$options['expire'];
            }
            if(isset($options['path'])){
                $this->path=$options['path'];
            }
            if(isset($options['domain'])){
                $this->domain=$options['domain'];
            }
            if(isset($options['secure'])){
                $this->secure=(bool)$options['secure'];
            }
            if(isset($options['httponly'])){
                $this->httponly=(bool)$options['httponly'];
            }
            return $this;
        }
        /**
         * 单例模式
         * @param [array] $option cookie相关选项
         * @return [object]         对象实例
         */
        public static function getInstance(array $options=[]){
            if(is_null(self::$_instance)){
                $class=__CLASS__;
                self::$_instance=new $class($options);
            }
            return self::$_instance;
        }
        /**
         * 设置cookie
         * @param [string] $name cookie的名称   
         * @param [mixed] $value cookie的值   
         * @param [array] $option cookie的相关选项   
         */
        public function set($name,$value,array $options=[]){
            if(is_array($options)&&count($options)>0){
                $this->setOptions($options);
            }
            if(is_array($value) || is_object($value)){
                $value=json_encode($value,JSON_FORCE_OBJECT);
            }
            setcookie($name,$value,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
        }
        /**
         * @param [string] $name    cookie名字
         * @return [mixed]          返回null/对象/标量
         */
        public function get(string $name){
            if(isset($_COOKIE[$name])){
               return substr($_COOKIE[$name],0,1)=='{'?json_decode($_COOKIE[$name]):$_COOKIE[$name];
            }else{
                return null;
            }
        }
        /**
         * 删除指定cookie
         * @param [string] $name    cookie名字
         * @param [array] $option    cookie相关选项
         */
        public function delete(string $name,array $options=[]){
            if(is_array($options) && count($options)>0){
                $this->setOptions($options);
            }
            if(isset($_COOKIE[$name])){
                setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
                unset($_COOKIE[$name]);
            }
        }
        /**
         * 删除所有cookie
         */
        public function deleteAll(array $options=[]){
             if(is_array($options) && count($options)>0){
                $this->setOptions($options);
            }
            if(!empty($_COOKIE)){
                foreach($_COOKIE as $name=>$value){
                    setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
                    unset($_COOKIE[$name]);
                }
            }
        }
    }
    $cookie=CustomCookie::getInstance();

//    $cookie->set('aa',55);
//    $cookie->set('aa',55,['expire'=>time()+3600]);
//    $cookie->get('aa');
//    $cookie->delete('aa');

?>