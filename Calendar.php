<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style type="text/css">
		table
		{
			border-collapse: collapse;
			width: 800px;
		}
	</style>
</head>
<body>
	<?php
		$Select_Y=0;
		$Select_M=0;
		if(isset($_POST["Select_Year"]))
			$Select_Y=$_POST["Select_Year"];
		if(isset($_POST["Select_Month"]))
			$Select_M=$_POST["Select_Month"];			
	?>
	<form action="" method="post">
		<table border="1" align="center">
			<tr align="center" height="40">
				<td colspan="7">
					<select name="Select_Year">
						<?php
							for($i=1920;$i<=2023;$i++)
							{
								echo "<option ";
								if($Select_Y==$i)
									echo "selected";
								echo ">".$i."</option>";
							}
						?>
					</select>
					<select name="Select_Month">
						<?php
							for($i=1;$i<=12;$i++)
							{
								echo "<option ";
								if($Select_M==$i)
									echo "selected";
								echo ">".$i."</option>";
							}
						?>
					</select>
					<input type="submit" value="顯示" name="Show">
				</td>
			</tr>
			<?php if(isset($_POST["Show"])){?>
				<tr align="center" height="40">
					<th colspan="7">
						<?php
							$m=date("m",mktime(0,0,0,$Select_M,1,$Select_Y));
							echo $Select_Y." 年 ".$m." 月萬年曆";
						?>
					</th>
				</tr>
				<tr align="center" height="40";>
					<td>日</td>
					<td>一</td>
					<td>二</td>
					<td>三</td>
					<td>四</td>
					<td>五</td>
					<td>六</td>
				</tr>
				<?php
					$days=1;
					for($i=1900;$i<$Select_Y;$i++)
					{
						if(($i%4==0&&$i%100!=0)||($i%400==0))
							$days+=366;
						else
							$days+=365;					
					}
					for($i=1;$i<$Select_M;$i++)
						$days+=date("t",mktime(0,0,0,$i,1,$Select_Y));
					$Space=$days%7;
					if($Space!=0)
					{
						echo "<tr height=40>";
						for($j=0;$j<$Space;$j++)
							echo "<td ></td>";
					}
					$d=date("t",mktime(0,0,0,$Select_M,1,$Select_Y));
					if(($Space+$d)%7==0)
						$x=$d;
					else
						$x=$d+(7-(($Space+$d)%7));
					for($i=1;$i<=$x;$i++)
					{
						if($i<=$d)
						{
							if(($Space+$i)%7==1)
							{
								echo "<tr height=40>";
								echo "<td><span style=color:red>".$i."</td>";
							}
							else if(($Space+$i)%7==0)
								echo "<td><span style=color:red>".$i."</td></tr>";
							else
								echo "<td>".$i."</td>";							
						}					
						else
							echo "<td></td>";
					}
				?>
			<?php }?>
		</table>
	</form>
</html>