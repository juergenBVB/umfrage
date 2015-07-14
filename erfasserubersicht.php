<!-- Fragebogenübersicht -->
<table border="1">
  <tr>
    <th>Fragebogentitel</th>
    <th>bearbeiten</th>
    <th>kopieren</th>
    <th>auswerten</th>
    
  </tr>
  
<!-- Loop über Fragebögen -->
  <tr style="valign: middle;">
    <td>Testtitel</td>
    <td>
    	<form action="fragebogenbearbeiten.php" method="post">
    	<input type="hidden" name="fragebogentitel" value="Testtitel">    
    	<input type="submit" value="bearbeiten">
    	</form>
    </td>
  </tr>
<!-- Ende Loop -->  
  
</table>



<form action="neuerfragebogen.php" method="post">
<input type="submit" value="Neuer Fragebogen">

</form>