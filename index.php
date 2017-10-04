
 <?php
/*  masque l'erreur d'incompatibilité entre cette version de php et le php5
 &     gestion connexion a la BDD*/

ini_set('display_errors','off');
      $con = mysql_connect('localhost','root','');
     mysql_select_db("gestionstock");




     /*  teste sur la session , si session==vide renvoi vers la page de login , sinon passe vers l'index  */
     if (!isset( $_SESSION['email'] ))
         {
           header('location:Loginadmin.php');
         }
         
  
      /*ACRIPT GESTION TABLE affectation du materiel  */
if (isset ($_POST['New']))
      {
       //$selectOption = $_POST['a5'];
       $selectOption1 = $_POST['a1'];
       $selectOption2 = $_POST['a2'];
     
$GLOBALS['X'] = $_POST['a3'];
    
       mysql_query("INSERT INTO destination VALUES('$_POST[a3]','$selectOption1','$_POST[a4]','$_POST[a5]',' $selectOption2')");


    mysql_query("UPDATE materiel set deploye=1 where Nvnum='$X'");
      }


       
/*script GESTION  TABLE MATERIEL */

if (isset ($_POST['INSERT']))
      { $selectOption = $_POST['t5'];
    $query=mysql_query("INSERT INTO materiel (nserie,libele,dateachat,typem,nvnum)VALUES('$_POST[t1]','$_POST[t3]','$_POST[t4]','$selectOption','$_POST[t2]')");}

/*                                */

if (isset ($_POST['oinsert']))
      { 
    $query=mysql_query("INSERT INTO departement VALUES('$_POST[o1]','$_POST[o2]')");}


/*            personnel          */
if (isset ($_POST['pinsert']))
      { 
     $selectOption = $_POST['p3'];
    $query=mysql_query("insert into personnel values ('$_POST[p1]','$_POST[p2]','$selectOption','$_POST[p4]','$_POST[p5]')");
}

/* gestion de pannes */
 //faire une update sur le deploiement du matos pour l'enlevé du tableau du matos deployé et l'ajouté dans celui qui est en reparation ou dead
    //0 = non deployé , 1 = deployé , 2 = reformé , 3 = en reparation

if (isset ($_POST['winsert']))
      { 
    $x= $_POST['w1'];
    $y=$_POST['w3'];
    
    
   
       $dr= mysql_query("select * from pannes where SerieM='$x'");
 $ligne=mysql_fetch_array($dr);
 if($ligne!=0)
  {
     if($ligne[2]=$y=2){
     /*dead*/
     $query=mysql_query("UPDATE Materiel SET deploye=2   where NVnum='$x'");
     $query2=mysql_query("DELETE from pannes   where SerieM='$x'");
         
         
     $query4=mysql_query("INSERT INTO matreforme  values('$x')");
        
     }
     
     /*enreparation*/
     if($ligne[2]=$y=3){  
          $query3=mysql_query("insert into pannes values ('$_POST[w1]','$_POST[w2]','$_POST[w3]')");
            $sql2=mysql_query("UPDATE Materiel SET deploye=3 where NVnum='$x'");
     }
   
  }
  else
  {
    $query3=mysql_query("insert into pannes values ('$_POST[w1]','$_POST[w2]','$_POST[w3]')");
  }
      
      
}


/*      materiel reparé et redploiement et availability      */



if (isset ($_POST['kinsert']))
      {
     $s=$_POST['k1'];

    
       $dr= mysql_query("select * from pannes where SerieM='$s' and etatmat !=0");
 $ligne=mysql_fetch_array($dr);
 if($ligne!=0)
  {
     $query=mysql_query("UPDATE Materiel  SET deploye=0 where NVnum='$s'");
     $query2=mysql_query("UPDATE pannes  SET etatmat=0 where SerieM='$s'");
   
  }
  else
  {
    echo"<script language=\"javascript\">";
    echo "alert('Numero de serie non existant sur la table ou deja reparé !!')";
    echo"</script>";
  }           
              }










?>

