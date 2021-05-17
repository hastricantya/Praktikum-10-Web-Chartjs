<?php
// include file koneksi.php agar terkoneksi file index dengan database yang ada perintahnya di koneksi.php
include('koneksi.php');
//  membuat array $label yang berisi data bulan menjadi label
$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

// membuat looping  untuk bulan dari data penjualan
for($bulan = 1;$bulan < 13;$bulan++)
{
	// menghitung jumlah kolom jumlah dari tabel tb_penjualan
	$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where MONTH(tgl_penjualan)='$bulan'");
	// menyimpan hasil query
	$row = $query->fetch_array();
	// menyimpan data penjumlahan tiap bulan
	$jumlah_produk[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- title untuk judul jendela browser -->
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<!-- memanggil file chart.js -->
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<!-- memasukkan bentuk grafik -->
	<div style="width: 800px;height: 800px">
		<!-- untuk menggambar grafik bitmap secara interaktif dan mychart sebagai id dari object yang dibuat-->
		<canvas id="myChart"></canvas>
	</div>

	<!-- mychart sebagai id dari object yang dibuat -->
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				// untuk menulis label chart dan array nama produk untuk konversi array ke json
				labels: <?php echo json_encode($label); ?>,
				datasets: [{
					// array dengan nama label berisi daftar bulan dikoneversi menjadi json
					label: 'Grafik Penjualan',
					// konversi ke json untuk data array jumlahproduk
					data: <?php echo json_encode($jumlah_produk); ?>,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>