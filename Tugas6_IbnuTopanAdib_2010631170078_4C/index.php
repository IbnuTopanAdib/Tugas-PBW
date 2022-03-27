<?php

$initial_airport = array(
    "Heathrow (LHR)" => 8.9,
    "Manchester Airport (MAN)" => 7.8,
    "Brimingham Airport (BHX)" => 8.4,
    "Oxford Airport (OXF)" => 8.8,
    "Cambridge Airport (CBG)" => 6.8,
    "Anglesey Airport (VLY)" => 9.0,
);
$final_airport = array(
    "liverpool Airport (LPL)" => 7.8,
    "Bristol Airport (BRS)" => 6.8,
    "Doncaster Airport (DSA)" => 7.7,
    "St. Haller Jersey (JER)" => 6.6,
    "Newcastle Airport (NCL)" => 6.8,
    "Edinburgh Airport (EDI)" => 9.0,
    
);

$airline = array(
    "Fox Air",
    "Squirrel Air",
    "Mouse Air",
    "Mamoth Air",
    "Bear Air",
    "Salmon Air",
);

$class = array(
    "Ekonomi",
    "Ekonomi Premium",
    "Bisnis",
    "First class",
);

function getInitialTax($initial_airport, $destination)
{
    $tax = $initial_airport[$destination];
    return $tax;
}
function getFinalTax($final_airport, $destination)
{
    $tax = $final_airport[$destination];
    return $tax;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Airport Registration</title>
</head>

<body>
    <section class="pemisah">
    <div class="container">
        <div class="image">
            <img src="assets/img/pramugari.png" alt="">
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Pendaftaran Rute Penerbangan</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <form action="" name="form" method="POST">
                    <label for="airline" class="form-label">Maskapai</label>
                    <select class="form-select mb-3" name="airline" id="airline">
                        <option selected>Pilih Maskapai</option>
                        <?php foreach ($airline as $airlines) : ?>
                            <option value="<?= $airlines ?>"><?= $airlines; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="initial" class="form-label">Bandara Asal</label>
                    <select class="form-select mb-3" name="initial" id="initial">
                        <option selected>Pilih Bandara</option>
                        <?php foreach ($initial_airport as $airport => $tax) : ?>
                            <option value="<?= $airport ?>"><?= $airport; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="final" class="form-label">Bandara Tujuan</label>
                    <select class="form-select mb-3" name="final" id="final">
                        <option selected>Pilih Bandara</option>
                        <?php foreach ($final_airport as $airport => $tax) : ?>
                            <option value="<?= $airport ?>"><?= $airport; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="class" class="form-label">Kelas</label>
                    <select class="form-select mb-3" name="class" id="class">
                        <option selected>Pilih kelas</option>
                        <?php foreach ($class as $classes) : ?>
                            <option value="<?= $classes ?>"><?= $classes; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mb-3">
                        <div class="btn-group form-control" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="rute" id="rute1" value="back" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="rute1">Sekali jalan</label>

                            <input type="radio" class="btn-check" name="rute" id="rute2" value="straight" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="rute2">Pulang-pergi</label>                
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="value" class="form-label">Harga Tiket (&#163)</label>
                        <input type="text" class="form-control" name="value" id="value">
                    </div>
                    <button class="btn btn-primary" name="submit" onClick="submitClick()">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    </section>

        <?php
        $file = 'data/data.json';
        $airline_data = array();

        $file_json = file_get_contents($file);

        $airline_data = json_decode($file_json, true);

        if (isset($_POST['submit'])) {
            $tax = getInitialTax($initial_airport, $_POST['initial']) + getFinalTax($final_airport, $_POST['final']);
            $keadaan = $_POST['rute'];
            if ($keadaan == "back" ){
                
                $total = 2*($tax + $_POST['value']);
                
            }
            else{
                $total = $tax + $_POST['value'];
            }

            $inputUser = array(
                "Airline" => $_POST['airline'],
                "Initial_airport" => $_POST['initial'],
                "Final_airport" => $_POST['final'],
                "Class" => $_POST['class'],
                "Ticket_price" => $_POST['value'],
                "Tax" => $tax,
                "Total_price" => $total
            );

            array_push($airline_data, $inputUser);

            $data_json = json_encode($airline_data, JSON_PRETTY_PRINT);
            file_put_contents($file, $data_json);
        }

        ?>

    <section class="pemisah">
    <div class="container mt-30">
        <div class="row d-flex justify-content-center">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">Maskapai</th>
                        <th scope="col">Asal Penerbangan</th>
                        <th scope="col">Tujuan Penerbangan</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Harga Tiket</th>
                        <th scope="col">Pajak</th>
                        <th scope="col">Total Harga Tiket(&#163)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($airline_data as $data => $value) : ?>
                        <tr>
                            <td><?= $airline_data[$data]['Airline']; ?></td>
                            <td><?= $airline_data[$data]['Initial_airport']; ?></td>
                            <td><?= $airline_data[$data]['Final_airport']; ?></td>
                            <td><?= $airline_data[$data]['Class']; ?></td>
                            <td><?= $airline_data[$data]['Ticket_price']; ?></td>
                            <td><?= $airline_data[$data]['Tax']; ?></td>
                            <td><?= $airline_data[$data]['Total_price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </section>

    <script>
        function submitClick(){
        alert("Terimakasih anda sudah terdaftar");
    }
    </script>          

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>