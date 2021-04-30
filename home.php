<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
<h1>Welcome to Aston Animal Sanctuary!</h1>
<h2><u>Animals available for adoption</u></h2>
<table cellspacing="0" cellpadding="5">
    <tr>
        <th>Animal ID</th>
        <th>Animals name</th>
        <th>Date Of Birth</th>
        <th>Description</th>
        <th>Picture</th>
        <th>Adopted username</th>
        <th>
    </tr>
    <?php
    include("php/session_handler.php");
    if (!isLoggedIn()) {
        header("Location: /login.html");
        exit;
    }
    $username = $_SESSION["username"];
    include("php/connectdb.php");
    $db = connectDb();

    $stm = $db->prepare("SELECT * FROM `animals` WHERE `adopted_username` IS NULL");
    $stm->execute();
    foreach ($stm as $row) {
        echo "<tr><td >" . $row['animal_ID'] . "</td><td >" . $row['animal_name'] . "</td><td >" . $row['date_of_birth'];
        echo "</td><td >" . $row['description'] . "</td><td >" . "<a href='home.php'>Click here!</a>" . "</td><td >" . $row['adopted_username'] . "</td><td>" . "<button onclick='addAdoptRequest(" . $row['animal_ID'] . ")'>Adopt</button> </td></tr>\n";
    }
    ?>
</table>
<h2><u>My adoption requests</u></h2>
<table cellspacing="0" cellpadding="5">
    <tr>
        <th>Animal ID</th>
        <th>Username</th>
        <th>Adoption Status</th>

        <?php
        $stm = $db->prepare("SELECT * FROM `adoption_requests` WHERE `username`=?");
        $stm->execute(array($username));
        foreach ($stm as $row) {
            $animal_id = $row["animal_ID"];
            $username = $row["username"];
            $adoption_status = $row["adoption_status"];

            echo "<tr><td> $animal_id </td><td> $username </td><td> $adoption_status </td><td>";
        }
        ?>
    </tr>
</table>
<br><a href="login.html">
    <button type="button">Sign out</button>
</a>
<script>
    function addAdoptRequest(ID) {
        const request = new XMLHttpRequest()
        request.open(
            "POST",
            "http://localhost/php/adoption_requests/submit.php"
        )
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("animal_ID=" + ID)
    }
</script>
</body>
</html>

