<?
include 'incl/header2.php';
?>

<center>
<br>
<table width=500 border=0>
<tr>
<td>
<h3>Welcome <?=$_SESSION['name']?></h3>

<p>
This is your home page. You can return to this page at any time by clicking 
"Home" in the upper right corner of the black bar at the top of every page.
</p>

<p>
Please select an option below:
</p>


<? if ($_SESSION['status'] == 'admin') { ?>
<ul>
<li><a href="list_apps.php">View applications</a>
<li><a href="list_letters.php">View letters</a>
<li><a href="logout.php">Logout</a>
</ul>
</p>
<? } ?>



</td>
</tr> 


</table>


</center>

</body>
</html>
