<?php
session_start();
include_once('../function/reportFunction.php');

$type = $_GET['type'];

$report = new Report();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report</title>

    <style>
        body{
            font-family: Arial;
            padding: 20px;
        }

        .report-box{
            width: 210mm;
            min-height: 297mm;
            margin: auto;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th, td{
            border: 1px solid #000;
            padding: 5px;
            font-size: 12px;
        }

        .print-btn{
            margin-bottom: 10px;
        }

        @media print {
            .print-btn{
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="report-box">

    <button class="print-btn" onclick="window.print()">Print</button>

    <h2><?php echo strtoupper($type); ?> REPORT</h2>
    <p>Print Date: <?php echo date("Y-m-d H:i"); ?></p>

    <table>
        <thead>
            <?php $report->getHeaders($type); ?>
        </thead>
        <tbody>
            <?php $report->getData($type); ?>
        </tbody>
    </table>

</div>

</body>
</html>