<!-- fin des scripts PHP -->
<!DOCTYPE html>
<!--AUTHOR ELATIF NABIL-->
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<title>Gestion stock</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="ZTF666" />
		<link rel="shortcut icon" href="favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="CSS/demo.css" />
		<link rel="stylesheet" type="text/css" href="CSS/style.css" />
     

          
        
	</head>
	<body>
		
		<!-- Gestion du matos -->
		<div id="Gstag" class="panel">
      <div class="content">
      <h2>Gestion du materiel</h2>
      <table width="100%">
      <tr><td>
      <table width="30%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td width=""><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="">Num de serie</td>
          <td width=""><label for="t1"></label>
            <input type="text" name="t1" id="t1" /></td>         
        </tr>
        <tr>
          <td>Nouveau numero de serie </td>
          <td><input type="text" name="t2" id="t2" /></td>        
        </tr>
          <tr>
          <td>Marque </td>
          <td><input type="text" name="t3" id="t3" /></td>        
        </tr>
        <tr>
          <td>Date d'achat </td>
          <td><input type="text"  value="yyyy/mm/dd"name="t4" id="t4" /></td>        
        </tr>
        <tr>
          <td>Type du materiel </td>
          <td><select name="t5">
<?php
$dr= mysql_query("select * from typematos");
while($ligne=mysql_fetch_array($dr))
{
  ?>
            <option value="<?php echo $ligne[0]; ?>"><?php echo $ligne[1];?></option>
<?php
}
?>
            </select></td>        
        </tr>
        <tr>
            <td width=""><input type="Reset" name="b" id="b" value="Vider" /></td>
        <td>  <input type="submit" name="INSERT" id="INSERT" value="Valider" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table></td>
<td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>Num.Serie </strong></td>
        <td><strong>Nv.serie</strong></td>
        <td><strong>Marque</strong></td>
        <td><strong>Date achat</strong></td>
        <td><strong>Type</strong></td>
       
      </tr> <?php
         $res= mysql_query("select Nserie,nvnum,libele,dateachat,type from materiel M,typematos TM
where M.Typem=TM.ID   order by type");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
        <td><?php echo $ligne[2] ?></td>
        <td><?php echo $ligne[3] ?></td>
        <td><?php echo $ligne[4] ?></td>

      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
</table>
</td> </tr></table>
    </div>
    </div>



        <!--       deploiement du matos -->





        <div id="Gabs" class="panel">
      <div class="content"><h2>Deploiement du materiel</h2>
<table width="100%"  cellpadding="0">
  <tr><td>
    
<table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width=""><form id="form2" name="form2" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Employé </td>
          
            <td><select name="a1">
<?php
$dr= mysql_query("select cin,nomprenom,dept from Personnel");
while($ligne=mysql_fetch_array($dr))
{
  ?>
            <option value="<?php echo $ligne[0]; ?>"><?php echo $ligne[1];echo" -- "; echo $ligne[2];?></option>
<?php
}
?>
            </select></td>
          </tr>
<tr>
          <td>Type </td>
          <td><select name="a2">
<?php
$dr= mysql_query("select * from typematos");
while($ligne=mysql_fetch_array($dr))
{
  ?>
            <option value="<?php echo $ligne[0]; ?>"><?php echo $ligne[1];?></option>
<?php
}
?>
            </select></td>  
        </tr>
 
          
          <tr>
          <td>Serie </td>
<td><input type="text" name="a3" id="a3" /></td>
          </tr>

          <tr>
          <td>Date</td>
          <td><input type="text" value="yyyy/mm/dd" name="a4" id="a4" /></td>        
        </tr>
   
          <tr>
          <td>Etat</td>
          <td><select name="a5">    
              <option value="1">Neuf</option>
              <option value="5">Reparé</option>
              </select></td>
        </tr>
          
          <tr><td></td><td><input type="submit" name="New" id="New" value="Assigner" /></td>
        </tr>

</table>
    </form></td>
  </tr>
</table>
</td>
      
    
      <td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>Num.Serie </strong></td>
        <td><strong>Nv.serie</strong></td>
        <td><strong>Marque</strong></td>
        <td><strong>Date achat</strong></td>
        <td><strong>Type</strong></td>
       
      </tr> <?php
         $res= mysql_query("select Nserie,nvnum,libele,dateachat,type from materiel M,typematos TM
where M.Typem=TM.ID and deploye=0 order by type");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
        <td><?php echo $ligne[2] ?></td>
        <td><?php echo $ligne[3] ?></td>
        <td><?php echo $ligne[4] ?></td>

      </tr>
      <?php } ?>
    </table>
    </td></tr>  <tr><td>
 <table width="220%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#CCCCCC">
        <td><strong>CIN epmloyé</strong></td>
        <td><strong>Type</strong></td>
        <td><strong>Serie</strong></td>
        <td><strong>Date</strong></td>
        <td><strong>Etat</strong></td>
          
      </tr> <?php
         $res= mysql_query("select * from destination order by cin ");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
         <td><?php echo $ligne[1] ?></td>
         <td><?php echo $ligne[4] ?></td>
         <td><?php echo $ligne[0]  ?></td>
         <td><?php echo $ligne[2]  ?></td>
         <td><?php echo $ligne[3]  ?></td>
        
      </tr>
      <?php } ?>
    </table>
    </td>

  </tr>
