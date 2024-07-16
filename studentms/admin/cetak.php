<?php
include('includes/dbconnection.php');
$fdate = $_GET['fromdate'];
$tdate = $_GET['todate'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cetak Laporan</title>
  <!-- <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="./vendors/chartist/chartist.min.css"> -->
  <link rel="stylesheet" href="./css/style.css">
  <style>
    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h3 align="center" style="color:blue">Laporan Dari <?php echo $fdate ?> to <?php echo $tdate ?></h3>
    <div class="table-responsive border rounded p-1">
      <table class="table">
        <thead>
          <tr>
            <th class="font-weight-bold">S.No</th>
            <th class="font-weight-bold">Id Siswa</th>
            <th class="font-weight-bold">Kelas Siswa</th>
            <th class="font-weight-bold">Nama Siswa</th>
            <th class="font-weight-bold">Email Siswa</th>
            <th class="font-weight-bold">Tanggal Registrasi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT tblstudent.StuID, tblstudent.ID as sid, tblstudent.StudentName, tblstudent.StudentEmail, tblstudent.DateofAdmission, tblclass.ClassName, tblclass.Section 
                  FROM tblstudent 
                  JOIN tblclass ON tblclass.ID=tblstudent.StudentClass 
                  WHERE date(tblstudent.DateofAdmission) BETWEEN :fdate AND :tdate";
          $query = $dbh->prepare($sql);
          $query->bindParam(':fdate', $fdate, PDO::PARAM_STR);
          $query->bindParam(':tdate', $tdate, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $row) { ?>
              <tr>
                <td><?php echo htmlentities($cnt); ?></td>
                <td><?php echo htmlentities($row->StuID); ?></td>
                <td><?php echo htmlentities($row->ClassName); ?> <?php echo htmlentities($row->Section); ?></td>
                <td><?php echo htmlentities($row->StudentName); ?></td>
                <td><?php echo htmlentities($row->StudentEmail); ?></td>
                <td><?php echo htmlentities($row->DateofAdmission); ?></td>
              </tr>
          <?php $cnt = $cnt + 1;
            }
          } ?>
        </tbody>
      </table>
    </div>
    <div class="no-print">
      <button onclick="window.print()">Print Data</button>
      <button onclick="window.close()">Keluar</button>
    </div>
  </div>
<!-- 
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="./vendors/chart.js/Chart.min.js"></script>
  <script src="./vendors/moment/moment.min.js"></script>
  <script src="./vendors/daterangepicker/daterangepicker.js"></script>
  <script src="./vendors/chartist/chartist.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="./js/dashboard.js"></script> -->
</body>
</html>