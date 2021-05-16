<?php
include('koneksi.php'); //koneksi ke database
$query = mysqli_query($koneksi,"select * from covid"); //mengambil data dari db
while($row = mysqli_fetch_array($query)){
	$country[] = $row['country'];
	$total_cases[] = $row['total_cases'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart Menggunakan Chartjs</title>
	<script type="text/javascript" src="Chart.js"></script> <!-- deklarasi penggunaan Chartjs -->
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($country); ?>,
				datasets: [{
					label: 'Grafik Total Cases Covid In 10 Country',
					data: <?php echo json_encode($total_cases); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 2
					//warna chart
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
 