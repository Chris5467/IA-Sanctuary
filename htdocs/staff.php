<!DOCTYPE html>
<html>
<head>
    <title>Staff</title>
</head>
<body>
<?php
include("php/session_handler.php");

if (!isLoggedInAsStaff()) {
    header("Location: /login.html");
    exit;
}
?>
<h1>Aston animal sanctuary staff page</h1>

<h2><u>Pending adoption requests</u></h2>

<table cellspacing="0" cellpadding="5">
    <tr>
        <th>Animal ID</th>
        <th>Username</th>
        <th>Adoption Status</th>

        <?php
        include("php/connectdb.php");
        $db = connectDb();

        $stm = $db->prepare("SELECT * FROM `adoption_requests` WHERE `adoption_status`=\"PENDING\"");
        $stm->execute();
        foreach ($stm as $row) {
            $animal_id = $row["animal_ID"];
            $username = $row["username"];
            $adoption_status = $row["adoption_status"];

            echo "<tr><td> $animal_id </td><td> $username </td><td> $adoption_status </td><td>";
            echo "<button onclick='acceptAdoptRequest(\"$username\", $animal_id)'>Accept</button> </td><td>";
            echo "<button onclick='denyAdoptRequest(\"$username\", $animal_id)'>Deny</button> </td></tr>\n";
        }
        ?>
    </tr>
</table>

<h2><u>Decided adoption requests</u></h2>

<table cellspacing="0" cellpadding="5">
    <tr>
        <th>Animal ID</th>
        <th>Username</th>
        <th>Adoption Status</th>

        <?php
        $stm = $db->prepare("SELECT * FROM `adoption_requests` WHERE `adoption_status`=\"ACCEPTED\" OR `adoption_status`=\"DENIED\"");
        $stm->execute();
        foreach ($stm as $row) {
            $animal_id = $row["animal_ID"];
            $username = $row["username"];
            $adoption_status = $row["adoption_status"];

            echo "<tr><td> $animal_id </td><td> $username </td><td> $adoption_status </td><td>";
        }
        ?>
    </tr>
</table>

<h2><u>Animals</u></h2>

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
    $stm = $db->prepare("SELECT * FROM `animals`");
    $stm->execute();
    foreach ($stm as $row) {
        echo "<tr><td >" . $row['animal_ID'] . "</td><td >" . $row['animal_name'] . "</td><td >" . $row['date_of_birth'];
        echo "</td><td >" . $row['description'] . "</td><td >" . $row['picture'] . "</td><td >" . $row['adopted_username'] . "</td></tr>\n";
    }
    ?>
</table>

<?php
echo "<br><button onclick='addAnimalButton()'>Add Animal</button>";
?>

<br><br><a href="login.html">
    <button type="button">Sign out</button>
</a>

<script>
    function acceptAdoptRequest(username, ID) {
        const request = new XMLHttpRequest()
        request.open(
            "POST",
            "http://localhost/php/adoption_requests/accept.php"
        )
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("animal_ID=" + ID + "&username=" + username)
    }

    function denyAdoptRequest(username, ID) {
        const request = new XMLHttpRequest()
        request.open(
            "POST",
            "http://localhost/php/adoption_requests/deny.php"
        )
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("animal_ID=" + ID + "&username=" + username)
    }

    function addAnimalButton() {
        const request = new XMLHttpRequest()
        request.onreadystatechange = function () {
            if (this.readyState === 4) {
                window.location.href = "/add_animal.html"
            }
        }
        request.open(
            "POST",
            "http://localhost/add_animal.html"
        )
        request.send()
    }

</script>

</body>
</html>

