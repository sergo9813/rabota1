<html>
<meta charset="UTF-8">
<body>
<table border="0"><tr><td><h1>Наборы данных для заполнения бланка</h1></td></tr></table>
</body>
</html>

<?PHP

	$link=mysqli_connect("localhost", "root", "root", "project") or die("Ошибка " . mysqli_error($link));

	$query="SELECT	document.ID_Document,
					person.Full_Name, 
					person.Gender, 
					person.Address, 
					person.DOB, 
					mo.Title, 
					mo.First_Code, 
					mo.Second_Code, 
					mo.Psychiatrist, 
					mo.Narcologist, 
					mo.Ophthalmologist, 
					mo.Therapist, 
					document.P_Status, 
					document.P_Date, 
					document.N_Status, 
					document.N_Date, 
					document.O_Status, 
					document.O_Date, 
					document.T_Status, 
					document.T_Date 
					FROM document INNER JOIN person ON document.ID_Person=person.ID_Person INNER JOIN mo ON mo.ID_MO=document.ID_MO";
	$result=mysqli_query($link, $query) or die ("Ошибка " . mysqli_error($link));
	if($result)
	{
		echo "<br><table border=1 width=1000>
			<tr><td align='center'>ID Документа на вывод</td>
				<td align='center'>Полное имя</td>
				<td align='center'>Пол</td>
				<td align='center'>Адрес</td>
				<td align='center'>Дата рождения</td>
				<td align='center'>Наименование медицинской организации</td>
				<td align='center'>ОКУД</td>
				<td align='center'>ОКПО</td>
				<td align='center'>Психиатр</td>
				<td align='center'>Нарколог</td>
				<td align='center'>Офтальмолог</td>
				<td align='center'>Терапевт</td>
				<td align='center'>П-я Психиатра</td>
				<td align='center'>Дата заключения у П.</td>
				<td align='center'>П-я у Нарколога</td>
				<td align='center'>Дата заключения у Н.</td>
				<td align='center'>П-я у Офтальмолога</td>
				<td align='center'>Дата заключения у О.</td>
				<td align='center'>П-я у Терапевта</td>
				<td align='center'>Дата заключения у Т.</td></tr>";
		while ($row=mysqli_fetch_array($result)){
			$ID_Document=$row["ID_Document"];
			$Full_Name=$row["Full_Name"];
			if ($row["Gender"]==1) $Gender="мужчина"; else $Gender="женщина";
			$Address=$row["Address"];
			$DOB=$row["DOB"];
			$Title=$row["Title"];
			$First_Code=$row["First_Code"];
			$Second_Code=$row["Second_Code"];
			$Psychiatrist=$row["Psychiatrist"];
			$Narcologist=$row["Narcologist"];
			$Ophthalmologist=$row["Ophthalmologist"];
			$Therapist=$row["Therapist"];
			if ($row["P_Status"]==1) $P_Status="выявлено"; else $P_Status="не выявлено";
			$P_Date=$row["P_Date"];
			if ($row["N_Status"]==1) $N_Status="выявлено"; else $N_Status="не выявлено";
			$N_Date=$row["N_Date"];
			if ($row["O_Status"]==1) $O_Status="выявлено"; else $O_Status="не выявлено";
			$O_Date=$row["O_Date"];
			if ($row["T_Status"]==1) $T_Status="выявлено"; else $T_Status="не выявлено";
			$T_Date=$row["T_Date"];
			
			echo "<tr>	
			<td>$ID_Document</td>
			<td>$Full_Name</td>
			<td>$Gender</td>
			<td>$Address</td>
			<td>$DOB</td>
			<td>$Title</td>
			<td>$First_Code</td>
			<td>$Second_Code</td>
			<td>$Psychiatrist</td>
			<td>$Narcologist</td>
			<td>$Ophthalmologist</td>
			<td>$Therapist</td>
			<td>$P_Status</td>
			<td>$P_Date</td>
			<td>$N_Status</td>
			<td>$N_Date</td>
			<td>$O_Status</td>
			<td>$O_Date</td>
			<td>$T_Status</td>
			<td>$T_Date</td></tr>";
		}
	echo "</table>";
	}
	echo "</br>";
	
	$query="SELECT ID_Document FROM document";
	$result=mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$rows=array();
	$count=0;
 	while ($row=mysqli_fetch_array($result)){
		$rows[$count]=$row["ID_Document"];
		$count++;
	}
?>

<html>
<meta charset="UTF-8">
<body>
<form method="POST" action="action3.php">
<TABLE border="1">
	<tr>
		<td>Выберите ID: </td>
		<td>
		<select name="chosen_document">

		<?PHP
			for($i=0;$i<count($rows);$i++){
			echo "<option>$rows[$i]</option>";
			}
		?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td>
		<input name="make_one" type="submit" value="Сформировать документ">
		</td>
	</tr>
</table>
</form>
</body>
</html>

