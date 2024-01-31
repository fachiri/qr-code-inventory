<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>QR Code {{ $item->name }}</title>
		<style>
			table {
				border-collapse: collapse;
				width: 100%;
				text-align: center
			}

			td,
			th {
				border: 1px solid black;
			}

			img {
				width: 80px;
				padding: 10px;
			}

			.qr-code {
				margin-right: -35px;
				padding-left: 15px;
			}
		</style>
	</head>

	<body>
		<table>
			@for ($i = 0; $i < $item->quantity; $i++)
        @php
          $no = $i + 1;
          $item_no = str_pad($no, 3, '0', STR_PAD_LEFT)
        @endphp
				<tr>
					<td rowspan="2">
						<img src="{{ $base64 }}">
					</td>
					<td>042.04.3100.400099.000.KD 2018</td>
					<td rowspan="2">
						<div class="qr-code">
							{!! DNS2D::getBarcodeHTML(URL::to('/') . '/item/' . $item->uuid . '/' . $item_no, 'QRCODE', 2.5, 2.5) !!}
						</div>
					</td>
				</tr>
				<tr>
					<td>{{ $item->code }} {{ $item_no }}</td>
				</tr>
			@endfor
		</table>
	</body>

</html>
