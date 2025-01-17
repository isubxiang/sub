<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolBennym
// +----------------------------------------------------------------------

/**
 * ThinkPHP AMF模式Action控制器基类
 */
abstract class Action {

    /**
     * 魔术方法 有不存在的操作的时候执行
     * @access public
     * @param string $method 方法名
     * @param array $parms 参数
     * @return mixed
     */
    public function __call($method,$parms) {
        // 如果定义了_empty操作 则调用
        if(method_exists($this,'_empty')) {
            $this->_empty($method,$parms);
        }
    }

}//类定义结束
?>