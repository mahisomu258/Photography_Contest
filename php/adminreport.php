<?php
include("connect.php");
include("adminsession.php");
$AdminID = $_SESSION['adminID'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Statistic report</title>
    <style>
        .chartBox {
            width: 300px;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/report.css">
</head>

<body style="background-image:url('../image/bg.gif');font-family:Old Standard TT, serif;">
    <div class="topnav">
        <a href="logout.php">Logout</a>
        <a href="adminhome.php">Winner</a>
        <a class="active" href="adminhome.php">Home</a>
        <p style="float: left;">PIXELS</p>

    </div>
    <a href="adminhome.php">
        <button class="button button1">BACK</button>
    </a>

    <h1 style="margin: 50px;font-size: 50px; border: 2px solid black; height: 100 px;text-align:center;background:white">Statistic Report</h1>
    <?php
    $fetchData = mysqli_query($con, "SELECT * FROM competition WHERE CompetitionID = " . $_GET['CompID']);
    while ($row = mysqli_fetch_assoc($fetchData)) {

        $displayData = '
			<p style="margin: auto;font-size: 30px; border:none; height:50 px; width: 500px; text-align:center;background-color:transparent; ">
            Competition Title:<input type="text" value = "' . $row["CompetitionTitle"] . '" name="title" size="30" maxlength="60" style="border-style: none none solid none; background-color:transparent;font-size:24px; text-align:center" readonly/></p>';
        echo $displayData;
    }
    ?>
    <br>
    <div style="position:relative;margin:auto;display:flex;flex-direction:column;justify-content:center;align-items:center;">

        <div style="display:inline-block">
            <p style="float:left;font-weight:bold">Total Number of Participant :</p>
            <p style="float:left;border:1px solid black;background:white;width:100px;height:30px;margin-left:2px;padding:2px" id="total"></p>
        </div>
        <br>


        <!--Number of Content Approved-->
        <?php
        $query = "SELECT COUNT(vcontentID) AS 'Total'
          FROM verifycontent
          WHERE vcompetitionID = " . $_GET['CompID'];
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {        //fetching each row of result
                $display_Data = '
                    <div>
                    <b>Number of Content Approved: </b><input style="width:93px" type="text" value = "' . $row['Total'] . '" id="num1" readonly>
                    </div>
                    <br>
                    ';
                echo $display_Data;
            }
        }
        ?>

        <!--Number of Content Rejected-->

        <?php
        $query = "SELECT COUNT(rcontentID) AS 'Total', rcontentTitle 
           FROM rejectedcontent 
           WHERE rcompetitionID = " . mysqli_real_escape_string($con, $_GET['CompID']) . "
           GROUP BY rcontentTitle";                                                           // all the rows with same rcontenttitle is grouped together                                                   
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $display_Data = '
                    <div>
                    <b>Number of Content Rejected   :</b> <input style="width:98px" type="text" value = "' . $row['Total'] . '" id="num2" readonly>
                    </div>
                    <br>
                    ';
                echo $display_Data;
            }
        }
        ?>
    </div>

    <!--Php for Statistical Chart-->

    <?php
    $run = mysqli_real_escape_string($con, $_GET['CompID']);
    $query = $con->query("SELECT COUNT(Customer_ID) AS 'mon', vcontentID FROM voting WHERE vcompetitionID ='$run' GROUP BY vcontentID");

    foreach ($query as $data) {
        $x[] = $data['vcontentID'];
        $y[] = $data['mon'];        //mon = counts of votes
    }
    ?>
    <!--Php for Commend Chart-->

    <?php
    $run = mysqli_real_escape_string($con, $_GET['CompID']);
    $query = $con->query("SELECT COUNT(contentcomment) AS 'conTotal', vcID  FROM contentcomment WHERE compID ='$run' GROUP BY vcID");

    foreach ($query as $data_1) {

        $_id[] = $data_1['vcID'];
        $conTotal[] = $data_1['conTotal'];
    }

    ?>



        <?php
        $query = "SELECT COUNT(ContentID) AS 'Total', ContentTitle FROM content";
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $display_Data = '

                    <div>
                    <b>Total Number of Participant: </b><input type="text" value = "' . $row['Total'] . '" name="ContentTitle" readonly>
                    </div>

                    <div>
                    <b>Number of Content Approved: </b><input type = "text">
                    </div>

                    <div>
                    <b>Number of Content Rejected:</b> <input type = "text">
                    </div>

                ';
                echo $display_Data;
            }
        }
        ?>


        </div>

    <div class="baise flex-container column" style="width: 60%;margin:auto">
        <!--Statistic report Area-->
        <div class="title" style="width:100%">
            <canvas id="voteChart"></canvas>
            <p>x-axis:Content ID;y-axis:Total votes</p>
        </div>

        <!--Statistical Commend A-->
        <div class="title" style="width:100%">
            <canvas id="commentChart"></canvas>
            <p>x-axis:Content ID;y-axis:Total comments</p>
        </div>

        <h3 style="margin:auto">Reference Table</h3>

        <!--Reference Table-->
        <?php
        $fetchData = mysqli_query($con, "SELECT * FROM verifycontent WHERE vcompetitionID =" . $_GET['CompID']);
        while ($row = mysqli_fetch_assoc($fetchData)) {

            $disData = '
                    <div style="border: 1px solid black;width:100%">
                        <p>This Tab Should list every Content ID and The Title And The Participant</p>
                        <b>Content ID: </b><input style="border:none;background:transparent" type="text" value="' . $row["vcontentID"] . '"><br>
                        <b>Content Tilte: </b> <input style="border:none;background:transparent" type="text" value="' . $row["vcontentTitle"] . '"><br>
                        <b>Participant Name: </b> <input style="border:none;background:transparent" type="text" value="' . $row["ParticipantName"] . '"><br>
                    </div>      
                    ';
            echo $disData;
        }
        ?>
    </div>
    </div>
    <!-- footer -->
    <div class="footer column" style="font-size:14px;margin-top:100px">
        <div class="flex-container" style="align-items:center; justify-content:center; text-align:left">
        <div style="padding-top:20px">
				<img class="logo" style="width:120px; height:100px" src="https://t3.ftcdn.net/jpg/05/00/09/00/360_F_500090048_Vwr47TpMANq2xG8YHmOo4mFtw0PPkXAt.jpg"></br></br>
			</div>
			<div>
            <p><b>PIXELS</b></p>
            SRM university, </br>
            neerukonda,</br>
            guntur,andhrapradesh</br>
          </div></br>
    </div></br>

    <!--Statistically Report creating a bar chart using the Chart.js library.-->
    <script>
        var xx = document.getElementById("num1").value;                 //count of votes
        var yy = document.getElementById("num2").value;                 //comments
        document.getElementById("total").innerHTML = parseInt(xx) + parseInt(yy);


        const labels = <?php echo json_encode($x) ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Votes Report',
                data: <?php echo json_encode($y) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        const voteChart = new Chart(
            document.getElementById('voteChart'),
            config
        );

        // comment Statistic
        // data of Comment chart
        const comlab = <?php echo json_encode($_id) ?>;
        const dataCom = {
            labels: comlab,
            datasets: [{
                label: 'Comment Report',
                data: <?php echo json_encode($conTotal) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };
        // config commendReport

        const configCom = {
            type: 'bar',
            data: dataCom,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
        // render comment report
        const commentChart = new Chart(
            document.getElementById('commentChart'),
            configCom
        );
    </script>
</body>

</html>