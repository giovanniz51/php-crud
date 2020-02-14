<?php
    include "config/db_connect.php";
    include ("templates/header.php");


    if(isset($_GET["id"])){
        $pizzaId = mysqli_real_escape_string($conn, $_GET["id"]);
        $sql = "SELECT * FROM pizzas WHERE id=$pizzaId";
        $result = mysqli_query($conn, $sql);
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

    if(isset($_POST["id_to_delete"])){
        $id=mysqli_real_escape_string($conn, $_POST["id_to_delete"]);
        $sql = "DELETE FROM pizzas WHERE id=$id";
        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
        }else{
            echo "query error " . mysqli_error($conn);
        }

    }
?>

    <div class="container center">
        <?php if($pizza): ?>
            <h4><?php echo htmlspecialchars($pizza["title"]) ?></h4>
            <p>Created by <?php htmlspecialchars($pizza["email"]) ?></p>
            <p><?php echo date($pizza["created_at"]) ?></p>
            <h5>Ingredients: <?php echo htmlspecialchars($pizza["ingredients"]) ?></h5>

            <form action="details.php" method="post">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza["id"] ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand">
            </form>
        <?php else: ?>
            <h4>No Pizza found!</h4>
        <?php endif; ?>
    </div>

<?php
    include "templates/footer.php";
?>
