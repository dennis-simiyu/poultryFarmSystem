<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}
include 'includes/database.php';
include 'includes/action.php';
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
                <table>
                    <thead>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Quantity Purchased</th>
                        <th>Amount Paid</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                    <?php
                        // calling viewMethod() method
                        $myrow = $medicineObject->viewMethod("MedicinePurchase");
                        foreach($myrow as $row){
                            // breaking point
                            ?>
                            <tr>
                                <td><?php echo $row['Date'];?></td>
                                <td><?php echo $row['MedicineName'];?></td>
                                <td><?php echo $row['Quantity'];?></td>
                                <td><?php echo $row['Price'];?></td>
                                <td>
                                    <a class="edit_btn" href="MedicinePurchase.php?medpurchUpdate=1&id=<?php echo $row["MedicinePurchase_ID"]; ?>">Edit</a>
                                </td>
                                <td>
                                    <a class="del_btn" href="includes/action.php?medpurchDelete=1&id=<?php echo $row["MedicinePurchase_ID"]; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
                
                <?php
                    if(isset($_GET["medpurchUpdate"])){
                        // Get the id of the record to be edited
                        $id = $_GET["id"] ?? null;
                        $where = array("MedicinePurchase_ID" => $id);
                        // Call the select method that displays the record to be edited
                        $row = $medicineObject->selectMethod("MedicinePurchase", $where);
                        ?>
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Date</label>
                                    <input type="date" name="Date" value="<?php echo $row["Date"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Medicine Name</label>
                                    <input type="text" name="MedName" value="<?php echo $row["MedicineName"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Quantity</label>
                                    <input type="number" step="any" name="Quantity" value="<?php echo $row["Quantity"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Price</label>
                                    <input type="number" step="any" name="Price" value="<?php echo $row["Price"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="medpurchUpdate" class="btn" value="">Update</button>
                                </div>
                            </form>
                        <?php
                    }else{
                        ?>
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <label for="">Date</label>
                                    <input type="date" name="Date" value="" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Medicine Name</label>
                                    <input type="text" name="MedName" value="" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Quantity</label>
                                    <input type="number" step="any" name="Quantity" value="" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Price</label>
                                    <input type="number" step="any" name="Price" value="" required>
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="medpurchSave" class="btn">Save</button>
                                </div>
                            </form>
                        <?php
                    }
                        ?>
            </div>
        </main>
        <!-- sidebar nav -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/partials/_side_bar.php";?>
    </div>
    <script src="script.js"></script>
</body>
</html>