<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/includes/action.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/functions.php";
checkLogin();

?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/partials/_head.php";?>
<body id="body">
    <div class="container">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/partials/_top_navbar.php";?>
        <main>
            <div class="main__container">
            <?php if(isset($_SESSION['msg'])): ?>
                    <div class="msg">
                    <p>
                        <?php 
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        ?>
                    </p>
                    </div>
                <?php endif ?>
                <?php if(isset($_SESSION['error_msg'])): ?>
                    <div class="error_msg">
                    <p>
                        <?php 
                            echo $_SESSION['error_msg'];
                            unset($_SESSION['error_msg']);
                        ?>
                    </p>
                    </div>
                <?php endif ?>
               
                
                <?php
                    if(isset($_GET["productionupdate"])){
                        // Get the id of the record to be edited
                        $id = $_GET["id"] ?? null;
                        $where = array("Production_ID" => $id);
                        // Call the select method that displays the record to be edited
                        $row = $salesObject->selectMethod("Production", $where);
                        ?>
                        <p class="heading">Edit Egg Production Record</p>
                            <form action="includes/action.php" method="post" onsubmit="return validate()">
                                <div class="input-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>
                                <div class="input-group">
                                <div class="my-div-error" id="errorDate"></div>
                                    <label for="">Date</label>
                                    <input type="date" name="Date" id="date" value="<?php echo $row["Date"]; ?>" required>
                                </div>
                                <div class="input-group">
                                <div class="my-div-error" id="errorNumber"></div>
                                    <label for="">Number of Eggs</label>
                                    <input type="number" id="number" step="any" name="NumberOfEggs" value="<?php echo $row["NumberOfEggs"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="productionedit" class="btn" value="">Update</button>
                                </div>
                            </form>
                        <?php
                    }else{
                        ?>
                        <p class="heading">Insert Record Of Eggs Produced</p>
                            <form action="includes/action.php" method="post" onsubmit="return validate()">
                                <div class="input-group">
                                <div class="my-div-error" id="errorDate"></div>
                                    <label for="">Date</label>
                                    <input type="date" name="Date" id="date" value="">
                                </div>
                                <div class="input-group">
                                <div class="my-div-error" id="errorNumber"></div>
                                    <label for="">Number of Eggs</label>
                                    <input type="number" step="any"id="number" name="NumberOfEggs" value="">
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="productionsave" class="btn">Save</button>
                                </div>
                            </form>
                        <?php
                    }
                        ?>

<table id="tb_table">
                    <thead>
                        <th>Date</th>
                        <th>Number of Eggs</th>
                        <th>Updated by:</th>
                        <?php if($_SESSION['perm_admin'] == 1 || $_SESSION['perm_action'] == 1):?>
                        <th colspan="2">Action</th>
                        <?php endif ?>
                    </thead>
                    <tbody>
                    <?php
                        // calling viewMethod() method
                        $myrow = $productionObject->viewMethod("Production");
                        foreach($myrow as $row){
                            // breaking point
                            ?>
                            <tr>
                                <td><?php echo $row['Date'];?></td>
                                <td><?php echo $row['NumberOfEggs'];?></td>
                                <td>
                                <?php 

                                $userid = $row['User_ID'];
                                $user = getUserName($userid);
                                echo $user;
                                ?>
                                </td>
                                <?php if($_SESSION['perm_admin'] == 1 || $_SESSION['perm_action'] == 1):?>
                                <td>
                                    <a class="edit_btn" href="production.php?productionupdate=1&id=<?php echo $row["Production_ID"]; ?>">Edit</a>
                                </td>
                                <td>
                                    <a class="del_btn" href="includes/action.php?productiondelete=1&id=<?php echo $row["Production_ID"]; ?>">Delete</a>
                                </td>
                                <?php endif ?>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- sidebar nav -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/partials/_side_bar.php";?>
    </div>
    <script>
    function validate(){
                        var dates = document.getElementById("date").value;
                        var number = document.getElementById("number").value;
                       
                       
                        
                        // Getting error divs ID
                        var errordate = document.getElementById('errorDate');
                        var errornumber = document.getElementById("errorNumber");
                       
                        
                        
                        // Defining REGEX
                       
                        
                        var truth = true;
                        if(dates == ""){
                            errordate.innerHTML = "This field is required";
                            truth = false;
                        }
                       
                        if(number < 1)
                        {
                            errornumber.innerHTML = "The number must be a positive integer";
                            truth = false;
                        }
                        if(number == ""){
                            errornumber.innerHTML = "This field is required";
                            truth =  false;
                        }
                        if(number > 1)
                        {
                        if(number % 1 != 0)
                        {
                            errornumber.innerHTML = "Enter a valid Integer number";
                            truth = false;
                        }
                        }
                        

                    


                        return truth;

                    }
                    </script>
    <script src="script.js"></script>
</body>
</html>