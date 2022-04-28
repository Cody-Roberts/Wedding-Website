<?php
include_once("include/header.inc.php") 
?>

<?php
include_once("include/nav.inc.php") 
?>

<br><br><br><br>
<div class="container text-center">
  <section class="section-default">

    <h2>RSVP Form</h2>

    <form action="include/rsvp.inc.php" method="post">
      
      <label>First Name: </label><br>
      <input type="text" name="first"><br>

      <label>Last Name: </label><br>
      <input type="text" name="last"><br>  

      <label>Are you attending? </label><br>     
      <input type="radio" name="att" value="Yes">
      <label for="Yes">Yes</label><br>
      <input type="radio" name="att" value="No">
      <label for="No">No</label><br>
      
      <label>How many are attending? </label><br>
      <input type="num" name="numAtt"><br>
      
      <label>Song Recommendations: </label><br>
      <input type="text" name="song"><br><br>
      
      <button type="submit" name="rsvp-submit">Submit</button>
    </form> 

  </section>
</div><br><br><br><br><br><br>

</body>

<?php
include_once("include/footer.inc.php") 
?>

</html>

<?php
include_once("include/js.inc.php") 
?>