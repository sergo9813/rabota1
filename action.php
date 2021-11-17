<html>
<meta charset="UTF-8">
<body>
<form method="POST">
<table border="0"><tr><td><h2>Добавить строку в таблицу с людьми</h2></td></tr></table>
<table border="1" cellspacing="0">
	<tr>
		<td><input size="30" type="text" placeholder="Введите полное имя" name="full_name"></td>
	</tr>
	
	<tr>
		<td><input type="radio" name="gender" value="0">женский</br>
			<input type="radio" name="gender" value="1">мужской
		</td>
	</tr>
	
	<tr>
		<td><textarea placeholder="Введите адрес проживания" cols="30" rows="3" wrap="off" name="address">
			</textarea>
		</td>
	</tr>

	<tr>
		<td><input type="date" name="dob"></td>
	</tr>
		
	<tr>
		<td><input name="add_person" type="submit" value="Добавить нового человека"></td>
	</tr>
	
</form>
</table>
</body>
</html>

<?PHP
	
	$link=mysqli_connect("localhost", "root", "root", "project") or die("Ошибка " . mysqli_error($link));
	
	if(isset($_POST["add_person"])) {
		$full_name=$_POST['full_name'];
		$gender=(int)$_POST['gender'];
		$address=$_POST['address'];
		$dob=$_POST['dob'];
		$send_person="INSERT INTO person (Full_Name, Gender, Address, DOB) VALUES ('$full_name', '$gender', '$address', STR_TO_DATE('$dob', '%Y-%m-%d'))";
		$result = mysqli_query($link, $send_person) or die("Не удается подключиться к БД". mysqli_error($link));
	}
	
	$query="SELECT * FROM person";
	$result=mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	if($result) {
		echo "<br><table border=1 width=510>
		<tr><td align='center'>ID</td>
			<td align='center'>Имя</td>
			<td align='center'>Пол</td>
			<td align='center'>Адрес</td>
			<td align='center'>Дата рождения</td></tr>";
		while ($row=mysqli_fetch_array($result)){
			$ID_Person=$row["ID_Person"];
			$Full_Name=$row["Full_Name"];
			$Gender=$row["Gender"];
			if ($Gender==1) $Gender="мужчина"; else $Gender="женщина";
			$Address=$row["Address"];
			$DOB=$row["DOB"];
			echo "<tr><td>$ID_Person</td><td>$Full_Name</td><td>$Gender</td><td>$Address</td><td>$DOB</td></tr>";
		}
	echo "</table>";
	}
echo "</br>";
?>

<html>
<meta charset="UTF-8">
<body>
<form method="POST">
<table><tr><td><h2>Добавить строку в таблицу с медицинскими организациями</h2></td></tr></table>
<table border="1">
	<tr><td><textarea placeholder="Введите наименование организации" cols="30" rows="3" wrap="off" name="title"></textarea></td></tr>
	<tr><td><input size="30" type="text" placeholder="Введите код формы по ОКУД" name="first_code"></td></tr>
	<tr><td><input size="30" type="text" placeholder="Введите код формы по ОКПО" name="second_code"></td></tr>
	<tr><td><input size="35" type="text" placeholder="Фамилия И. О. психиатра" name="psychiatrist"></td></tr>
	<tr><td><input size="35" type="text" placeholder="Фамилия И. О. нарколога" name="narcologist"></td></tr>
	<tr><td><input size="35" type="text" placeholder="Фамилия И. О. офтальмолога" name="ophthalmologist"></td></tr>
	<tr><td><input size="35" type="text" placeholder="Фамилия И. О. терапевта" name="therapist"></td></tr>
	<tr><td><input name="add_mo" type="submit" value="Добавить запись в БД"></td></tr>
</form>
</table>
</body>
</html>

<?php

	if(isset($_POST["add_mo"])) {
		$title=$_POST['title'];
		$first_code=$_POST['first_code'];
		$second_code=$_POST['second_code'];
		$psychiatrist=$_POST['psychiatrist'];
		$narcologist=$_POST['narcologist'];
		$ophthalmologist=$_POST['ophthalmologist'];
		$therapist=$_POST['therapist'];
		
		$send_mo="INSERT INTO mo (Title, First_Code, Second_Code, Psychiatrist, Narcologist, Ophthalmologist, Therapist) 
		VALUES ('$title', '$first_code', '$second_code', '$psychiatrist', '$narcologist', '$ophthalmologist', '$therapist')";
		$result = mysqli_query($link, $send_mo) or die("Не удается подключиться к БД". mysqli_error($link));;
	}
	
	$query="SELECT * FROM mo";
	$result=mysqli_query($link, $query) or die ("Ошибка " . mysqli_error($link));
	if($result)
	{
		echo "<br><table border=1 width=510>
			<tr><td align='center'>ID</td>
				<td align='center'>Название</td>
				<td align='center'>ОКУД</td>
				<td align='center'>ОКПО</td>
				<td align='center'>Психиатр</td>
				<td align='center'>Нарколог</td>
				<td align='center'>Офтальмолог</td>
				<td align='center'>Терапевт</td></tr>";
		while ($row=mysqli_fetch_array($result)){
			$ID_MO=$row["ID_MO"];
			$Title=$row["Title"];
			$First_Code=$row["First_Code"];
			$Second_Code=$row["Second_Code"];
			$Psychiatrist=$row["Psychiatrist"];
			$Narcologist=$row["Narcologist"];
			$Ophthalmologist=$row["Ophthalmologist"];
			$Therapist=$row["Therapist"];
			echo "	<tr>
					<td>$ID_MO</td>
					<td>$Title</td>
					<td>$First_Code</td>
					<td>$Second_Code</td>
					<td>$Psychiatrist</td>
					<td>$Narcologist</td>						
					<td>$Ophthalmologist</td>	
					<td>$Therapist</td>						
					</tr>";
		}
	echo "</table>";
	}
	echo "</br>";
	
	$query="SELECT ID_MO, Title FROM mo";
	$result=mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$rows=array();
	$count=0;
 	while ($row=mysqli_fetch_array($result)){
		$rows[$count]=$row["ID_MO"]."-".$row["Title"];
		$count++;
	}
	
	$query_new="SELECT ID_Person, Full_Name FROM person";
	$result_new=mysqli_query($link, $query_new) or die ("Ошибка " . mysqli_error($link));
	$rows_new=array();
	$count_new=0;
 	while ($row_new=mysqli_fetch_array($result_new)){
		$rows_new[$count_new]=$row_new["ID_Person"]."-".$row_new["Full_Name"];
		$count_new++;
	}
	
