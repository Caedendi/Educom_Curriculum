<?php
function showLogoutContent($data) {
  echo '
    <p>Logout page.</p>
    <p>You have been logged out.</p>
  ';
  session_destroy();
}
?>
