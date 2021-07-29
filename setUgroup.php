<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "includes/database.php";
include "includes/action.php";


	$ugroup_id = 0;
	$error = "no";

	//Select all Usergroups from UGROUP
	$ugroups = array();
	$result_usergroups = $ugroupObject->viewMethod("Ugroup");
	
	foreach($result_usergroups as  $row_ugroups){
		$ugroups[] = $row_ugroups;
		$ugroup_names[] = $row_ugroups['Ugroup_name'];
	}

	//Check for error from set_ugroup_del.php

	//Set heading and variable according to selectio

	//SAVE-Button
?>
<!DOCTYPE HTML>
<html>
		
	<?php include "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/partials/_head.php"; ?>

	<body>
    <div class="container">
    <?php include "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/partials/_top_navbar_settings.php"; ?>
    <main>
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
		
		
				

                <?php if(isset($_GET['update_Ugroup'])){
                $id = $_GET['update_Ugroup'] ?? null;
                $where = array("Ugroup_ID" => $id);
                $row_groups = $ugroupObject->selectMethod("Ugroup", $where);
                ?>

                
              <?PHP echo '<p class="heading">Edit User</p>'; ?>
				<form action="includes/action.php" method="post">
					<table id="tb_set" style="margin:auto;">
						<tr>
							<td>Usergroup Name</td>
							<td>
                            <input type="text" name="ugroup_name" placeholder="Usergroup Name" value="<?PHP echo $row_groups['Ugroup_name']  ?>"/>
                            </td>
						</tr>
						<tr>
							<td>Permissions</td>
							<td>
								<input type="checkbox" name="ugroup_admin" <?PHP if($row_groups['Ugroup_admin'] == 1) echo 'checked="checked" '; ?> />
								Administrator</td>
						</tr>
						<tr>
							<td>
                            </td>
							<td>
								<input type="checkbox" name="ugroup_sales" <?PHP if($row_groups['Ugroup_sales'] == 1) echo 'checked="checked" '; ?> />
								Sales</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_purchases" <?PHP if($row_groups['Ugroup_purchase'] == 1) echo 'checked="checked" '; ?> />
								Purchase</td>
						</tr>
                        <tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_medicine" <?PHP if($row_groups['Ugroup_medicine'] == 1) echo 'checked="checked" '; ?> />
								medicine</td>
						</tr>
                        <tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_feeds" <?PHP if($row_groups['Ugroup_feeds'] == 1) echo 'checked="checked" '; ?> />
								feeds</td>
						</tr>
                        <tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_disease" <?PHP if($row_groups['Ugroup_disease'] == 1){ echo 'checked="checked" ';} ?> />
								disease</td>
						</tr>
					</table>
					<input type="submit"  class = "edit_btn" name="edit_Ugroup" value="Update" />
					<input type="hidden" name="ugroup_id" value="<?PHP echo $_GET['update_Ugroup'];?>" />
				</form>
                <?php } 
                else
                {?>
                    <form action="includes/action.php" method="post">
					<table id="tb_set" style="margin:auto;">
						<tr>
							<td>Usergroup Name</td>
							<td>
                            <input type="text" name="ugroup_name" placeholder="Usergroup Name" value=""/>
                            </td>
						</tr>
						<tr>
							<td>Permissions</td>
							<td>
								<input type="checkbox" name="ugroup_admin" />
								Administrator</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_sales"  />
								Sales</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_purchases" />
								Purchase</td>
						</tr>
                        <tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_medicine" />
								medicine</td>
						</tr>
                        <tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_feeds" />
								Feeds</td>
						</tr>
                        <tr>
							<td></td>
							<td>
								<input type="checkbox" name="ugroup_disease" />
								Disease</td>
						</tr>
					</table>
					<input type="submit" class="edit_btn" name="save_Ugroup" value="Save" />
				</form>
               <?php  }
                ?>
                
		

	
	
			<table id="tb_table">
				
				<tr>
					<th colspan="10" class="title">Existing Usergroups</th>
				</tr>
				<tr>
					<th rowspan="2">User Group Name</th>
					<th colspan="6">Permissions</th>
					<th colspan="2" rowspan="2">Action</th>
					
				</tr>
				<tr>
					<th style="background-color:#a7dbd8">Administrator</th>
					<th style="background-color:#a7dbd8">Purchase</th>
					<th style="background-color:#a7dbd8">Sales</th>
                    <th style="background-color:#a7dbd8">Medicine</th>
                    <th style="background-color:#a7dbd8">Feeds</th>
                    <th style="background-color:#a7dbd8">Disease</th>
				</tr>
				<?PHP
					foreach ($ugroups as $row_ugroups){?>
						<tr>
									<td><?php echo $row_ugroups['Ugroup_name']; ?></td>
									<td>
										<input type="checkbox" disabled="disabled" 
										<?php if ($row_ugroups['Ugroup_admin']==1) echo 'checked="checked" ';?>/>
									</td>
									<td>
										<input type="checkbox" disabled="disabled" 
										<?php if ($row_ugroups['Ugroup_sales'] ==1) echo 'checked="checked" ';?>/>
									</td>
									<td>
										<input type="checkbox" disabled="disabled" 
										<?php if ($row_ugroups['Ugroup_purchase'] ==1) echo 'checked="checked" ';?> />
									</td>
                                    <td>
										<input type="checkbox" disabled="disabled" 
										<?php if ($row_ugroups['Ugroup_purchase'] ==1) echo 'checked="checked" ';?> />
									</td>
                                    <td>
										<input type="checkbox" disabled="disabled" 
										<?php if ($row_ugroups['Ugroup_purchase'] ==1) echo 'checked="checked" ';?>/>
									</td>
                                    <td>
										<input type="checkbox" disabled="disabled" 
										<?php if ($row_ugroups['Ugroup_purchase'] ==1) echo 'checked="checked" ';?> />
									</td>
						   <td>
					
										<a href="setUgroup.php?update_Ugroup=<?php echo $row_ugroups['Ugroup_ID']; ?>">
											<p class="edit_btn">Edit</p>
										</a>
						</td>
									<td>
						
										<a href="includes/action.php?delete_Ugroup=<?php echo $row_ugroups['Ugroup_ID']; ?>">
											<p class="del_btn">Delete</p>
										</a>
						  </td>
								</tr>
					<?php } ?>

	
			</table>
        </main>
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/poultryFarm/partials/_side_bar.php"; ?>
    </div>
	</body>
</html>