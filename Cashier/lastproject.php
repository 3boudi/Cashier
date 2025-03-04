<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>CLINENT INFOMATION</title>
</head>
<body>
    <div class="container my-5"></div>
    <br>
    <h2>CACHIR</h2>
    <a class="btn btn-primary" href="creat.php">ADD NEW CLINENT</a>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>PRODUCTNAME</th>
                <th>BAR CODE</th>
                <th>UNIT PRICE</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'database.php';
                $conn = new mysqli($servername, $username, $password, $dbname);
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }

                $sql = "SELECT * FROM clients";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                            <td>".$row['productname']."</td>
                            <td>".$row['barcode']."</td>    
                            <td>".$row['unitprice']."</td>
                            <td>
                                <button class='btn btn-primary'>ADD</button>
                            </td>
                        </tr>";
                    }
                }
            ?>
        </tbody>
    </table>
   
</body>
</html>