<?php
include('koneksi.php'); //koneksi ke database
$cases = mysqli_query($koneksi,"select * from covid"); //mengambil data dari db
while($row = mysqli_fetch_array($cases)){
	$negara[] = $row['country'];
	$query = mysqli_query($koneksi,"SELECT sum(total_cases) as total_cases from covid where id ='".$row['id']."'");
	$row = $query->fetch_array();
	$jumlah_cases[] = $row['total_cases'];
}
?>
<!doctype html>
<html>
 
<head>
	<title>Pie Chart</title>
	<script type="text/javascript" src="Chart.js"></script> <!-- deklarasi penggunaan Chartjs -->
</head>
 
<body>
	<div id="canvas-holder" style="width:50%">
		<canvas id="chart-area"></canvas>
	</div>
	<script>
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data:<?php echo json_encode($jumlah_cases); ?>,
					backgroundColor: [ //warna chart
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgb(0, 255, 0)',
					'rgb(51, 102, 204)',
					'rgb(255, 204, 0)',
					'rgb(191, 0, 255)',
					'rgb(255, 0, 255)',
					'rgb(0, 255, 255)'

					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'#008000',
					'#000033',
					'#665200',
					'#cc0099',
					'#e60099',
					'#00e6e6'
					],
					label: 'Presentase Penderita Covid'
				}],
				labels: <?php echo json_encode($negara); ?>},
			options: {
				responsive: true
			}
		};
 
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