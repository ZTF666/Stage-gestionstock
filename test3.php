<?php


ini_set('display_errors','off');
      $con = mysql_connect('localhost','root','');
     mysql_select_db("gestionstock");



if (isset ($_POST['winsert']))
      { 
        $x=$_POST[w1];
    
    $sql="select * from pannes where SerieM='$x'";
    
    
    if ($result = mysql_query($sql) && mysql_num_rows($result) > 0) {
    $querye="select Nbrpannes from pannes where SerieM=$x";
    $R=mysql_query($querye);
    
    $R=$R+1;
    $query=mysql_query("update pannes set Nbrpannes=$R");
    
} else {
        
    $R=0;
    
    $R=$R+1;
    $query=mysql_query("insert into pannes values('$_POST[w1]','$_POST[w2]',$R,'$_POST[w4]')");
    
}
   

    
    
}




?>






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
 <option value="Repare">Reparé</option>
            <option value="EnRepa">En reparation</option>
            <option value="Reforme">Reformé</option>

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
        <td><strong>Date achat</strong></td>
        <td><strong>Etat</strong></td>
        <td><strong>Nombre pannes</strong></td>
       
      </tr> <?php
         $res= mysql_query("select SerieM,datepanne,nbrpannes,etatmat from pannes  order by datepanne");
         while($ligne= mysql_fetch_array($res))
         {
         ?>
      <tr>
        <td><?php echo $ligne[0]  ?></td>
        <td><?php echo $ligne[1]  ?></td>
        <td><?php echo $ligne[3] ?></td>
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