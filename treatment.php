<?php
include("adheader.php");
include("dbconnection.php");

if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE treatment SET treatmenttype='$_POST[treatmenttype]',treatment_cost='$_POST[treatmentcost]',note='$_POST[textarea]',status='$_POST[select]' WHERE treatmentid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Treatment Record Updated Successfully.');
			window.location.href = 'viewtreatment.php';
			</script>";

		}
		else
		{
			echo mysqli_error($con);
		}	
	}

	else
	{
		$sql ="INSERT INTO treatment(treatmenttype,treatment_cost,note,status) values('$_POST[treatmenttype]','$_POST[treatmentcost]', '$_POST[textarea]','$_POST[select]')";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Treatment Record Inserted Successfully.');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}

if(isset($_GET['editid']))
{
	$sql="SELECT * FROM treatment WHERE treatmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>


<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center">Add New Treatment</h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">

				<form method="post" action="" name="frmtreat" onSubmit="return validateform()">
					<div class="row">
						<div class="col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="type" style="color: black; font-size: 1rem; font-weight: 400;font-family: 'Roboto', Arial, Tahoma, sans-serif;">Treatment Type</label>
								<div class="form-line">
								<input type="text" placeholder="Enter Treatment Type" class="form-control" name="treatmenttype" id="treatmenttype" value="<?php echo $rsedit['treatmenttype']; ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="type" style="color: black; font-size: 1rem; font-weight: 400;font-family: 'Roboto', Arial, Tahoma, sans-serif;">Treatment Cost</label>
								<div class="form-line">
									<input type="text" placeholder="Enter Treatment Cost" class="form-control" name="treatmentcost" id="treatmentcost"
									value="<?php echo $rsedit['treatment_cost']; ?>" />
								</div>
							</div>
						</div>

						<div class="col-sm-4 col-xs-12">
							<div class="form-group">
								<label style="color: black; font-size: 1rem; font-weight: 400;font-family: 'Roboto', Arial, Tahoma, sans-serif;"></label>Status</label>
								<div class="form-line">

									<select name="select" id="select" class=" form-control show-tick">
										<option value="">Select</option>
										<?php
										$arr = array("Active","Inactive");
										foreach($arr as $val)
										{
											if($val == $rsedit['status'])
											{
												echo "<option value='$val' selected>$val</option>";
											}
											else
											{
												echo "<option value='$val'>$val</option>";			  
											}
										}
										?>
									</select>
								</div>
							</div>
						</div> 

					<div class="col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="" style="color: black; font-size: 1rem; font-weight: 400;font-family: 'Roboto', Arial, Tahoma, sans-serif;">Treatment Description</label>
							<div class="form-line">
								<textarea name="textarea" placeholder="Enter Treatment Description" class="form-control no-resize" id="textarea" cols="45"
								rows="5"><?php echo $rsedit['note'] ; ?></textarea>
							</div>
						</div>
					</div>
				</div>

			<div class="col-sm-12" align="center">
				<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-raised g-bg-cyan" />
			</div>

				</form>
			</div>
		</div>
	</div>	
</div>

<?php
include("adfooter.php");
?>


<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; 												/* Variable to Validate only Alphabets */
var alphaspaceExp = /^[a-zA-Z\s]+$/; 										/* Variable to Validate only Alphabets and Space */
var numericExpression = /^[0-9]+$/; 										/* Variable to Validate only Numbers */
var alphanumericExp = /^[0-9a-zA-Z]+$/; 									/* Variable to Validate Numbers and Alphabets */
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; 		/* Variable to Validate Email ID */
function validateform() {
	if (document.frmtreat.treatmenttype.value == "") {
		alert("Treatment Type Should Not Be Empty.");
		document.frmtreat.treatmenttype.focus();
		return false;
	} else if (!document.frmtreat.treatmenttype.value.match(alphaspaceExp)) {
		alert("Treatment Type Not Valid.");
		document.frmtreat.treatmenttype.focus();
		return false;
	} else if (document.frmtreat.select.value == "") {
		alert("Kindly Select The Status.");
		document.frmtreat.select.focus();
		return false;
	} else {
		return true;
	}
}
</script>