</table>
 </div>
    </div>
        <!--           ETAT MATERIEL -->




		<div id="Gpan" class="panel">
      <div class="content">
      <h2>Etat du materiel</h2>
      <table width="100%">
      <tr><td>
      <table width="30%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td width=""><form id="form2" name="form2" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="">Num de serie</td>
          <td width=""><label for="w1"></label>
            <input type="text" name="w1" id="w1" /></td>         
        </tr>
        <tr>
          <td>Date de panne </td>
          <td><input type="text" name="w2" id="w2" /></td>        
        </tr>
       
        <tr>
          <td>Etat </td>
          <td><select name="w3">
            <option value="3">En reparation</option>
            <option value="2">Reformé</option>

            </select></td>        
        </tr>
        <tr>
            <td width=""><input type="Reset"  value="Vider" /></td>
        <td>  <input type="submit" name="winsert" id="winsert" value="Ajouter" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table></td>
<td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>Serie </strong></td>
        <td><strong>Date panne</strong></td>
        <td><strong>Etat</strong></td>
        
       
      </tr> <?php
         $res= mysql_query("select SerieM,datepanne,etatmat from pannes where etatmat !=0 order by datepanne");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
        <td><?php echo $ligne[2] ?></td>
      

      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
</table>
</td> </tr></table>
    </div>
    </div>




<!--                 departements                 -->





		<div id="Gdept" class="panel">
      <div class="content">
      <h2>Gestion des departements</h2>
      <table width="100%">
      <tr><td>
      <table width="30%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td width=""><form id="form3" name="form3" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="">ID departement</td>
          <td width=""><label for="o1"></label>
            <input type="text" name="o1" id="o1" /></td>         
        </tr>
        <tr>
          <td>Libelé </td>
          <td><input type="text" name="o2" id="o2" /></td>        

        <tr>
            <td width=""><input type="Reset" name="b" id="b" value="Vider" /></td>
        <td>  <input type="submit" name="oinsert" id="oinsert" value="Valider" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table></td>
<td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>ID </strong></td>
        <td><strong>Libelé</strong></td>
      
      </tr> <?php
         $res= mysql_query("select * from departement order by ID");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
       

      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
</table>
</td> </tr></table>
    </div>
    </div>







<!--               Personnel                   -->

<div id="Gpers" class="panel">
      <div class="content">
      <h2>Gestion personnel</h2>
      <table width="100%">
      <tr><td>
      <table width="30%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td width=""><form id="form44" name="form44" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="">CIN</td>
          <td width=""><label for="p1"></label>
            <input type="text" name="p1" id="p1" /></td>         
        </tr>
        <tr>
          <td>Nom et prenom </td>
          <td><input type="text" name="p2" id="p2" /></td>        
        </tr>
          <tr>
          <td>Departement </td>
          <td><select name="p3">
<?php
$dr= mysql_query("select * from departement");
while($ligne=mysql_fetch_array($dr))
{
  ?>
            <option value="<?php echo $ligne[0]; ?>"><?php echo $ligne[1];?></option>
<?php
}
?>
            </select></td>         
        </tr>
        <tr>
          <td>N.Bureau </td>
          <td><input type="text"  name="p4" id="p4" /></td>        
        </tr>
        <tr>
          <td>Telephone </td>
                 <td><input type="text" name="p5" id="p5" /></td>
        </tr>
        <tr>
            <td width=""><input type="Reset" name="bp" id="bp" value="Vider" /></td>
        <td>  <input type="submit" name="pinsert" id="pinsert" value="Valider" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table></td>
