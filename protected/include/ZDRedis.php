<?php
/**
 * Redis 处理类
 * @date 2015-05-18
 */
class ZDRedis {
    private $redis;
    private $config;
    private $linkModel = 'ma';

    /**
     * @param string $host
     * @param int $post
     */
    public function __construct() {       
        $this -> config = $GLOBALS['redis'];
    }

    /**
     * 强制连接Redis服务模式
     * @param  $linkModel
     */
    private function setLinkModel($linkModel){
        //只操作从Redis或者只操作主Redis
        if ($linkModel) {
            $this -> linkModel = $linkModel;
        }

        $this -> getConn();

    }
    /**
     * HASH表类型 返回哈希表key中的所有域和值
     * @param string $tableName  表名字key
     */
    public function hgetAll($tableName, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->hgetall($tableName);
    }
    /**
     * 为Redis键设置过期时间
     * @param string $key  名字key
     * @param int $timeout  秒
     */
    public function setExpire($key,$timeout, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->expire($key, $timeOut);
    }
    /**
     * 数据自增
     * @param string $key KEY名称
     * @param string $num 增加的数
     */
    public function incrementBy($key, $num,$linkModel = false) {
        $this -> setLinkModel($linkModel);
        return $this->redis->incrby($key,$num);
    }
	/**
     * List类型 获取列表长度
     */
    public function llen($key, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->llen($key);
    }
    /**
    * 连接Redis服务
    * @param linkModel 连接Redis服务模式
    */
    private function getConn(){
        if (!is_array($this -> config)) {
            echo '<p color="red"> Redis连接参数配置不成功。</p>';
            exit();
        }
        $this -> redis = new Redis();
        $this -> redis -> connect($this -> config[$this -> linkModel]['host'], $this->config[$this -> linkModel]['port']);
        if($this->config[$this -> linkModel]['password']){
            $this->redis->auth($this->config[$this -> linkModel]['password']);
        }
        return $this -> redis;

    }

    /**
     * 设置值  构建一个字符串
     * @param string $key KEY名称
     * @param string $value  设置值
     * @param int $timeOut 时间  0表示无过期时间
     * @param string $linkModel 连接Redis服务模式
     */
    public function set($key, $value, $timeOut = 0, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        $retRes = $this->redis->set($key, $value);
        if ($timeOut > 0)
            $this->redis->expire('$key', $timeOut);
        return $retRes;
    }

    /*
     * 构建一个集合(无序集合)
     * @param string $key 集合Y名称
     * @param string|array $value  值
     * @param string $linkModel 连接Redis服务模式
     */
    public function sadd($key, $value, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->sadd($key,$value);
    }
    
    /*
     * 构建一个集合(有序集合)
     * @param string $key 集合名称
     * @param string|array $value  值
     * @param string $linkModel 连接Redis服务模式
     */
    public function zadd($key, $value, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->zadd($key,$value);
    }
    
    /**
     * 取集合对应元素
     * @param string $setName 集合名字
     */
    public function smembers($setName, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->smembers($setName);
    }

    /**
     * 构建一个列表(先进后出，类似栈)
     * @param sting $key KEY名称
     * @param string $value 值
     */
    public function lpush($key, $value, $linkModel = false){
        //echo "$key - $value \n";
        $this -> setLinkModel($linkModel);
        return $this->redis->LPUSH($key,$value);
    }
    
    /**
     * 通过key返回和移除列表的第一个元素
     * @param string $key KEY名称
     */
    public function lpop($key, $linkModel = false){
        $this -> setLinkModel($linkModel);
        $result = $this->redis->lpop($key);
        return $result;
    }
     /**
     * 构建一个列表(先进先出，类似队列)
     * @param sting $key KEY名称
     * @param string $value 值
     */
    public function rpush($key, $value, $linkModel = false){
        //echo "$key - $value \n";
        $this -> setLinkModel($linkModel);
        return $this->redis->rpush($key,$value);
    }
    
    /**
     * 通过key返回和移除列表的最后一个元素
     * @param string $key KEY名称
     */
    public function rpop($key, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        $result = $this->redis->rpop($key);
        return $result;
    }
    
    /**
     * 获取所有列表数据（从头到尾取）
     * @param sting $key KEY名称
     * @param int $head  开始
     * @param int $tail     结束
     */
    public function lranges($key, $head, $tail, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->lrange($key,$head,$tail);
    }
    
