<?php
session_start();
include("dbconnection.php");
?>
		
<table class="table table-bordered table-striped">
          <tr>
            <td><strong>Treatment Type</strong></td>
            <td><strong>Treatment Date & Time</strong></td>
            <td><strong>Doctor</strong></td>
            <td><strong>Treatment Description</strong></td>
            <td><strong>Treatment Cost</strong></td>
          </tr>
          <?php
		 $sql ="SELECT * FROM treatment_records LEFT JOIN treatment ON treatment_records.treatmentid=treatment.treatmentid WHERE treatment_records.patientid='$_GET[patientid]' AND treatment_records.appointmentid='$_GET[appointmentid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($con,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($con,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			$rstreatment = mysqli_fetch_array($qsqltreatment);
				
			echo "<tr>
					<td>$rstreatment[treatmenttype]</td>
					</td><td>;" . date("d-m-Y",strtotime($rs['treatment_date'])). "  &nbsp;". date("h:i A",strtotime($rs['treatment_time'])) . "</td>
					<td>$rsdoc[doctorname]</td>
					<td>$rs[treatment_description]";
if(file_exists("treatmentfiles/$rs[uploads]"))
{
	if($rs['uploads'] != "")
	{
		echo "<br><a href='treatmentfiles/$rs[uploads]'>Download</a>";
	}
}
			echo "</td>";
			echo "<td>&nbsp;$rs[treatment_cost]&nbsp;৳</td></tr>";
		}
		?>
</table>
<?php
if(isset($_SESSION['doctorid']))
{
?>  
<hr>
	<table>
	<tr>
	<td><div align="center"><strong><a href="treatmentrecord.php?patientid=<?php echo $_GET['patientid']; ?>&appid=<?php echo $rsappointment['appointmentid']; ?>">Add Treatment Records</a></strong></div></td>
	</tr>
	</table>
<?php
}
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmtreatdetail.select.value == "")
	{
		alert("Treatment Name Should Not Be Empty.");
		document.frmtreatdetail.select.focus();
		return false;
	}
	
	else if(document.frmtreatdetail.select2.value == "")
	{
		alert("Doctor Name Should Not Be Empty.");
		document.frmtreatdetail.select2.focus();
		return false;
	}
	else if(document.frmtreatdetail.textarea.value == "")
	{
		alert("Treatment Description Should Not Be Empty.");
		document.frmtreatdetail.textarea.focus();
		return false;
	}
	else if(document.frmtreatdetail.treatmentfile.value == "")
	{
		alert("Upload File Should Not Be Empty.");
		document.frmtreatdetail.treatmentfile.focus();
		return false;
	}
	else if(document.frmtreatdetail.date.value == "")
	{
		alert("Treatment Date Should Not Be Empty.");
		document.frmtreatdetail.date.focus();
		return false;
	}
	else if(document.frmtreatdetail.time.value == "")
	{
		alert("Treatment Time Should Not Be Empty.");
		document.frmtreatdetail.time.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
