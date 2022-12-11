<!DOCTYPE html>

<?php
    include("config/db_connect.php");

    session_start();
    $userID = unserialize($_SESSION['userID']);
    
    $sql = "SELECT * FROM cus_order WHERE CUS_ID=\"".$userID."\"";
    $result = $conn -> query($sql);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<html>
    <head>
        <title>Home</title>
        <?php include 'Temps/header.php'; ?>


        <h4 class="center grey-text">
            <?php 
                $name = unserialize($_SESSION['username']);
                if(substr($name, -1) == "s") {
                    echo $name."'"; 
                }
                else {
                    echo $name."'s"; 
                }
            ?> Orders
        </h4>

        <!-- <h4 class="center grey-text"> <?php echo unserialize($_SESSION['username'])."'s"; ?> Orders</h4> -->
        <div class="container">
            <div class="row">
                
                <?php $ctr = 0; foreach ($orders as $order ): $ctr++; ?>
                    
                    <div class="col s6 md3">
                        <div class="card z-depth-0">
                            <div class="card-content center">
                                <h6><?php echo htmlspecialchars("Order #".$order['ORDER_ID']) ?></h6>
                                <h6><?php echo htmlspecialchars("Placed on ".$order['ORDER_TIME']) ?></h6>
                                <div><?php echo htmlspecialchars($order['CUS_ADDRESS']) ?></div>
                                <div><?php echo htmlspecialchars($order['CUS_CONTACT_NO']) ?></div>
                                <ul>
                                    <?php foreach(explode(',', $order['ORDER_DETAILS']) as $ord): ?>

                                        <li><?php echo htmlspecialchars($ord); ?></li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="card-action right-algin">
                                <a class="brand-text" href="details.php?id=<?php echo $order['ORDER_ID'] ?>">more info</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?> 

            </div>
        </div>

    <?php include 'Temps/footer.php'; ?>
    
</html>
 