    /**
     * HASH表类型 设置表数据
     * @param string $tableName  表名字key
     * @param string $key            字段名字
     * @param sting $value          值
     */
    public function hset($tableName, $field, $value, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->hset($tableName,$field,$value);
    }

    /**
     * HASH表类型 同时设置多个值
     * @param string $tableName  表名字key
     * @param array  $keyArray   KEY->名称
     */
    public function hsets($tableName, $keyArray, $linkModel = false){
        $this -> setLinkModel($linkModel);
        if (is_array($keyArray)) {
            $retRes = $this->redis->hmset($tableName, $keyArray);
            return $retRes;
        } else {
            return "Call  " . __FUNCTION__ . " method  parameter  Error !";
        }
    }

    /**
     * HASH表类型 获取某字段内容
     * @param string $tableName  表名字key
     * @param string  $field     字段名
     */
    public function hget($tableName, $field, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->hget($tableName,$field);
    }
    

    /**
     * HASH表类型 获取表字段长度
     * @param string $tableName  表名字key
     */
    public function hlen($tableName, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->hlen($tableName);
    }

    /**
     * 同时设置多个值
     * @param array $keyArray KEY名称
     * @param string|array $value 获取得到的数据
     * @param int $timeOut 时间
     */
    public function sets($keyArray, $timeout, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        if (is_array($keyArray)) {
            $retRes = $this->redis->mset($keyArray);
            if ($timeout > 0) {
                foreach ($keyArray as $key => $value) {
                    $this->redis->expire($key, $timeout);
                }
            }
            return $retRes;
        } else {
            return "Call  " . __FUNCTION__ . " method  parameter  Error !";
        }
    }

    /**
     * 通过key获取数据
     * @param string $key KEY名称
     */
    public function get($key, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        $result = $this->redis->get($key);
        return $result;
    }
    
    /**
     * 同时获取多个值
     * @param ayyay $keyArray 获key数值
     */
    public function gets($keyArray, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        if (is_array($keyArray)) {
            return $this->redis->mget($keyArray);
        } else {
            return "Call  " . __FUNCTION__ . " method  parameter  Error !";
        }
    }

    /**
     * 获取所有key名，不是值
     */
    public function keyAll($linkModel = false) {
        $this -> setLinkModel($linkModel);
        return $this->redis->keys('*');
    }

    /**
     * 删除一条数据key
     * @param string $key 删除KEY的名称
     */
    public function del($key, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        return $this->redis->delete($key);
    }

    /**
     * 同时删除多个key数据
     * @param array $keyArray KEY集合
     */
    public function dels($keyArray, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        if (is_array($keyArray)) {
            return $this->redis->del($keyArray);
        } else {
            return "Call  " . __FUNCTION__ . " method  parameter  Error !";
        }
    }
    
    /**
     * 数据自增
     * @param string $key KEY名称
     */
    public function increment($key, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        return $this->redis->incr($key);
    }
    
    /**
     * 数据自减
     * @param string $key KEY名称
     */
    public function decrement($key, $linkModel = false) {
        $this -> setLinkModel($linkModel);
        return $this->redis->decr($key);
    }
   
    
    /**
     * 判断key是否存在
     * @param string $key KEY名称
     */
    public function isExists($key, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->exists($key);
    }

    /**
     * 重命名- 当且仅当newkey不存在时，将key改为newkey ，当newkey存在时候会报错哦RENAME   
     *  和 rename不一样，它是直接更新（存在的值也会直接更新）
     * @param string $Key KEY名称
     * @param string $newKey 新key名称
     */
    public function updateName($key, $newKey, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->RENAMENX($key,$newKey);
    }
    
   /**
    * 获取KEY存储的值类型
    * none(key不存在) int(0)  string(字符串) int(1)   list(列表) int(3)  set(集合) int(2)   zset(有序集) int(4)    hash(哈希表) int(5)
    * @param string $key KEY名称
    */
    public function dataType($key, $linkModel = false){
        $this -> setLinkModel($linkModel);
        return $this->redis->type($key);
    }

   
    /**
     * 清空数据
     */
    public function flushAll($linkModel = false) {
        $this -> setLinkModel($linkModel);
        return $this->redis->flushAll();
    }


     
    /**
     * 返回redis对象
     * redis有非常多的操作方法，我们只封装了一部分
     * 拿着这个对象就可以直接调用redis自身方法
     * eg:$redis->redisOtherMethods()->keys('*a*')   keys方法没封
     */
    public function redisOtherMethods() {
        return $this->redis;
    }

}