<?php
include("adheader.php");
include("dbconnection.php");
session_start();
if(isset($_POST['submit']))
{
	$sql = "UPDATE admin SET password='$_POST[newpassword]' WHERE password='$_POST[oldpassword]' AND adminid='$_SESSION[adminid]'";
	$qsql= mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>window.location.href = 'adminaccount.php';</script>";

	}
	else
	{
		echo "<div style='text-align:center;' class='alert alert-warning'>
		 Admin Record Update Failed.</div>";		
	}
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Admin's Password</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
<form method="post" action="" name="frmadminprofile" onSubmit="return validateform()">


		<div class="body">
			<div class="row clearfix">
				<div class="col-sm-12">   
					<div class="form-group">
						<div class="form-line">
							<input class="form-control" type="password" name="oldpassword" id="oldpassword" placeholder="Old Password" />
						</div>
					</div>
				
				</div>	
				
			</div>
			<div class="row clearfix"> 
				<div class="col-sm-12">                           
				 <div class="form-group">
						<div class="form-line">
							<input class="form-control" type="password" name="newpassword" id="newpassword" placeholder="New Password" />
						</div>
					</div>    
				</div>                      
			</div>  
			<div class="row clearfix"> 
			<div class="col-sm-12">                              
				 <div class="form-group">
						<div class="form-line">
							<input class="form-control" type="password" name="password" id="password" placeholder="Confirm Password" />
						</div>
					</div>
					</div>                          
			</div>                     
			<div class="col-sm-12" style="text-align: center;">
			<input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Submit" />
			</div>
		</div>
	</div>

</form>


 <div class="clear"></div>
  </div>
</div>

<?php
include("adfooter.php");
?>

<script type="application/javascript">
function validateform1()
{
	if(document.frmadminchange.oldpassword.value == "")
	{
		alert("Old Password Should Not Be Empty.");
		document.frmadminchange.oldpassword.focus();
		return false;
	}
	else if(document.frmadminchange.newpassword.value == "")
	{
		alert("New Password Should Not Be Empty.");
		document.frmadminchange.newpassword.focus();
		return false;
	}
	else if(document.frmadminchange.newpassword.value.length < 8)
	{
		alert("New Password Should Be More Than 8 Characters.");
		document.frmadminchange.newpassword.focus();
		return false;
	}
	else if(document.frmadminchange.newpassword.value != document.frmadminchange.password.value )
	{
		alert("Confirm Password First.");
		document.frmadminchange.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
