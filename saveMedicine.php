<?php
session_start();
include("connect.php");
include("functions.php");

if (!isset($_SESSION['loggedIn'])) {
    header("location: login.php");
} else {
    if (isset($_POST["saveMedicine"])) {

        try {

            //record user_id into the database=drugs
            $user_id = $_SESSION["user_id"];
            //Pickup variables what ever the user enter into the html form 
            $medicineName = trim($_POST["medicine_name"]);
            $dosageQty = intval(trim($_POST["dosage_quantity"]));
            $dosageUnit = trim($_POST["dosage_unit"]);
            $milligramQty = intval(trim($_POST["milligram_quantity"]));
            $milligramUnit = trim($_POST["milligram_unit"]);
            $frequencyQty = intval(trim($_POST["frequency_quantity"]));
            $frequencyUnit = trim($_POST["frequency_unit"]);

                  
                       //input data into the medicine table in each field
            $query = "INSERT INTO medicine (medicine_name, dosage_quantity, dosage_unit, milligram_quantity, milligram_unit, frequency_quantity, frequency_unit, user_ID)
                VALUES (?,?,?,?,?,?,?,?);";

            if ($statement = $con->prepare($query)) {
                if ($statement->bind_param("sisisisi", $medicineName, $dosageQty, $dosageUnit, $milligramQty, $milligramUnit, $frequencyQty, $frequencyUnit, $user_id)) {

                    if ($statement->execute()) {
                        echo '<h4 class="text-success text-center">Medicine Added Successfully</h4>';
                    } else {
                        echo '<h4 class="text-danger text-center">Error Saving Medicine</h4>';
                    }
                } else {
                    echo '<h4 class="text-danger text-center">Oops!! Something went wrong</h4>';
                }
            } else {
                echo '<h4 class="text-danger text-center">Oops!! Something went wrong</h4>';
            }


        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}


?>

<?php set_header("Save New Medicine"); ?>
<div class="container">
    <div class="row mt-5">

        <div class="col-md-8 offset-md-2">
            <h5 class="display-5">Insert recent Medicine</h5>
            <a href="index.php" class="btn btn-info pill-right mb-4">See list of Medicines</a>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Input Medicine Name</label>
                    <input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Dosage Qty</label>
                    <input type="number" name="dosage_quantity" id="dosage_quantity" required class="form-control" min="1" max="250" value="1">
                </div>
                <div class="form-group">
                    <label for="">Dosage Unit</label>
                    <select name="dosage_unit" id="dosage_unit" class="form-select" required>
                        <option value="Tab" selected>Tablet</option>
                        <option value="Bottle">Bottle</option>
                        <option value="Injection">Input Injection</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Input Milligrams</label>
                    <input type="text" name="milligram_quantity" id="milligram" placeholder="Milligram" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Input Unit(g/mg)</label>
                    <select name="milligram_unit" id="unit" class="form-select" required>
                        <option value="Grams" selected>Grams</option>
                        <option value="MilliGrams">MilliGrams</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Input Frequency Qty</label>
                    <input type="number" name="frequency_quantity" id="frequency_quantity" placeholder="Frequency Quantity" required class="form-control" min="1" max="250" value="1">
                </div>

                <div class="form-group">
                    <label for="">Input Frequency Unit</label>
                    <select name="frequency_unit" id="frequency_unit" class="form-select">
                        <option value="Daily" selected>Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Montly">Monthly</option>
                    </select>
                </div>
                <input type="submit" name="saveMedicine" value="Save New Medicine" class="form-control btn btn-info btn-block my-3">
            </form>
            
        </div>
    </div>
</div>

<?php set_footer()?>