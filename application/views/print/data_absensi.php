<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Data - Data Absensi!</title>
  <style>
    td,
    th {
      font-size: 10px;
    }
  </style>
</head>

<body>
  <h2 class="text-center">DATA ABSENSI</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal Masuk</th>
        <th>Kehadiran</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Jumlah kehadiran</th>
        <th>Tanggal Pembuatan</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1 ?>
      <?php foreach ($row->result() as $key => $value) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $value->pegawai_nama ?></td>
          <td><?= $value->tanggal_masuk ?></td>
          <td><?= $value->kehadiran  ?></td>
          <td><?= $value->jam_masuk ?></td>
          <td><?= $value->jam_keluar ?></td>
          <td><?= $value->jumlah_hadir  ?></td>
          <td><?= $value->date_created ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>