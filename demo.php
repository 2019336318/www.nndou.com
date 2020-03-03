<?php

class par
{
    protected $name = 'ming';
    function say()
    {
        echo '我的名字是:' . "$this->name" . "<br/>";
    }
}
class chi extends par
{
}

$ming = new chi();
$ming->say();

class par1
{
    // protected $name = 'ming';
    function say()
    {
        echo '我的名字是:' . "$this->name" . "<br/>";
    }
}
class chi1 extends par1
{
    protected $name = 'ming';

    function aa()
    {
        parent::say();
    }
}
$ming1 = new chi1();
$ming1->aa();

trait par2
{
    protected $name = '爸爸';
}

trait par3
{
    protected $age = '19';
}

class chi2
{
    use par2, par3;

    function say()
    {
        echo '我的名字是:' . "$this->name" . "$this->age<br/>";
    }
}

$ming1 = new chi2();
$ming1->say();
echo "<hr/>";


abstract class chou
{
    abstract function chou1();
}

class jc extends chou
{
    var $name = '抽象' . "<br/>";
    function chou1()
    {
        echo $this->name;
    }
}
$ming1 = new jc();
$ming1->chou1();

class ba
{
    protected $name = '俺是爸爸' . "<br/>";
    final function fa()
    {
        echo "我不重写" . "<br/>";
    }
}

class ch extends ba
{
    var $name = '儿子';
    // function fa(){
    //     echo "$this->name";
    // }
}

$mi = new ch();
$mi->fa();

echo $mi->name;
// Cannot override final method ba::fa() in D:\phpstudy_pro\WWW\www.nndou.com\demo.php on line 83


interface jiekou
{
    public function i1($name, $age);
    public function i2($h, $w);
}

class usei implements jiekou
{

    public function i1($name, $age)
    {
        echo '<br/>', $name, $age, '<br/>';
    }
    public function i2($h, $w)
    {
        echo '<br/>', $h, $w, '<br/>';
    }
}
$r = new usei();
$r->i1('接口', '1');
$r->i2('接口', '2');

interface stu
{
    public function  name();
}
class say implements stu
{
    function name()
    {
        echo "我是" . __FUNCTION__;
    }
}
$a = new say;
$a->name();

trait D
{
    function setname()
    {
        echo __FUNCTION__;
    }
}

interface A
{
    function test1();
}
interface B
{
    function test2();
}
echo "<hr/>";
class C implements A, B
{
    use D;
    public function test1()
    {
        echo "实现" . __FUNCTION__;
    }
    public function test2()
    {
        echo "实现" . __FUNCTION__;
    }
}
$c = new C();
$c->test1();
$c->test2();
$c->setname();


// autoload

// class auto1{

// }
// class auto2{
    
// }
// class auto3{
    
// }