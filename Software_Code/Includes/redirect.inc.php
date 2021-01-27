<?php

session_start();

if(isset($_SESSION['USER_role']))
{
  switch ($_SESSION['USER_role'])
  {
    case 'Principal Researcher':
      header('Location:../welcome.php');
      break;
    case 'Co-Researcher':
		header('Location:../welcome.php');
		break;
    case 'Lab Manager':
		header('Location:../UserManagement/ViewUsers.php');
		break;
    default:
		header('Location:../login.php');
		break;
  }

  exit();

} else {
  header('Location:../login.php');
  exit();
}
?>
