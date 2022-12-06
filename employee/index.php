<?php 

   include('config/db_connect.php');

    // write query for all cus_order
    $sql = 'SELECT name, order_name, id, contact, address FROM cus_order ORDER BY ordered_time';

    //make query and get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as an array
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

 ?>

 <!DOCTYPE html>
 <html>
 
 	<?php include 'Temps/header.php'; ?>

    <h4 class="center grey-text">Orders!</h4>
    <div class="container">
        <div class="row">
            
            <?php foreach ($orders as $order ): ?>
                
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($order['name']) ?></h6>
                            <div><?php echo htmlspecialchars($order['contact']) ?></div>
                            <div><?php echo htmlspecialchars($order['address']) ?></div>
                            <ul>
                                <?php foreach(explode(',', $order['order_name']) as $ord): ?>

                                    <li><?php echo htmlspecialchars($ord); ?></li>

                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-algin">
                            <a class="brand-text" href="details.php?id=<?php echo $order['id'] ?>">more info</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?> 

        </div>
    </div>

 	<?php include 'Temps/footer.php'; ?>

 </html>