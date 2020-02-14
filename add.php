<?php
    include ("config/db_connect.php");

    $email = $title = $ingredients = "";

    $errors = array("email"=>"", "title"=>"", "ingredients"=>"");

    if(isset($_POST["submit"])){

        if(empty($_POST["email"])){
            $errors["email"]="An Email is required <br />";
        }else {
            $email = htmlspecialchars($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors["email"]="Please enter a valid email";
            }
        }

        if(empty($_POST["title"])){
            $errors["title"]="A Title is required <br />";
        }else {
            $title = htmlspecialchars($_POST["title"]);
            if(!preg_match("/^[a-zA-Z\s]+$/", $title)){
                $errors["title"]="Title must be letters and spaces only";
            }
        }

        if(empty($_POST["ingredients"])){
            $errors["ingredients"] = "Ingredients is required <br />";
        }else {
            $ingredients = htmlspecialchars($_POST["ingredients"]);
        }

        if(array_filter($errors)){
            echo "errors in the form";
        }else{
            $email = mysqli_real_escape_string($conn, $email);
            $title = mysqli_real_escape_string($conn, $title);
            $ingredients = mysqli_real_escape_string($conn, $ingredients);

            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES ('$title', '$email', '$ingredients')";

            if(mysqli_query($conn, $sql)){
                header("Location: index.php");
            }else{
                echo "error query: " . mysqli_error($conn);
            }
        }
    }

?>
<?php include "templates/header.php" ?>

    <section class="container grey-text">
        <h4 class="center">Add a pizza</h4>
        <form action="add.php" method="POST" class="white">
            <label for="">Your Email:</label>
            <input type="text" name="email" value="<?php echo $email ?>">
            <div class="red-text">
                <?php echo $errors["email"] ?>
            </div>
            <label for="">Pizza Title:</label>
            <input type="text" name="title" value="<?php echo $title ?>">
            <div class="red-text">
                <?php echo $errors["title"] ?>
            </div>
            <label for="">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo $ingredients ?>">
            <div class="red-text">
                <?php echo $errors["ingredients"] ?>
            </div>
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

<?php include "templates/footer.php" ?>

