<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>学生信息管理</title>
    </head>
    <body>
        <center>
            <?php include("./menu.php"); //导入公共导航栏 ?>
            <h3>浏览学生信息</h3>
            <table width="700" border="1">
                <tr>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>年龄</th>
                    <th>学号</th>
                    <th>操作</th>
                </tr>
                <?php
                    //从数据库中获取学生信息并输出
                    //1.导入配置文件
                    require("./config.php");
                    //2.获取数据库连接，并判断
                    $link = @mysql_connect(HOST,USER,PASS)or die("数据库连接失败！");
                    //3.选择数据库，设置字符集
                    mysql_select_db(DBNAME,$link);
                    mysql_set_charset("utf8");
                    //4.定义查询sql语句，并发送执行
                    $sql = "select * from new";
                    $result = mysql_query($sql,$link);
                    //5.解析结果集，并输出
                    while($row = mysql_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['sex']}</td>";
                        echo "<td>{$row['age']}</td>";
                        echo "<td>{$row['num']}</td>";
                        echo "<td>
                                <a href='action.php?a=del&id={$row['id']}'>删除</a>
                                <a href='edit.php?id={$row['id']}'>修改</a></td>";
                        echo "</tr>";
                    }
                    
                    //6.释放结果集，关闭数据库
                    mysql_free_result($result);
                    mysql_close($link);
                ?>
            </table>
        <center>
    </body>
</html>