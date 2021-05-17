<?php
// include file koneksi.php agar terkoneksi file index dengan database yang ada perintahnya di koneksi.php
include('koneksi.php');
// mengambil data di tabel tb_barang
$produk = mysqli_query($koneksi,"select * from tb_barang");
// menghasilkan data dan data disimpan pada variabel row
while($row = mysqli_fetch_array($produk)){
	$nama_produk[] = $row['barang'];
	// menjumlah nilai pada kolom jumlah berdasar id_barang
	$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where id_barang='".$row['id_barang']."'");
	// variabel row menyimpan hasil query dalam bentuk array
	$row = $query->fetch_array();
	// array jumlah_produk untuk menyimpan data jumlah
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
		<!-- untuk menggambar grafik bitmap secara interaktif mychart sebagai id dari object yang dibuat-->
		<canvas id="myChart"></canvas>
	</div>

	<!-- mychart sebagai id dari object yang dibuat -->
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				// untuk menulis label chart dan array nama produk untuk konversi array ke json
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Grafik Penjualan',
					// konversi ke json untuk data array jumlahproduk
					data: <?php echo json_encode($jumlah_produk); ?>,
					// warna chart merah
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					// warna border
					borderColor: 'rgba(255,99,132,1)',
					// ketebalan border
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