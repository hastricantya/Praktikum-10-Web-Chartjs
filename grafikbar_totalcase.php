<?php
// include file koneksi.php agar terkoneksi file index dengan database yang ada perintahnya di koneksi2.php
include('koneksi2.php');
// mengambil data di tabel tb_country
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
// menghasilkan data dan data disimpan pada variabel row
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['country'];
	// menjumlah nilai pada kolom jumlah berdasar id_country
	$query = mysqli_query($koneksi,"SELECT totalcovid AS total FROM tb_covid WHERE id_country='".$row['id_country']."'");
	// variabel row menyimpan hasil query dalam bentuk array
	$row = $query->fetch_array();
	// array jumlah_produk untuk menyimpan data jumlah
	$total_cases[] = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- title untuk judul jendela browser -->
	<title>Bar Chart</title>
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
				// untuk menulis label chart dan array nama negara untuk konversi array ke json
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik Total Cases COVID-19',
					// konversi ke json untuk data array totalcovid
					data: <?php echo json_encode($total_cases); ?>,
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