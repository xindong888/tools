<?php


namespace Com\Xjke\Tools;

use Exception;
use ReflectionClass;
use ReflectionException;

/**
 * Class T 常用的功能方法
 * @package Com\Xjke\Tool
 */
class T
{

    /**
     * 获取对象的私有属性值
     * @param object $obj object 对象
     * @param string $name string 私有字段的名称
     * @return mixed 返回的是字段的值
     */
    public static function getPrivateAttrOne(object $obj, string $name)
    {
        //把对象转换成对象
        $array = (array)$obj;
        //获取私有属性的前缀
        $prefix = chr(0) . '*' . chr(0);
        //返回值
        return $array[$prefix . $name];
    }

    /**
     * 通过匿名函数来获取对象的私有字段的值
     * @param $obj object 对象
     * @param $name string 字段的名称
     * @return mixed 返回的是字段的值
     */
    public static function getPrivateAttr(object $obj, string $name)
    {
        //匿名函数
        $closure = function (string $name) {
            return $this->$name;
        };
        return $closure->call($obj, $name);
    }

    /**
     * 通过引用进行无限分类
     * @param array|mixed $data 平面带有父ID的数据
     * @param string $id id名称
     * @param string $pid 父字段的名称
     * @param string $children 子属性名称
     * @return array 返回树状结构的值
     */
    public static function generateTree($data, $id = 'id', $pid = 'pid', $children = 'children'): array
    {
        //新建空数组
        $items = array();
        foreach ($data as $v) {
            //给每一项添加子属性
            $v[$children] = [];
            //把自己的ID当成索引,压缩到$items数组里
            $items[$v[$id]] = $v;
        }
        $tree = array();
        //循环$items
        foreach ($items as $k => &$item) {
            //在$items里找寻父项,如果存在则把自己在内存的地址添加给父项
            if (isset($items[$item[$pid]])) {
                $items[$item[$pid]][$children][] = &$item;
            } else {
                //如果没有找到表示顶级,直接把自己在内存的地址压缩到$tree数组里
                $tree[] = &$item;
            }
        }
        return $tree;
    }

    /**
     * 设置对象的私有属性值
     * @param $obj object 必须是对象
     * @param $arr array 数组 必须是数组 ['属性名'=>'属性值']
     * @return bool
     */
    public static function setPrivateAttr(object &$obj, array $arr): bool
    {
        $cls = get_class($obj);//获取对象的类
        try {
            $reflectCls = new ReflectionClass ($cls);//建立对象的反射
            foreach ($arr as $key => $val) {
                $pro = $reflectCls->getProperty($key);//获取属性
                if ($pro && ($pro->isPrivate() || $pro->isProtected())) {
                    $pro->setAccessible(true);//设置允许设置私有值
                    $pro->setValue($obj, $val);
                } else {
                    $obj->$key = $val;
                }
            }
        } catch (ReflectionException $e) {
            return false;
        }
        return true;
    }
}