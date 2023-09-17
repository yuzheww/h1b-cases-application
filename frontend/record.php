<!-- Name: Yuzhe Wang, Yan He, Yibo Yan
 db final project -->
<?php

if (isset($_POST['submit'])) {

  require_once("conn.php");

  $cnum = $_POST['cnum'];

  $query = "CALL queryNum(:cnum)";

  try {
    $prepared_stmt = $dbo->prepare($query);
    $prepared_stmt->bindValue(':cnum', $cnum, PDO::PARAM_STR);
    $prepared_stmt->execute();
    $result = $prepared_stmt->fetchAll();
  } catch (PDOException $ex) { // Error in database processing.
    echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
  }
}
?>
<?php
if (isset($_POST['submit2'])) {
  require_once("conn.php");
  $low = $_POST['low'];
  $high = $_POST['high'];

  $query = "CALL queryInterval(:low, :high)";

  try {
    $prepared_stmt = $dbo->prepare($query);
    $prepared_stmt->bindValue(':low', $low, PDO::PARAM_STR);
    $prepared_stmt->bindValue(':high', $high, PDO::PARAM_STR);
    $prepared_stmt->execute();
    $result = $prepared_stmt->fetchAll();
    echo "<script>alert('Searching!')</script>";
  } catch (PDOException $ex) { // Error in database processing.
    echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
  }
}
?>
<?php
if (isset($_POST['submit3'])) {
  require_once("conn.php");
  $stat = $_POST['stat'];

  $query = "CALL queryPercentage(:stat)";

  try {
    $prepared_stmt = $dbo->prepare($query);
    $prepared_stmt->bindValue(':stat', $stat, PDO::PARAM_STR);
    $prepared_stmt->execute();
    $result = $prepared_stmt->fetchAll();
  } catch (PDOException $ex) { // Error in database processing.
    echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
  }
}
?>
<?php
if (isset($_POST['submit4'])) {
  require_once("conn.php");
  $emp = $_POST['emp'];

  $query = "CALL queryEmployer(:emp)";

  try {
    $prepared_stmt = $dbo->prepare($query);
    $prepared_stmt->bindValue(':emp', $emp, PDO::PARAM_STR);
    $prepared_stmt->execute();
    $result = $prepared_stmt->fetchAll();
  } catch (PDOException $ex) { // Error in database processing.
    echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
  }
}
?>
<?php
if (isset($_POST['submit5'])) {
  require_once("conn.php");
  $att = $_POST['att'];

  $query = "CALL queryAttorney(:att)";

  try {
    $prepared_stmt = $dbo->prepare($query);
    $prepared_stmt->bindValue(':att', $att, PDO::PARAM_STR);
    $prepared_stmt->execute();
    $result = $prepared_stmt->fetchAll();
  } catch (PDOException $ex) { // Error in database processing.
    echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
  }
}
?>
<?php
if (isset($_POST['submit6'])) {
  require_once("conn.php");
  $state = $_POST['state'];

  $query = "CALL queryState(:state)";

  try {
    $prepared_stmt = $dbo->prepare($query);
    $prepared_stmt->bindValue(':state', $state, PDO::PARAM_STR);
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

<!-- here is main body statement -->

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

  <h1> Query a Case by case number</h1>
  <form method="post">

    <span for="cnum" ,div>Case Number(*):</span>
    <input type="text" name="cnum">
    <input type="submit" name="submit" value="Submit" class="btn">
  </form>
  <!--  the html and php here is to implement the button action for query case number -->
  <!--  the users are going to input case number. The server will return the information about that case number if it is valid. -->
  <?php
  if (isset($_POST['submit'])) {
    if ($result && $prepared_stmt->rowCount() > 0) { ?>
      <h2,div>Main Results</h2>
        <table>
          <thead>
            <tr>
              <th>Case Number</th>
              <th>Case Status</th>
              <th>Date Submitted</th>
              <th>Decision Date</th>
              <th>visa_class</th>
              <th>Employment Start Date</th>
              <th>Employment End Date</th>
              <th>Employer Name</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($result as $row) { ?>

              <tr>
                <td>
                  <div><?php echo $row["case_number"]; ?>
                </td>
                <td>
                  <div><?php echo $row["case_status"]; ?>
                </td>
                <td>
                  <div><?php echo $row["case_submitted"]; ?>
                </td>
                <td>
                  <div><?php echo $row["decision_date"]; ?>
                </td>
                <td>
                  <div><?php echo $row["visa_class"]; ?>
                </td>
                <td>
                  <div><?php echo $row["employment_start_date"]; ?>
                </td>
                <td>
                  <div><?php echo $row["employment_end_date"]; ?>
                </td>
                <td>
                  <div><?php echo $row["employer_name"]; ?>
                </td>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        Sorry No results found for <?php echo $_POST['cnum']; ?>.
    <?php }
  } ?>
    <!--  the html and php here is to implement the button action for query the wage interval -->
    <!--  the user will input two number for wage interval, the server will return the result after that -->
    <form method="post">

      <span for="low">Search total wage from </span>
      <input type="double" name="low">
      <span for="high"> to </span>
      <input type="double" name="high">
      <input type="submit" name="submit2" value="Submit" class="btn">
    </form>
    <?php
    if (isset($_POST['submit2'])) {
      if ($result && $prepared_stmt->rowCount() > 0) { ?>
        <h3>Here</h3>
        <table>
          <thead>
            <tr>
              <th>Case Number</th>
              <th>Case Status</th>
              <th>Job Title</th>
              <th>Total Wage</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $row) { ?>
              <tr>
                <td>
                  <div><?php echo $row["case_number"]; ?>
                </td>
                <td>
                  <div><?php echo $row["case_status"]; ?>//here receives the result returned by sql sps
                </td>
                <td>
                  <div><?php echo $row["job_title"]; ?>
                </td>
                <td>
                  <div><?php echo $row["total_wage"]; ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        Sorry No results found for the given range<?php echo $_POST['']; ?>.
    <?php }
    } ?>
    <!--  the html and php here is to implement the button action for query percentage on distribution of each type selected
    the user is going to select one of option in scroll bar. The server will return the total selected and proportion
    of selected type -->
    <form method="post">

      <span for="stat">Status of cases </span>
      <select id="stat" name="stat" size='1'>
        <option value="CERTIFIED-WITHDRAWN">CERTIFIED-WITHDRAWN</option>
        <option value="CERTIFIED">CERTIFIED</option>
        <option value="DENIED">DENIED</option>
        <option value="WITHDRAWN">WITHDRAWN</option>
        <option value="INPROGRESS">INPROGRESS</option>
      </select>
      <input type="submit" name="submit3" value="Submit" class="btn">
    </form>
    <?php
    if (isset($_POST['submit3'])) {
      if ($result && $prepared_stmt->rowCount() > 0) { ?>
        <h3>Result</h3>
        <table>
          <thead>
            <th>Selected Case Cumber</th>

            <th>Total Case Cumber</th>

            <th>Percentage</th>
          </thead>
          <tbody>
            <?php foreach ($result as $row) { ?>
              <tr>
                <td>
                  <div><?php echo $row["tot"]; ?>
                </td>
                <td>
                  <div><?php echo $row["total"]; ?>
                </td>
                <td>
                  <div><?php echo $row["res"]; ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        Sorry No results found for <?php echo $_POST['stat']; ?>.
    <?php }
    } ?>
    <!-- the html and php here is to implement the button action for query the employer by the name of employer -->
    <form method="post">

      <span for="emp">Search employer information by employer name </span>
      <input type="text" name="emp">
      <input type="submit" name="submit4" value="Submit" class="btn">
    </form>
    <?php
    if (isset($_POST['submit4'])) {
      if ($result && $prepared_stmt->rowCount() > 0) { ?>
        <h3>Here</h3>
        <table>
          <thead>
            <tr>
              <th>Employer Name</th>
              <th>City</th>
              <th>State Abbreviation</th>
              <th>State Fullname</th>
              <th>State and City</th>
              <th>Postal Code</th>
              <th>Country</th>
              <th>Phone Number</th>
              <th>NAIC Code</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $row) { ?>
              <tr>
                <td><?php echo $row["employer_name"]; ?></td>
                <td><?php echo $row["employer_city"]; ?></td>
                <td><?php echo $row["emp_state_abb"]; ?></td>
                <td><?php echo $row["emp_state_full"]; ?></td>
                <td><?php echo $row["emp_state_and_city"]; ?></td>
                <td><?php echo $row["employer_postal_code"]; ?></td>
                <td><?php echo $row["employer_country"]; ?></td>
                <td><?php echo $row["employer_phone"]; ?></td>
                <td><?php echo $row["naic_code"]; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        Sorry No results found for <?php echo $_POST['emp']; ?>.
    <?php }
    } ?>
    <!--  the html and php here is to implement the button action for query attorney agent by his/her name
    the user will input a name for attorney. The server will return from sql the result about that attorney if name is valid -->
    <form method="post">

      <span for="att">Search by attorney name </span>
      <input type="text" name="att">
      <input type="submit" name="submit5" value="Submit" class="btn">
    </form>
    <?php
    if (isset($_POST['submit5'])) {
      if ($result && $prepared_stmt->rowCount() > 0) { ?>
        <h3>Here</h3>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>City</th>
              <th>County</th>
              <th>Total Cases</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $row) { ?>
              <tr>
                <td><?php echo $row["agent_attorney_name"]; ?></td>
                <td><?php echo $row["agent_attorney_city"]; ?></td>
                <td><?php echo $row["agent_attorney_state"]; ?></td>

                <td><?php echo $row["cnt"]; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        Sorry No results found for <?php echo $_POST['att']; ?>.
    <?php }
    } ?>
    <!--  the html and php here is to implement the button action for query geographical distribution within a state
    the user is going to select a state of US. They will receive the number of registered applicant grouped by cities
    and also the count of applicants -->
    <form method="post">

      <span for="state">Search the number of applicants in a state</span>
      <select id="state" name="state" size='1'>
        <option value="AL">AL</option>
        <option value="AK">AK</option>
        <option value="AR">AR</option>
        <option value="AZ">AZ</option>
        <option value="CA">CA</option>
        <option value="CO">CO</option>
        <option value="CT">CT</option>
        <option value="DC">DC</option>
        <option value="DE">DE</option>
        <option value="FL">FL</option>
        <option value="GA">GA</option>
        <option value="HI">HI</option>
        <option value="IA">IA</option>
        <option value="ID">ID</option>
        <option value="IL">IL</option>
        <option value="IN">IN</option>
        <option value="KS">KS</option>
        <option value="KY">KY</option>
        <option value="LA">LA</option>
        <option value="MA">MA</option>
        <option value="MD">MD</option>
        <option value="ME">ME</option>
        <option value="MI">MI</option>
        <option value="MN">MN</option>
        <option value="MO">MO</option>
        <option value="MS">MS</option>
        <option value="MT">MT</option>
        <option value="NC">NC</option>
        <option value="NE">NE</option>
        <option value="NH">NH</option>
        <option value="NJ">NJ</option>
        <option value="NM">NM</option>
        <option value="NV">NV</option>
        <option value="NY">NY</option>
        <option value="ND">ND</option>
        <option value="OH">OH</option>
        <option value="OK">OK</option>
        <option value="OR">OR</option>
        <option value="PA">PA</option>
        <option value="RI">RI</option>
        <option value="SC">SC</option>
        <option value="SD">SD</option>
        <option value="TN">TN</option>
        <option value="TX">TX</option>
        <option value="UT">UT</option>
        <option value="VT">VT</option>
        <option value="VA">VA</option>
        <option value="WA">WA</option>
        <option value="WI">WI</option>
        <option value="WV">WV</option>
        <option value="WY">WY</option>
      </select>
      <input type="submit" name="submit6" value="Submit" class="btn">
    </form>
    <?php
    if (isset($_POST['submit6'])) {
      if ($result && $prepared_stmt->rowCount() > 0) { ?>
        <h3>Here</h3>
        <table>
          <thead>
            <tr>
              <th>City</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $row) { ?>
              <tr>
                <td><?php echo $row["worksite_county"]; ?></td> <!--  this receives the output from sql -->
                <td><?php echo $row["cnt"]; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        Sorry No results found for <?php echo $_POST['state']; ?>.
    <?php }
    } ?>
</body>

</html>