<?php
ob_start();
include('Head.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
    include("../Assets/Connection/connection.php");
    if(isset($_POST["btn_submit"]))
    {
        if($_POST["txt_update"]=="")
        {
            $insquery = "insert into tbl_district(district_name,state_id)values('".$_POST["txtdis"]."','".$_POST["state"]."')";
            if($con->query($insquery))
            {
                echo "Value Inserted";
            }
            else
            {
                echo "Insertion Failed";
            }
        }
        else
        {
            $update = "update tbl_district set district_name='".$_POST["txtdis"]."' where district_id='".$_POST["txt_update"]."'";
            $con->query($update);
            header("location:District.php");
        }
    }

    if(isset($_GET["delID"]))
    {
        $delquery = "delete from tbl_district where district_id='".$_GET["delID"]."'";
        if($con->query($delquery))
        {
            echo "Data Deleted";
        }
        else
        {
            echo " Deletion Failed";
        }
    }

    //Updation Code
    $ename = "";
    $eid = "";
    if(isset($_GET["edit"]))
    {
        $selquery1 = "select * from tbl_district where district_id='".$_GET["edit"]."'";
        $row1 = $con->query($selquery1);
        $data1 = $row1->fetch_assoc(); 
        $ename = $data1["district_name"];
        $eid = $data1["district_id"];
    }   
    ?>
    <div class="container mt-4">
        <a href="Homepage.php" class="btn btn-primary mb-4">Home</a>

        <form method="POST">
            <table class="table table-bordered" align="center">
                <tr>
                    <td>State</td>
                    <td>
                        <select required name="state" id="state" class="form-control">
                            <option value="">Select State</option>
                            <?php
                            $selquery2 = "select * from tbl_state";
                            $data2 = $con->query($selquery2);
                            while($state = $data2->fetch_assoc())
                            {
                            ?>
                                <option value="<?php echo $state['state_id'] ?>"><?php echo $state["state_name"]?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>District</td>
                    <td>
                        <input required type="text" name="txtdis" id="txtdis" class="form-control" value="<?php echo $ename?>" />
                        <input type="hidden" name="txt_update" id="txt_update" value="<?php echo $eid?>" />
                    </td>
                </tr>
                <tr>
                    <td><button name="btn_submit" type="submit" class="btn btn-primary">Save</button></td>
                    <td><button class="btn btn-secondary">Cancel</button></td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered" align="center">
            <thead>
                <tr>
                    <th>SI NO</th>
                    <th>District</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selquery = "select * from tbl_district d inner join tbl_state s on s.state_id = d.state_id";
                $data = $con->query($selquery);
                while ($row = $data->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["district_name"] ?></td>
                        <td><?php echo $row["state_name"] ?></td>
                        <td>
                            <a href="District.php?delID=<?php echo $row["district_id"] ?>" class="btn btn-danger">Delete</a>
                            <a href="District.php?edit=<?php echo $row["district_id"] ?>" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
        include('Foot.php');
        ob_flush();
        ?>