<td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>CIN </strong></td>
        <td><strong>Nom</strong></td>
        <td><strong>Dept</strong></td>
        <td><strong>N.bureau</strong></td>
        <td><strong>Telephone</strong></td>
       
      </tr> <?php
         $res= mysql_query("select * from personnel order by nomprenom");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
        <td><?php echo $ligne[2] ?></td>
        <td><?php echo $ligne[3] ?></td>
        <td><?php echo $ligne[4] ?></td>

      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
</table>

    </div>
    </div>

<!--     matos sorti                -->

<div id="Gdt" class="panel">
      <div class="content">
      <h2>Materiels deployé</h2>
      <table width="100%">
      <tr>
      
<td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>Numero de serie </strong></td>
        <td><strong>CIN</strong></td>
        <td><strong>Type</strong></td>
        <td><strong>Date affectation</strong></td>
        
      
      </tr> <?php
         $res= mysql_query("select Numserie,cin,type,dateaff from destination D,materiel M,typematos TM
where D.Numserie=M.Nvnum and D.typee=M.typem=TM.ID and deploye=1
order by dateaff");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
        <td><?php echo $ligne[2]  ?></td>
        <td><?php echo $ligne[3]  ?></td>
        
       

      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
      <!-- possibilité d'ajouter le materiel non deployé -->
</table>
    </div>
    </div>









<!--  THINK BIG !! redploiement du materiels en pannes qui a été reparé----->



		<div id="Grep" class="panel">
      <div class="content">
      <h2>Etat du materiel</h2>
      <table width="100%">
      <tr><td>
      <table width="30%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td width=""><form id="form5" name="form5" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="">Num de serie</td>
          <td width=""><label for="k1"></label>
            <input type="text" name="k1" id="k1" /></td>         
        </tr>
        <tr>
          <td>Etat </td>
          <td><select name="k2">
            <option value="0">Reparé</option>
            </select></td>        
        </tr>
        <tr>
            <td width=""><input type="Reset"  value="Vider" /></td>
        <td>  <input type="submit" name="kinsert" id="kinsert" value="Ajouter" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table></td>
<td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>Serie </strong></td>
        <td><strong>Date panne</strong></td>
        <td><strong>Etat</strong></td>
        
       
      </tr> <?php
         $res= mysql_query("select SerieM,datepanne,etatmat from pannes where etatmat !=2  order by datepanne");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
        <td><?php echo $ligne[2] ?></td>
      

      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
</table>
</td> </tr></table>
    </div>
    </div>






















<!--  ----->
<!--     matos sorti                -->

<div id="Gref" class="panel">
      <div class="content">
      <h2>Materiels reformé</h2>
      <table width="100%">
      <tr>
      
<td>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#000">
        <td><strong>Numero de serie </strong></td>
        
        
      
      </tr> <?php
         $res= mysql_query("select * from matreforme order by Nserie");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        
        
       

      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
      <!-- possibilité d'ajouter le materiel non deployé -->
</table>
    </div>
    </div>






       


		<!-- Header with Navigation -->
		<div id="header">
			<h1><a href="deco.php">Se Deconnecter</a>
				<!--L'id/nom dyal celui qui est co-->
			</h1>
			<ul id="navigation">
				<li><a><b><?php echo $_SESSION['email']?></b></a></li>
				<li><a id="link-Gstag" href="#Gstag">Gestion du materiel</a></li>
				<li><a id="link-Gabs" href="#Gabs">Deploiement </a></li>
				<li><a id="link-pres" href="#Gpan">Gestion Des pannes</a></li>
				<li><a id="link-pers" href="#Gpers">Gestion du personnel</a></li>
				<li><a id="link-dept" href="#Gdept">Gestion departements</a></li>
                <li><a id="link-rep" href="#Grep">Matos reparé</a></li>
				<li><a id="link-dt" href="#Gdt">Matos deployés</a></li>
				<li><a id="link-dt" href="#Gref">Matos reformé</a></li>
				
                <li><a id="link-Gcheck" href="#Gcheck"></a></li>
        

				
			</ul>
		</div>
	</body>
</html>
<!--AUTHOR ELATIF NABIL-->
