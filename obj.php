<?php
class cao
{
    // 不写修饰符就是默认公共

    // 公共修饰符
    // public $name = '曹鑫';
    // 私有修饰符 
    // private $age = 18;
    var $name;
    var $age;



    function __construct($par1, $par2)
    {
        $this->name = $par1;
        $this->age = $par2;
    }


    public function say()
    {
        echo '姓名:' . $this->name . '<br/>' . '年龄:' . $this->age . '<br/>';
    }

    // function __destruct()
    // {
    //     print "销毁 " . $this->name . "\n";
    // }
}

$a = new cao('cao', '11');
$a->fir = 1;

$a->say();
echo $a->fir;

// 继承
class aa extends cao
{
    var $sex = 1;
    function say1()
    {
        echo $this->sex;
        parent::say();
    }
}
$bb = new aa('aa', 'bb');

$bb->say();
$bb->say1();

class abc extends aa
{
    var $sex = 'ming';
    function say1()
    {
        echo $this->sex;
    }
}
$abc = new abc('ming', '12');
$abc->say1();


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
class qqq
{
    var $name = 1;
}

class par
{
    var $name = '父亲';
}

trait Drive
{
    function saya()
    {
        echo 'saya';
    }
}
class chi extends par
{
    use Drive;
    function npar()
    {
        $tom = new parent();
        echo $tom->name;
    }
}
$ren = new chi();
$ren->npar();
$ren->saya();

trait Trait1
{
    public function hello()
    {
        echo "Trait1::hello\n";
    }
    public function hi()
    {
        echo "Trait1::hi\n";
    }
}
trait Trait2
{
    public function hello()
    {
        echo "Trait2::hello\n";
    }
    public function hi()
    {
        echo "Trait2::hi\n";
    }
}
class Class1
{
    use Trait1, Trait2 {
        Trait2::hello insteadof Trait1;
        Trait1::hi insteadof Trait2;
        Trait1::hello as i;
    }
    static function i()
    {
        echo '我被改变成静态';
    }
}

$Obj1 = new Class1();
$Obj1->hello();
$Obj1->hi();
// $Obj1->i();
Class1::i();
// final class db{

// }

// class dba extends db {

// }
interface stu
{
    public function  name();
}
class say implements stu
{
    
}
