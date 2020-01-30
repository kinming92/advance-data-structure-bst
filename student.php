<?php 
    include "database.php";
    session_start();
    if(!isset($_SESSION["AID"])){
        echo "<script> window.open('index.php?mes=Access Denied', '_self'); </script>";

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php include"navbar.php";?>
        <div id="section">
            <?php include "sidebar.php"; ?>
            <div class="content">
                <h3 class="text">Welcome <?php echo $_SESSION["ANAME"]; ?> </h3><br><hr>
                <h3>View Student Details</h3><br>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="lbox1">
                        <label>Class</label><br>
                        <select name="cla" class="input3" required>
                            <?php
                                $sl = "select DISTINCT(CNAME) from class";
                                $r = $db->query($sl);
                                if($r->num_rows>0){
                                    echo "<option value=''>Select</option>";
                                    while($ro=$r->fetch_assoc()){
                                        echo "<option value='{$ro["CNAME"]}'>{$ro["CNAME"]}</option>";
                                    }
                                }
                            ?>
                        </select><br><br>
                    </div>
                    <div class="rbox">
                        <label>Section</label><br>
                        <select name="sec" class="input3" required>
                            <?php
                                $sql = "select DISTINCT(CSEC) from class";
                                $re = $db->query($sql);
                                if($re->num_rows>0){
                                    echo "<option value=''>Select</option>";
                                    while($r=$re->fetch_assoc()){
                                        echo "<option value='{$r["CSEC"]}'>{$r["CSEC"]}</option>";
                                    }
                                }
                            ?>
                        </select><br><br>
                    </div>
                    <button type="submit" class="btn" name="view">View Details</button>
                </form><br>
                <div class="output">
                    <?php
                        if(isset($_POST["view"])){
                            echo "<h3>Student Details</h3><br>";
                            $sql = "select * from student where SCLASS='{$_POST["cla"]}' and SSEC = '{$_POST["sec"]}'";
                            $re = $db->query($sql);
                            if($re->num_rows>0){
                                echo '
                                    <table>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>DOB</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Mail</th>
                                            <th>Address</th>
                                            <th>Class</th>
                                            <th>Sec</th>
                                            <th>Image</th>
                                        </tr>
                                    ';
                                $i=0;
                                while($r = $re->fetch_assoc()){
                                    $i++;
                                    echo "
                                            <tr>
                                                <td>{$i}</td>
                                                <td>{$r["RNO"]}</td>
                                                <td>{$r["NAME"]}</td>
                                                <td>{$r["FNAME"]}</td>
                                                <td>{$r["DOB"]}</td>
                                                <td>{$r["GEN"]}</td>
                                                <td>{$r["PHO"]}</td>
                                                <td>{$r["MAIL"]}</td>
                                                <td>{$r["ADDR"]}</td>
                                                <td>{$r["SCLASS"]}</td>
                                                <td>{$r["SSEC"]}</td>
                                                <td><img src='{$r["SIMG"]}' height='70' weight='70'></td>
                                            </tr>
                                        ";
                                }
                            }else{
                                echo "No record found";
                            }
                            echo "</table>";
                        }

                    ?>

                </div>
            </div>
        </div>
    </body>
</html>