# 一常用经典算法功能

> ### 1 getPrivateAttrOne 通过转成数组的方式获取对象的私有属性
> ### 2 getPrivateAttr 通过匿名函数来获取对象的私有字段的值
> ### 3 generateTree 通过引用进行无限分类
> ### 4 setPrivateAttr 设置对象私有属性值

# 二.参数说明
> 方法调用均为静态

Com\Xjke\Tools\T::getPrivateAttrOne(object $obj, string $name)

```php
    /**
     * 获取对象的私有属性值
     * @param object $obj object 对象
     * @param string $name string 私有字段的名称
     * @return mixed 返回的是字段的值
     */
```

Com\Xjke\Tools\T::getPrivateAttr(object $obj, string $name)

```php
    /**
     * 通过匿名函数来获取对象的私有字段的值
     * @param $obj object 对象
     * @param $name string 字段的名称
     * @return mixed 返回的是字段的值
     */
```
Com\Xjke\Tools\T::generateTree($data, $id = 'id', $pid = 'pid', $children = 'children')
```php
    /**
     * 通过引用进行无限分类
     * @param array|mixed $data 平面带有父ID的数据
     * @param string $id id名称
     * @param string $pid 父字段的名称
     * @param string $children 子属性名称
     * @return array 返回树状结构的值
     */
```

Com\Xjke\Tools\T::setPrivateAttr(object &$obj, array $arr)
```php
    /**
     * 设置对象的私有属性值
     * @param $obj object 必须是对象
     * @param $arr array 数组 必须是数组 ['属性名'=>'属性值']
     * @return bool
     */
```