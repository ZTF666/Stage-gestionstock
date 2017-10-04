<?php
		ini_set('display_errors','off');
      $con = mysql_connect('localhost','root','');
     mysql_select_db("gestionstock");   
     ?>
<!---PHP connection a la base de données MySQL --->

<html  >
<header>
<link rel="stylesheet" href="CssLogin.css">

</header>

<body id="">
		<div class="">
			<div class="">
				<form   action ="" method="POST" >
				
				<table >
					<tr><td><label for="Nom">Login</label></td><td>
					<input name="t1" type="text"  id="t1"/></td></tr>
					<tr><td><label for="prenom">Password</label></td><td>
					<input name="t2" type="password"  id="t2"/></td></tr>
                    
					<tr><td colspan="2"><CENTER><input name="b1" type="submit" value="Se connecter"  ></CENTER></td></tr>
                    <!--<input type="submit" value="LOG IN"/>-->
                    
					</table>
				</form>
			</div>
		</div>
	</body>
</html>


<?php
if (isset ($_POST['b1']))
      {
       $dr= mysql_query("select * from admin where Login='".$_POST['t1']."' and pwd='".$_POST['t2']."'");
 $ligne=mysql_fetch_array($dr);
 if($ligne!=0)
  {
    $_SESSION['email']=$_POST['t1'];

    
    header('location:index.php');
   
  }
  else
  {
    echo"<script language=\"javascript\">";
    echo "alert('Identifiant ou Mot de passe  invalide')";
    echo"</script>";
  }           
              }

 ?>
