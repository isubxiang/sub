<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolBennym
// +----------------------------------------------------------------------

/**
 * 行为扩展 URL资源类型检测
 */
class CheckUrlExtBehavior extends Behavior {

    /**
     * 检测URL地址中资源扩展
     * @access public
     * @return void
     */
    public function run(&$params) {
        // 获取资源类型
        if(!empty($_SERVER['PATH_INFO'])) {
            $part =  pathinfo($_SERVER['PATH_INFO']);
            if(isset($part['extension'])) { // 判断扩展名
                define('__EXT__', strtolower($part['extension']));
                $_SERVER['PATH_INFO']   =   preg_replace('/.'.__EXT__.'$/i','',$_SERVER['PATH_INFO']);
            }
        }
    }

}