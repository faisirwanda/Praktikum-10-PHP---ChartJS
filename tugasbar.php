<?php
include('koneksi.php'); //koneksi ke database
$query = mysqli_query($koneksi,"select * from covid"); //mengambil data dari db
while($row = mysqli_fetch_array($query)){
	$country[] = $row['country'];
	$total_cases = $row['total_cases'];
	$new_cases[] = $row['new_cases'];
	$total_deaths[] = $row['total_deaths'];
	$new_deaths[] = $row['new_deaths'];
	$total_recovered[] = $row['total_recovered'];
	$active_cases[] = $row['active_cases'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart New Cases</title>
	<script type="text/javascript" src="Chart.js"></script> <!-- deklarasi penggunaan Chartjs -->
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>


	<!-- bar chart new cases -->
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($country); ?>,
				datasets: [ //warna chart

				{
					label: 'Total Cases',
					data: <?php echo json_encode($total_cases); ?>,
					backgroundColor: 'rgba(181, 54, 35, 1)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1 //ketebalan chart
				},
				{
					label: 'New Cases',
					data: <?php echo json_encode($new_cases); ?>,
					backgroundColor: 'rgba(255, 99, 132, 1)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				},
				{
					label: 'Total Deaths',
					data: <?php echo json_encode($total_deaths); ?>,
					backgroundColor: 'rgba(66, 135, 245, 1)',
					borderColor: 'rgba(66, 135, 245,1)',
					borderWidth: 1
				},
				{
					label: 'New Deaths',
					data: <?php echo json_encode($new_deaths); ?>,
					backgroundColor: 'rgba(247, 152, 35, 1)',
					borderColor: 'rgba(247, 152, 35,1)',
					borderWidth: 1
				},
				{
					label: 'Total Recovered',
					data: <?php echo json_encode($total_recovered); ?>,
					backgroundColor: 'rgba(0, 255, 0, 1)',
					borderColor: 'rgba(133, 245, 29,1)',
					borderWidth: 1
				},
				{
					label: 'Active Cases',
					data: <?php echo json_encode($active_cases); ?>,
					backgroundColor: 'rgba(0, 247, 255, 1)',
					borderColor: 'rgba(0, 247, 255,1)',
					borderWidth: 1
				},
				]
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