<?PHP

	$chosen_document=(int)$_POST['chosen_document'];
	
	$link=mysqli_connect("localhost", "root", "root", "project") or die("Ошибка " . mysqli_error($link));

	$Full_Name;
	$Gender;
	$Address;
	$DOB;
	$Title;
	$First_Code;
	$Second_Code;
	$Psychiatrist;
	$Narcologist;
	$Ophthalmologist;
	$Therapist;
	$P_Status;
	$P_Date;
	$N_Status;
	$N_Date;
	$O_Status;
	$O_Date;
	$T_Status;
	$T_Date;

	if(isset($_POST["make_one"])) {
		$chosen_document=(int)$_POST['chosen_document'];
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
						FROM document INNER JOIN person ON document.ID_Person=person.ID_Person INNER JOIN mo ON mo.ID_MO=document.ID_MO WHERE document.ID_Document='$chosen_document'";
	$result=mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	
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
		$P_Status=$row["P_Status"];
		$P_Date=$row["P_Date"];
		$N_Status=$row["N_Status"];
		$N_Date=$row["N_Date"];
		$O_Status=$row["O_Status"];
		$O_Date=$row["O_Date"];
		$T_Status=$row["T_Status"];
		$T_Date=$row["T_Date"];
	}	
}
?>


<table width="55%" align="center">
<thead>
  <tr>
    <td rowspan="2" width="40%" align="center">Министерство</br>здравоохранения</br>Российской Федерации</td>
    <td rowspan="4" width="15%"></td>
    <td align="left" width="30%">Код формы по ОКУД</td>
    <td width="10%" align="left"><u><?PHP echo $First_Code; ?></u></td>
  </tr>
  <tr>
    <td align="left">Код формы по ОКПО</td>
    <td align="left"><u><?PHP echo $Second_Code; ?></u></td>
  </tr>
  <tr>
    <td align="center"><u><?PHP echo $Title; ?></u></td>
    <td colspan="2"></td>
  </tr>
  <tr>
	<td align="center" valign="top"><font size="2">(наименование учреждения)</font></td>
    <td colspan="2">Медицинская документация</br>форма № 046-1</td>
  </tr>
</thead>
<tbody>
  <tr>
    <td colspan="2"></td>
    <td colspan="2"></br>Утверждена Министерством</br>здравоохранения Российской Федерации</br>от 11.09.2000 № 344</td>
  </tr>
</tbody>
</table>

<table width="100%">
	<tr>
		<td align="center">
		</br>
		</br>
		<b>МЕДИЦИНСКОЕ ЗАКЛЮЧЕНИЕ</b></td>
	</tr>
	<tr>
		<td align="center">
		<b>по результатам освидетельствования гражданина</br>для получения лицензии на приобретение оружия</b>
		</td>
	</tr>
</table>

</br>

<table width="55%" align='center'>
	<tr>
		<td align="left" width="30%">Фамилия, имя, отчество</td>
		<td align="left"><u><?PHP echo $Full_Name; ?></u></td>
	</tr>
	<tr>
		<td align="left" width="20%">Пол</td>
		<td align="left"><u><?PHP echo $Gender; ?></u></td>
	</tr>
	<tr>
		<td align="left" width="20%">Дата рождения</td>
		<td align="left"><u><?PHP echo $DOB; ?></u></td>
	</tr>
	<tr>
		<td align="left" width="20%">Домашний адрес</td>
		<td align="left"><u><?PHP echo $Address; ?></u></td>
	</tr>
</table>

</br>

<table width="60%" align='center' border="1" cellspacing="0">
	<tr>
		<td align='center' width='30%'>Специалист</td>
		<td align='center' width='25%'>Наличие</br>противопоказаний</br>(подчеркнуть)</td>
		<td align='center' width='15%'>Дата</br>Число</br>Месяц</td>
		<td align='center' valign="top">Фамилия врача,</br>Подпись</td>
	</tr>
	<tr>
		<td align='left' valign='top'>1. Врач-психиатр</td>
		<td align='center'><?PHP if ($P_Status=="1") echo "<u>выявлено</u></br>не выявлено"; else echo "выявлено</br><u>не выявлено</u>";  ?></td>
		<td align='center'><?PHP echo $P_Date; ?></td>
		<td align='center'><?PHP echo $Psychiatrist; ?></td>
	</tr>
	<tr>
		<td align='left' valign='top'>2. Врач-психиатр</br>&#160;&#160;&#160;&#160;нарколог</td>
		<td align='center'><?PHP if ($N_Status=="1") echo "<u>выявлено</u></br>не выявлено"; else echo "выявлено</br><u>не выявлено</u>";  ?></td>
		<td align='center'><?PHP echo $N_Date; ?></td>
		<td align='center'><?PHP echo $Narcologist; ?></td>
	</tr>
	<tr>
		<td align='left' valign='top'>3. Врач-офтальмолог</td>
		<td align='center'><?PHP if ($O_Status=="1") echo "<u>выявлено</u></br>не выявлено"; else echo "выявлено</br><u>не выявлено</u>";  ?></td>
		<td align='center'><?PHP echo $O_Date; ?></td>
		<td align='center'><?PHP echo $Ophthalmologist; ?></td>
	</tr>
	<tr>
		<td align='left' valign='top'>4. Врач-терапевт</td>
		<td align='center'><?PHP if ($T_Status=="1") echo "<u>выявлено</u></br>не выявлено"; else echo "выявлено</br><u>не выявлено</u>";  ?></td>
		<td align='center'><?PHP echo $T_Date; ?></td>
		<td align='center'><?PHP echo $Therapist; ?></td>
	</tr>
</table>

</br>

<table width="60%" align='center'>
	<tr>
		<td align="left">Заключение клинико-экспертной комиссии</td>
	</tr>
</table>

</br>
</br>
</br>
</br>
</br>

<table width="60%" align='center'>
	<tr>
		<td align="right">печать ЛПУ</td>
	</tr>
</table>

</br>
</br>
</br>
</br>
</br>