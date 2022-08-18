<?php

session_start();


// database connection
require_once "connect.php";
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/global.css">
    <link rel="stylesheet" href="Styles/<?php echo $selected ?>.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .sub-menu-1 {
            display: none;
        }

        .test-menu:hover .sub-menu-1 {
            display: block;
            position: absolute;
            background-color: #F6F6F6;


        }

        .test-menu:hover .sub-menu-1 ul {
            display: block;
        }

        .test-menu:hover .sub-menu-1 {
            z-index: 1000;

        }

        .test-menu:hover .sub-menu-1 ul li {

            width: 166px;
            text-align: center;
            border-bottom: 1px solid #eee;
            color: #000 !important;
            padding: 20px;
        }

        .sub-menu-1 ul li a {
            color: #000 !important;
        }
    </style>

    </style>
    <?php
    $stmt = $con->prepare('select *  from settings where id=1');
    $stmt->execute();
    $stting = $stmt->fetch();

    ?>


    <link rel="shortcut icon" href="images/<?php echo $stting['logo'] ?> " type="image/x-icon">
    <title>RoyalRent™</title>
</head>

<body>

    <div class="navigation">
        <div class="nav-Content">
            <a href="index.php"><img class="Logo" src="images/<?php echo $stting['logo'] ?>" alt="Logo"></a>

            <ul class="nav-links" id="navLinks">
                <li><a <?php if ($selected == "index") {
                            echo "class='selected'";
                        } ?> href="index.php">Home</a></li>
                <li><a href="shop.php">Vehicles</a></li>
                <?php if (isset($_SESSION["user_id"]) && $_SESSION['role'] == 'users') { ?>

                    <li><a href="card.php">card</a></li>
                    <li class="test-menu"><a href="notification.php">notification
                            <?php
                            $stmt = $con->prepare('select  count(*) from notification where to_id=? and read_at is null');
                            $stmt->execute(array($_SESSION['user_id']));
                            $notification = $stmt->fetch();

                            if ($notification['count(*)'] > 0) {
                                echo "<span class='badge' style='
    margin-left: 53px;
    margin-top: 12px;'>" . $notification['count(*)'] . "</span>";
                            }
                            ?>
                        </a>
                        <div class="sub-menu-1">
                            <ul>
                                <?php
                                $stmt2 = $con->prepare('select  title from notification where to_id=? order by id desc');
                                $stmt2->execute(array($_SESSION['user_id']));
                                $notification2 = $stmt2->fetchAll();
                                foreach ($notification2 as $notification2) {

                                ?>
                                    <li><a href="notification.php"><?php echo $notification2['title'] ?></a></li>

                                <?php } ?>
                    </li>
            </ul>
        </div>

        </li>
    <?php }
                if (!isset($_SESSION['user_id']) ||    $_SESSION['role'] == 'users') {
    ?> <li><a href="contact.php">Contact</a></li>
    <?php } ?>
    <li><a href="about.php">About Us</a></li>


    <?php

    if (isset($_SESSION['user_id'])) {
        echo '
                    <li><a href="editprofile.php">editprofile</a></li>';
    }
    ?>
    <?php



    if (isset($_SESSION['user_id']) && $_SESSION['role'] != 'users') { ?> <li><a <?php if ($selected == "admin") {
                                                                                        echo "class='selected'";
                                                                                    } ?> href="admin/vehicles.php">Admin</a></li>
    <?php }
    ?>


    <li class="resp-col">
        <div class="res-Avatar" id="resAvatar">
            <img src="/images/defaultAvatar.png" class="Avatar-Logo" alt="Avatar-Logo">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<a href="editprofile.php">' . $user["username"] . '</a>';
                echo '<a href="../includes/logout.inc.php"><img class="logouticon" src="../images/logout.png"></a>';
            } else {
                echo '<a href="login.php">Log In</a>';
            }
            ?>
        </div>
    </li>
    </ul>

    <div class="Avatar">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo '        <img src="/images/defaultAvatar.png" class="Avatar-Logo" alt="Avatar-Logo">';

            echo '<a href="admin/editprofile">' . $_SESSION["name"] . '</a>';
            echo '<a href="logout.php">logout</a>';
        } else {
            echo '<a href="login.php">login</a>';
        }
        ?>
    </div>

    <div class="menu-icon" id="hamburger">
        <span class="line-1"></span>
        <span class="line-2"></span>
        <span class="line-3"></span>
    </div>
    </div>
    </div>