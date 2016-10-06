<?
include 'incl/header2.php';

if ($_SESSION['status'] == 'admin') {

// get # of applicants
$query0 = "select count(id) from fellows";
$res0 = mysqli_query($mysqli, $query0);
$row0 = mysqli_fetch_array($res0);
$num = $row0[0];
?>

<center>


<table border=0 width="90%"> 
<tr>
<td>
<h2>Applications (<?=$num?>)</h2>
</td>

<td>
<button type="button" class="myButtonsm" onclick="window.location='excel.php';">
Download to Excel</button>
</td>

<td align=right valign=middle>
<form action="list_apps.php" method="post">
Sort by:&nbsp;
<select name="sort" onchange="this.form.submit();">
<option value="name" <? if ($_POST['sort']=="name") echo ' selected'; ?>>Name</option>
<option value="id" <? if ($_POST['sort']=="id") echo ' selected'; ?>>ID</option>
<option value="cat" <? if ($_POST['sort']=="cat") echo ' selected'; ?>>Category</option>
</select>
</form>
</td>
</tr>
</table>

<table class="proptable" width="90%">
<tr class="propheader">
<td>ID</td>
<td>Name</td>
<td>Category</td>
<td>Cover sheet</td>
<td>CV+Pubs</td>
<td>Previous<br>research</td>
<td>Research<br>proposal</td>
<td>Letters</td>
<td>Application<br>minus letters<br>(PDF)</td>
<td>Entire<br>application<br>(PDF)</td>
</tr>

<?
$order = " order by last, first, id";

switch ($_POST['sort']) {
        case "name":
        $order=" order by last, first, id";
        break;
        case "id":
        $order=" order by id";
        break;
        case "cat":
        $order=" order by category, last, first";
        break;
        }

$query = "select id, last, first, category, dirname from fellows";
$query = $query . $order;
$result = mysqli_query($mysqli, $query) or die("Query Failed");
while ($row = mysqli_fetch_array($result)) {
$dirname = $row["dirname"];
$let1 = $basedir . $dirname . '/letter1.pdf';
$let2 = $basedir . $dirname . '/letter2.pdf';
$let3 = $basedir . $dirname . '/letter3.pdf';
$app = $basedir . $dirname . '/application.pdf';
?>

<tr>
<td><?=$row['id']?></td>
<td nowrap><?=$row['last']?>, <?=$row['first']?></td>
<td><?=$row['category']?></td>

<td><a href="get_file.php?id=<?=$row['id']?>&file=cs">view</a></td> 
<td><a href="get_file.php?id=<?=$row['id']?>&file=cv">view</a></td>
<td><a href="get_file.php?id=<?=$row['id']?>&file=pr">view</a></td>
<td><a href="get_file.php?id=<?=$row['id']?>&file=rp">view</a></td>

<td>
<?
if (file_exists($let1)) echo "<a href=\"get_file.php?id=$row[id]&file=l1\">1</a> | ";
else echo "1 | ";

if (file_exists($let2)) echo "<a href=\"get_file.php?id=$row[id]&file=l2\">2</a> | ";
else echo "2 | ";   

if (file_exists($let3)) echo "<a href=\"get_file.php?id=$row[id]&file=l3\">3</a>";
else echo "3";   
?>
</td>

<td><a href="get_file.php?id=<?=$row['id']?>&file=apptemp">view</a></td>

<td nowrap>
<a href="create_pdf.php?id=<?=$row['id']?>">create</a> | 

<?
if (file_exists($app)) echo "<a href=\"get_file.php?id=$row[id]&file=app\">view</a>";
else echo "view";
?>

</td>
</tr>

<?
} 
?>

</table>
</center>

</body>
</html>


<?
}
?>
