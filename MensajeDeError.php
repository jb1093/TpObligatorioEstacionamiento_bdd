  <h2 id="error"></h2>  
  <?php if(isset($_GET['error'])){?> 
    <script type="text/javascript">
      document.getElementById('error').innerHTML="<?php echo $_GET['error']; ?> ";
      setTimeout(function()
        { 
        document.getElementById('error').innerHTML="";
        }, 3000);
      //console.log("error");
    </script>
  <?php } else { ?> 
    <script type="text/javascript">
      document.getElementById('error').innerHTML="";                  
      //console.log("todo bien");  
    </script>                
  <?php } ?>