?>

<html>
<meta charset="UTF-8">
<body>
<form method = "POST">
<table border="0"><tr><td><h2>Оформление данных для справки</h2></td></tr></table>
<table border="1">
	
	<tr>
		<td>Противопоказания психиатра: </td>
		<td>
		<input type="radio" name="p_status" value="0">не выявлено</br>
		<input type="radio" name="p_status" value="1">выявлено
		</td>
	</tr>
	
	<tr>
		<td>Дата: </td>
		<td><input type="date" name="p_date"></td>
	</tr>
	
	<tr>
		<td>Противопоказания нарколога: </td>
		<td>
		<input type="radio" name="n_status" value="0">не выявлено</br>
		<input type="radio" name="n_status" value="1">выявлено
		</td>
	</tr>
	
	<tr>
		<td>Дата: </td>
		<td><input type="date" name="n_date"></td>
	</tr>
	
	<tr>
		<td>Противопоказания офтальмолога: </td>
		<td>
		<input type="radio" name="o_status" value="0">не выявлено</br>
		<input type="radio" name="o_status" value="1">выявлено
		</td>
		
	</tr>
	
	<tr>
		<td>Дата: </td>
		<td><input type="date" name="o_date"></td>
	</tr>
	
	<tr>
		<td>Противопоказания терапевта: </td>
		<td>
		<input type="radio" name="t_status" value="0">не выявлено</br>
		<input type="radio" name="t_status" value="1">выявлено
		</td>
	</tr>
	
	<tr>
		<td>Дата: </td>
		<td><input type="date" name="t_date"></td>
	</tr>
	
	<tr>
		<td>Выберите гражданина: </td>
		<td>
		<select name="chosen_person">

		<?PHP
			for($i=0;$i<count($rows_new);$i++){
			echo "<option>$rows_new[$i]</option>";
			}
		?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td>Выберите медицинское учреждение: </td>
		<td>
		<select name="chosen_mo">

		<?PHP
			for($i=0;$i<count($rows);$i++){
			echo "<option>$rows[$i]</option>";
			}
		?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td><input name="add_document" type="submit" value="Сформировать данные на отправку"></td>
	</tr>
</form>
</table>
</body>
</html>

<?PHP
	if(isset($_POST["add_document"])) {
		$p_status=$_POST['p_status'];
		$p_date=$_POST['p_date'];
		$n_status=$_POST['n_status'];
		$n_date=$_POST['n_date'];
		$o_status=$_POST['o_status'];
		$o_date=$_POST['o_date'];
		$t_status=$_POST['t_status'];
		$t_date=$_POST['t_date'];
		$chosen_person=$_POST['chosen_person'];
		$chosen_mo=$_POST['chosen_mo'];
		
		$p_status=(int)$p_status;
		$n_status=(int)$n_status;
		$o_status=(int)$o_status;
		$t_status=(int)$t_status;
			
		$chosen_person=(int)strtok($chosen_person, "-");
		$chosen_mo=(int)strtok($chosen_mo, "-");
		$send_document="INSERT INTO document (
			P_Status, 
			P_Date, 
			N_Status, 
			N_Date, 
			O_Status, 
			O_Date, 
			T_Status, 
			T_Date, 
			ID_MO, 
			ID_Person) VALUES (
			'$p_status', 
			STR_TO_DATE('$p_date', '%Y-%m-%d'), 
			'$n_status', 
			STR_TO_DATE('$n_date', '%Y-%m-%d'), 
			'$o_status', 
			STR_TO_DATE('$o_date', '%Y-%m-%d'), 
			'$t_status', 
			STR_TO_DATE('$t_date', '%Y-%m-%d'), 
			'$chosen_mo',
			'$chosen_person')";
			
		$result=mysqli_query($link, $send_document) or die("Не удается подключиться к БД". mysqli_error($link));
	}
?>
</br>
<a href="action2.php"><h4>Перейти к формированию документа</h4></a>