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
<!doctype html>
<html>

<head>
	<!-- title untuk judul jendela browser -->
	<title>Pie Chart</title>
	<!-- memanggil file chart.js -->
	<script type="text/javascript" src="Chart.js"></script>
</head>

<body>
	<!-- memasukkan bentuk grafik -->
	<div id="canvas-holder" style="width:50%">
		<!-- untuk menggambar grafik bitmap secara interaktif dan chart-area sebagai id dari object yang dibuat-->
		<canvas id="chart-area"></canvas>
	</div>
	<script>
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					// konversi ke json untuk data array jumlahproduk
					data:<?php echo json_encode($jumlah_produk); ?>,
					// warna chart tiap barang
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
					// warna border tiap barang
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					label: 'Presentase Penjualan Barang'
				}],
				// untuk menulis label chart dan array nama produk untuk konversi array ke json
				labels: <?php echo json_encode($nama_produk); ?>},
			options: {
				responsive: true
			}
		};
		// membuat web interaktif
		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body>

</html>
