<?php
    session_start();
    require "connection.php";

    if(isset($_SESSION['logged_in']) == false) {
        header("Location: index.php");
    }

    if($_SESSION["role"] != "patient") {
        header("Location: back_to_home.php");
    }

    $id = $_SESSION["id"];
?>


<!DOCTYPE html>

<html lang="en">
    <head>
        <title>
            <?php
                $query = pg_query($db, "SELECT name FROM patients WHERE patient_id = $id");
                $row = pg_fetch_row($query);

                echo $row[0];
            ?>
        </title>
    </head>

    <body>

        <form name="form" action="patient_page.php">
            <p> <input type="button" onclick="window.location = 'lab_info.php';" name="visitLab" value="visit lab"/> </p>
            <p> <input type="button" onclick="window.location = 'test_info.php';" name="knowTest" value="know test"/> </p>
            <p> <input type="button" onclick="window.location = 'test_book.php';" name="bookTest" value="book test"/> </p>
            <br/>
            <p> <input type="button" onclick="window.location = 'logout.php';" name="logOut" value="log out"/> </p>
        </form>



    </body>
</html>

<?php
    pg_close($db)
?>