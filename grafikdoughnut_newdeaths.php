<?php
// include file koneksi.php agar terkoneksi file index dengan database yang ada perintahnya di koneksi2.php
include('koneksi2.php');
// mengambil data di tabel tb_country
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
// menghasilkan data dan data disimpan pada variabel row
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['country'];
	// menjumlah nilai pada kolom jumlah berdasar id_country
	$query = mysqli_query($koneksi,"SELECT newdeaths FROM tb_covid19 WHERE id_country='".$row['id_country']."'");
	// variabel row menyimpan hasil query dalam bentuk array
	$row = $query->fetch_array();
	// array jumlah_produk untuk menyimpan data jumlah
	$new_deaths[] = $row['newdeaths'];
}
?>
<html>

<head>
	<h2>Grafik Doughnut New Deaths</h2>
	<!-- title untuk judul jendela browser -->
	<title>Grafik Doughnut New Deaths</title>
	<!-- memanggil file chart.js -->
	<script type="text/javascript" src="Chart.js"></script>
</head>

<body>
	<!-- untuk menggambar grafik bitmap secara interaktif dan chart-area sebagai id dari object yang dibuat-->
	<div id="canvas-holder" style="width:50%">
		<canvas id="chart-area"></canvas>
	</div>
	<script>
		var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					label: 'Presentase Total Cases COVID-19',
					// konversi ke json untuk data array totalcases
					data:<?php echo json_encode($new_deaths); ?>,
					backgroundColor: [
					// warna chart tiap negara
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(0, 255, 254, 0.2)',
					'rgba(115, 255, 216, 0.2)',
					'rgba(210, 105, 30, 0.2)',
					'rgba(128, 0, 128, 0.2)',
					'rgba(0, 0, 205, 0.2)',
					'rgba(40, 178, 170, 0.2)'
					],
					// warna border tiap barang
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(0, 255, 254, 1)',
					'rgba(115, 255, 216, 1)',
					'rgba(210, 105, 30, 1)',
					'rgba(128, 0, 128, 1)',
					'rgba(0, 0, 205, 1)',
					'rgba(40, 178, 170, 1)'
					],
				}],
				// untuk menulis label chart dan array nama produk untuk konversi array ke json
				labels: <?php echo json_encode($country_name); ?>},
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