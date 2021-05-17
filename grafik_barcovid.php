<?php
// include file koneksi.php agar terkoneksi file index dengan database yang ada perintahnya di koneksi2.php
include('koneksi2.php');
// mengambil data di tabel tb_country
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
// menghasilkan data dan data disimpan pada variabel row
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['country'];
	// menjumlah nilai pada kolom jumlah berdasar id_country
	$query = mysqli_query($koneksi,"SELECT newcases, totaldeaths, newdeaths, totalrecovered, activecase FROM tb_covid19 WHERE id_country='".$row['id_country']."'");
	// variabel row menyimpan hasil query dalam bentuk array
	$row = $query->fetch_array();
	// array jumlah_produk untuk menyimpan data jumlah
	$new_cases[] = $row['newcases'];
	$total_deaths[] = $row['totaldeaths'];
	$new_deaths[] = $row['newdeaths'];
	$total_recovered[] = $row['totalrecovered'];
	$active_case[] = $row['activecase'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- heading 2 untuk menulis kalimat -->
	<h2>Grafik Bar Chart COVID-19</h2>
	<!-- title untuk judul jendela browser -->
	<title>Grafik Bar Chart COVID-19</title>
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
					label: 'New Case',
					// konversi ke json untuk data array newcase
					data: <?php echo json_encode($new_cases); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255, 99, 132, 1)',
					borderWidth: 1
					},{
					label: 'Total Deaths',
					// konversi ke json untuk data array totaldeaths	
					data: <?php echo json_encode($total_deaths); ?>,
					// warna chart
					backgroundColor: 'rgba(54, 162, 235, 0.2)',
					// warna border
					borderColor: 'rgba(54, 162, 235, 1)',
					// ketebalan border
					borderWidth: 1
					},{
					// konversi ke json untuk data array newdeaths
					label: 'New Deaths',	
					data: <?php echo json_encode($new_deaths); ?>,
					// warna chart
					backgroundColor: 'rgba(255, 206, 86, 0.2)',
					// warna border
					borderColor: 'rgba(255, 206, 86, 1)',
					// ketebalan border
					borderWidth: 1
					},{
					label: 'Total Recovered',	
					// konversi ke json untuk data array totalrecovered
					data: <?php echo json_encode($total_recovered); ?>,
					// warna chart
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					// warna border
					borderColor: 'rgba(75, 192, 192, 1)',
					// ketebalan border
					borderWidth: 1
					},{
					label: 'Active Case',
					// konversi ke json untuk data array activecase	
					data: <?php echo json_encode($active_case); ?>,
					// warna chart
					backgroundColor: 'rgba(210, 105, 30, 0.2)',
					// warna border
					borderColor: 'rgba(210, 105, 30, 1)',
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