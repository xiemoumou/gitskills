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
                //获取要修改的学生信息
                //1.导入配置文件
                require("./config.php");
                //2.获取数据库连接，判断是否成功
                $link = @mysql_connect(HOST,USER,PASS)or die("数据库连接失败！");
                //3.选择数据库，设置编码
                mysql_select_db(DBNAME,$link);
                mysql_set_charset("utf8");
                //4.定义查询sql语句，并执行
                $sql = "select * from new  where id=".$_GET['id'];
                $result = mysql_query($sql,$link);
                //5.解析查询结果，并获取
                if($result && mysql_num_rows($result)>0){
                    $stu = mysql_fetch_assoc($result); //获取被修改的学生信息
                }
                //6.释放结果集，关闭数据库
                mysql_free_result($result);
                mysql_close($link);
            ?>
            <h3>修改学生信息</h3>
            <form action="action.php?a=update" method="post">
            <input type="hidden" name="id" value="<?php echo $stu['id']; ?>"/> 
            <table width="260" border="0">
                <tr>
                    <td>姓名:</td>
                    <td><input type="text" name="name" value="<?php echo $stu['name']; ?>"/></td>
                </tr>
                <tr>
                    <td>性别:</td>
                    <td><input type="radio" name="sex" value="m" <?php echo ($stu['sex']=='m')?"checked":""; ?>/>男
                        <input type="radio" name="sex" value="w" <?php echo ($stu['sex']=='w')?"checked":""; ?>/>女</td>
                </tr>
                <tr>
                    <td>年龄:</td>
                    <td><input type="text" name="age" value="<?php echo $stu['age']; ?>"/></td>
                </tr>
                <tr>
                    <td>学号:</td>
                    <td><input type="text" name="num"  value="<?php echo $stu['num']; ?>"/></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改"/>&nbsp;&nbsp;&nbsp;
                        <input type="reset" value="重置"/>
                    </td>
                </tr>
            </table>
            </form>
        <center>
    </body>
</html>