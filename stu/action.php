<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>学生信息管理</title>
    </head>
    <body>
        <center>
            <?php 
                include("./menu.php"); //导入公共导航栏 
                //执行学生信息的删除，添加和修改操作
                //1.导入配置文件
                require("./config.php");
                //2.连接数据库，并判断
                $link = @mysql_connect(HOST,USER,PASS)or die('数据库连接失败！');
                //3.选择数据库，设置字符集
                mysql_select_db(DBNAME,$link);
                mysql_set_charset("utf8");
                //4.根据参数a的值执行对应的操作
                switch($_GET['a']){
                    case "insert": //执行添加
                        //获取要添加的信息
                        $name= $_POST['name'];
                        $sex= $_POST['sex'];
                        $age= $_POST['age'];
                        $num= $_POST['num'];
                        //拼装添加sql语句
                        $sql = "insert into new values(null,'{$name}','{$sex}','{$age}','{$num}','2014-8-26 19:03:32')";
                        //发送并执行
                        mysql_query($sql,$link);
                        //根据自增id来判断是否成功
                        if(mysql_insert_id($link)>0){
                            echo "添加成功！";
                        }else{
                            echo "添加失败！";
                        }
                        break;
                    case "update": //执行修改
                        //获取要修改的信息
                        $id= $_POST['id'];
                        $name= $_POST['name'];
                        $sex= $_POST['sex'];
                        $age= $_POST['age'];
                        $num= $_POST['num'];
                        //拼装修改sql语句
                        $sql = "update new set name='{$name}',sex='{$sex}',age='{$age}',num='{$num}' where id={$id}";
                        //发送并执行
                        mysql_query($sql,$link);
                        //根据影响行数来判断是否成功
                        if(mysql_affected_rows($link)>0){
                            echo "修改成功！";
                        }else{
                            echo "修改失败！";
                        }
                        break;
                    case "del": //执行删除
                        //定义删除sql语句‘
                        $sql = "delete from new where id=".$_GET['id'];
                        //执行sql语句
                        mysql_query($sql,$link);
                        //跳回浏览页
                        header("Location:index.php");
                        break;
                }
                //5.关闭数据库
                mysql_close($link);
            ?>
        <center>
    </body>
</html>