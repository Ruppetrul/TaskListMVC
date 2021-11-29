<?php
echo '
<form action="/index.php?controller=user_controller&method=logout" method="POST">
  <a>Welcome, '.htmlspecialchars($username).'</a> 
  <input style="text-align: right;" type="submit" name="EXIT" value="EXIT"> 
</form>
<br>
';