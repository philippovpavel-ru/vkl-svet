<?php
if (! defined('ABSPATH')) exit;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo "{$blogName} - {$title}"; ?></title>
</head>

<body>

	<style>
		body {
			font-family: DejaVu Sans;
			font-size: 10px;
		}

		table {
			width: 100%;
			margin-bottom: 20px;
			border: 1px solid #dddddd;
			border-collapse: collapse;
		}

		table th {
			font-weight: bold;
			padding: 10px;
			border: 1px solid #000000;
		}

		table td {
			border: 1px solid #000000;
			padding: 10px;
			text-align: center;
		}

		table .col {
			max-width: 50px;
		}

		table img {
			max-width: 150px;
			max-height: 150px;
		}

		table h1 {
			margin: 0;
		}

		table ul {
			padding: 0;
			text-align: left;
		}

		table thead ul {
			list-style: square;
			padding-left: 20px;
		}

		table tbody ul {
			list-style: none;
		}

		.additional {
			text-align: left !important;
		}

		.thead-black {
			background: #000000;
			color: #ffffff !important;
			margin-bottom: 0;
		}

		.thead-black * {
			color: #ffffff !important;
		}

		.thead-left {
			text-align: left;
			padding: 50px 30px;
		}

		.thead-right {
			text-align: right;
			padding: 50px 30px;
		}

		.thead-right ul {
			margin-left: auto;
			width: max-content;
		}

		.tfoot-red {
			background: #9c010e;
			color: #ffffff;
		}

		.td-floor {
			background: #fde9d9;
			color: #000;
			text-align: center;
		}

		.td-room {
			background: #d9d9d9;
			color: #000;
			text-align: center;
		}

		.additional {
			text-align: left;
		}
	</style>

	<table class="thead-black">
		<tr>
			<td colspan="4" class="thead-left">
				<h1><?php esc_html_e($blogName); ?></h1>

				<ul>
					<li><?php esc_html_e($title); ?></li>
					<?php if ($toList = explode(PHP_EOL, $to)) {
						foreach ($toList as $toItem) {
							echo "<li>{$toItem}</li>";
						}
					} ?>
				</ul>
			</td>
			<td colspan="3" class="thead-right">
				<p>ДАТА: <?php echo $date ?: date('d.m.Y'); ?></p>

				<?php if ($fromList = explode(PHP_EOL, $from)) : ?>
					<ul style="text-align:right;">
						<?php foreach ($fromList as $fromItem) {
							echo "<li>{$fromItem}</li>";
						} ?>
					</ul>
				<?php endif; ?>
			</td>
		</tr>
	</table>

	<table>
		<thead>
			<tr>
				<th scope="col">№</th>
				<th class="thumb" scope="col">Изобр.</th>
				<th scope="col">Модель</th>
				<th class="information-list" scope="col">Описание</th>
				<th scope="col">Цена</th>
				<th scope="col">Кол-во</th>
				<th scope="col">Стоимость</th>
				<?php if (!$additional) {
					echo '<th scope="col">Примечание</th>';
				} ?>
			</tr>
		</thead>

		<tbody>
			<?php echo $rows; ?>
		</tbody>
		<tfoot>
			<tr>
				<td class="tfoot-red" colspan="3">ИТОГО:</td>
				<td></td>
				<td></td>
				<td><?php esc_html_e($allCount); ?></td>
				<td><?php echo wc_price($total_price); ?></td>
				<?php if (!$additional) {
					echo '<td></td>';
				} ?>
			</tr>
			<?php
			if ($additional) {
				echo <<<ADDITIONAL
				<tr>
					<td colspan="7" class="additional">
						<h2>Примечание</h2>
						<p>$additional</p>
					</td>
				</tr>'
				ADDITIONAL;
			}
			?>
		</tfoot>
	</table>
</body>

</html>