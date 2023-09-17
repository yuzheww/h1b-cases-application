<!-- Name: Yuzhe Wang, Yan He, Yibo Yan
 db final project -->
<?php

if (isset($_POST['submit'])) {

  require_once("conn.php");

  $cnum = $_POST['cnum'];
  $cstatus = $_POST['cstatus'];
  $csub = $_POST['csub'];
  $cdeci = $_POST['cdeci'];

  $query = "CALL insertCase(:cnum, :cstatus, :csub, :cdeci)"; 
  // use insertCase to insert a new case with user specified information

  try {
    $prepared_stmt = $dbo->prepare($query);
    $prepared_stmt->bindValue(':cnum', $cnum, PDO::PARAM_STR);
    $prepared_stmt->bindValue(':cstatus', $cstatus, PDO::PARAM_STR);
    $prepared_stmt->bindValue(':csub', $csub, PDO::PARAM_STR);
    $prepared_stmt->bindValue(':cdeci', $cdeci, PDO::PARAM_STR);
    $prepared_stmt->execute();
    $result = $prepared_stmt->fetchAll();
  } catch (PDOException $ex) { // Error in database processing.
    echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
  }
}

?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <div id="navbar">
    <ul>
      <li><a href="index.html"> Home </a></li>
      <li><a href="record.php"> View Record </a></li>
      <li><a href="updateCase.php"> Update Application </a></li>
      <li><a href="insertCase.php"> Insert Application </a></li>
      <li><a href="deleteCase.php"> Delete Application </a></li>
    </ul>
  </div>

  <h1> Insert H1B Application </h1>

  <form method="post">
    <table>
      <tr>
        <!-- takes the case number from the user -->
        <td><span for="cnum">Case Number(*):</span>
          <input type="text" name="cnum" id="cnum" required></td>
        <!-- takes case status from the user -->
        <td><span for="cstatus">Case Status:</span><select id="cstatus" name="cstatus">
            <option value="WITHDRAWN">WITHDRAWN</option>
            <option value="CERTIFIED">CERTIFIED</option>
            <option value="DENIED">DENIED</option>
            <option value="CERTIFIED-WITHDRAWN">CERTIFIED-WITHDRAWN</option>
            <option value="INPROGRESS">INPROGRESS</option>
          </select></td>
      </tr>
      <tr>
        <!-- takes two dates from the user -->
        <td><span for="csub">Submission Date:</span>
          <input type="date" name="csub" id="csub"></td>
        <td><span for="cdeci">Decision Date:</span>
          <input type="date" name="cdeci" id="cdeci"></td>
      </tr>
    </table>
    <input type="submit" name="submit" value="Insert" class="btn">
  </form>


  <?php
  if (isset($_POST['submit'])) {
    if ($result && $prepared_stmt->rowCount() > 0) { ?>

      <h2>Status</h2>

      <table>
        <thead>
          <tr>
            <th>insert status</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($result as $row) { ?>

            <tr>
              <td><?php echo $row["msg"]; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    <?php } else { ?>
      Sorry No results found for <?php echo $_POST['cnum']; ?>.
  <?php }
  } ?>

</body>

</html>