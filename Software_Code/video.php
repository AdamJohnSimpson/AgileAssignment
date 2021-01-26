<!DOCTYPE html>
<html>
  <head>
    <title>Video Upload Test</title>
  </head>

  <body>
    <h1> Video Upload Test Page </h1>

    <form action="videoHandler.php" method="post" enctype="multipart/form-data">
    <label for="file"><span>Filename:</span></label>
    <input type="file" name="file" id="file" />

      <?php
      include "Includes/db.inc.php";
      $query = "SELECT experimentname FROM experiments";
      $result = mysqli_query($conn, $query);

      // echo "<table>
			// 	<tr>
			// 		<th>Experiments</th>
			// 	</tr>";

      echo "<select id='experiments' name='experiments'>";

      while($row = mysqli_fetch_array($result)){
        echo '<option value="$row[\'experimentname\']"> $row["experimentname"] </option>';
        // echo "<td>" . $row['experimentname'] . "</td>";
      }

      echo "</select>";
      // echo "</table>";

      ?>

    </select>
    <br />
    <input type="submit" name="submit" value="Submit" />
    </form>
  </body>

</html>
