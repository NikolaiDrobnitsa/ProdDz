<html>
<head>
    <title>Apple</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <form class="input_container" method='post'>
        <div class="container text-center mt-2 ">
            <div class="text-start">

                <h2>Admin panel</h2>

                <h5 >Add Product</h5>


            </div>
            <div class="row justify-content-md-center mb-3">

                <div class="col col-lg">
                    <input type="text" class="form-control" id="SearchProd" name="add_name" placeholder="Name" value="">
                </div>
                <div class="col col-lg">
                    <input type="text" class="form-control" id="SearchProd" name="add_price" placeholder="Price" value="">
                </div>
                <div class="col col-lg">
                    <input type="text" class="form-control" id="SearchProd" name="add_amount" placeholder="Amount" value="">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-success " id="Add_btn" name="add_prod">Adds </button>
                    <a href="index.php" class="btn btn-info" id="Exit_btn" >Exit </a>
                </div>

            </div>
    </form>
    <?php


    $conn = new mysqli("localhost", "root", "", "tets_bd");
    if($conn->connect_error){
        echo 'ERROR';
    }
    else {
//        echo 'Access';


        if (isset($_POST['delete_btn'])){
                $delete = 'DELETE FROM product WHERE id='.(int)$_POST['delete_btn'];
                $result = $conn->query($delete);
                if (!$result){
                    echo 'ERROR';
                }
        }


    if (isset($_POST['add_prod'])){
        if (isset($_POST['add_name'])!= "" && isset($_POST['add_price'])!= "" && isset($_POST['add_amount'])!= ""){

                $name = $_POST['add_name'];
                $price = $_POST['add_price'];
                $amount = $_POST['add_amount'];

                $data = 'INSERT INTO `product`(`name`, `price`, `amount`) VALUES ("'.$name.'" , "'.$price.'", "'.$amount.'")';
                if($conn->query($data)){
                    echo "<p>Data added!</p>";
                }
                else{
                    echo "<p>Data not added!</p>";
                }


        }
    }

        $sql_code = "SELECT * FROM `product`;";
        if($results = $conn->query($sql_code)) {
            echo "<table class='table' id='ProdTable' >";
            echo "<thead class='thead-light table-dark'>";


            echo "<tr>";
            echo  "<th scope='col' >Id</th>";
            echo  "<th scope='col' >Name</th>";
            echo  "<th scope='col'>Price</th>";
            echo  "<th scope='col' >Amount</th>";
            echo  "<th scope='col' >Delete</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($results as $res){

                echo '<tr >';
                echo '<th scope="row" >'.$res["id"].'</th>';
                echo  '<td>'.$res["name"].'</td>';
                echo  '<td>'.$res["price"].'</td>';
                echo  '<td>'.$res["amount"].'</td>';
                echo  "<td><button type= 'submit' class='btn btn-danger' name='delete_btn' value='{$res["id"]}' >X</td>";

                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            $results->free();

        }
        else {
            echo '<p>Data NOT selected!</p>';
        }

        $conn->close();
    }

    ?>
</div>
</body>
</html>
