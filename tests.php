<?php
ini_set('display_errors','off');
      $con = mysql_connect('localhost','root','');
     mysql_select_db("projet_i");



?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<title>B.E.P</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="ZTF666" />
		<link rel="shortcut icon" href="favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="CSS/demo.css" />
		<link rel="stylesheet" type="text/css" href="CSS/style.css" />
     

          
        
	</head>
	<body>



<div >
      <div class="content"><h2>Gestion des Absences</h2>
<table width="100%"  cellpadding="0">
    <tr><td><form id="form666" name="form666" method="post" action="">
        
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Employé</td>
          
            <td><select name="AA1">
<?php
$dr= mysql_query("select ID,Nom,Prenom from Personnel");
while($ligne=mysql_fetch_array($dr))
{
  ?>
            <option value="<?php echo $ligne[0]; ?>"><?php echo $ligne[1];echo"   "; echo $ligne[2];?></option>
<?php
}
?>
            </select></td>
</tr
<tr>
          <td>A/R</td>
          <td>
          <select name="AA2" id="AA2">
              <option value="Absence">Absence</option>
          <option value="Retard">Retard</option>
          </td>
        </tr>

          <tr><td></td><td><input type="submit" name="Abs" id="Abs" value="Valider" /></td>
        </tr>

</table>
        
        
        
        
        
        
        </td></tr>
  <tr><td>  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="">
     

<td>
  


 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#CCCCCC">
        <td><strong>Epmloyé</strong></td>
        <td><strong>Nombre Absences</strong></td>
        <td><strong>Nombre Retards</strong></td>
      </tr> <?php
         $res= mysql_query("select Nom,Prenom,Journee_A_R,count(Type_A_R) as Retard from absence_retard AR,personnel P where AR.ID_Perso=P.ID and Type_A_R='Absence'");
    
     
     
     
     
     
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
         <td><?php echo $ligne[0] ?><?php echo"   " ?><?php echo $ligne[1] ?></td>
         <td><?php echo $ligne[2] ?></td>
         <td><?php echo $ligne[3]  ?></td>
        
      </tr>
      <?php } ?>
    </table>
    </td>

  </tr>
      </table></table></form></td></tr>
 </div>
    </div>
    </body>
</html>