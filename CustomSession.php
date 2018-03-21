<?php
        define('DB_HOST','localhost');
        define('DB_USER','***');
        define('DB_PWD','****');
        define('DB_NAME','***');
    class CustomSession implements SessionHandlerInterface{
        private $link;//服务器链接
        private $lifetime;//存活时间
        public function open($savePath,$session_name){
          
            $this->lifetime = get_cfg_var('session.gc_maxlifetime');
            $this->link = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME) or die('connect fail');
            mysqli_set_charset($this->link,'utf8');
            
        }
        public function close(){
            mysqli_close($this->link);
            return true;
        }
        /**
         * 读取sessionid
         * @param [string] $session_id session id
         */
        public function read($session_id){
            $session_id = mysqli_escape_string($this->link,$session_id);
            $sql = "SELECT * FROM sessionId_info WHERE session_id='{$session_id}' AND session_expires> ".time();
            $result = mysqli_query($this->link,$sql);
            if(mysqli_num_rows($result)==1){
               return mysqli_fetch_assoc($result)['session_data'];
            }else{
                return '';
            }
        }
        /**
         * 写入sessionid
         * @param [string] $session_id session id
         * @param [mixed] $session_data session data
         */
        public function write($session_id,$session_data){
            $newExp = time()+$this->lifetime;
            $session_id = mysqli_escape_string($this->link,$session_id);
            //首先查询是否在指定的session_id，如果存在相当于更新数据，否则是第一次写入数据
            $sql = "SELECT * FROM sessionId_info WHERE session_id='{$session_id}' ";
            $result = mysqli_query($this->link,$sql);
            if(mysqli_num_rows($result)==1){
                $sql = "UPDATE sessionId_info SET session_expires='{$newExp}',session_data='{$session_data}' WHERE session_id='{$session_id}' ";
            }else{
                $sql = "INSERT sessionId_info VALUES('{$session_id}','{$session_data}','{$newExp}')";
            }
            mysqli_query($this->link,$sql);
            return mysqli_affected_rows($this->link)==1;

        }
        /**
         * 销毁sessionid
         * @param [string] $session_id session id
         */
        public function destroy($session_id){
            $session_id = mysqli_escape_string($this->link,$session_id);
            $sql = "DELETE FROM sessionId_info WHERE session_id ='{$session_id}'";
            // echo $sql;
            // print_r($this->link) ;
            mysqli_query($this->link,$sql);
            return mysqli_affected_rows($this->link)==1;
        }
        public function gc($maxlifetime){
            $sql = "DELETE FROM sessionId_info WHERE session_expires<".time();
            mysqli_query($this->link,$sql);
            if(mysqli_affected_rows($this->link)>0){
                return true;
            }else{
                return false;
            }
        }
    }
    /**
    * 调用CustomSession
    * $CustomSession = new CustomSession;
    * ini_set('session.save_handler','user');
    * session_set_save_handler($CustomSession,true);
    * session_start();
    * $_SESSION['name'] = 'king';
    * $_SESSION['age'] = '1000';
    * $_SESSION['name'] = 'ddd';
    * print_r(session_id());
    * session_destroy();
    */
?>
