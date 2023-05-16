<h2>developers rating</h2>
<table>
	<thead>
		<tr>
			<th>avatar</th>
			<th>group</th>
			<th>name</th>
			<th>points</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td><img src="https://placehold.co/60" alt="placehold"></td>
			<td>ninja</td>
			<td>ahmed mohamed</td>
			<td>120</td>
			<td>
				<button class="button_one">view</button>
				<button class="button_two">delete</button>
			</td>
		</tr>

		<tr>
			<td><img src="https://placehold.co/60" alt="placehold"></td>
			<td rowspan="2">shades</td>
			<td>shady nabile</td>
			<td>180</td>
			<td>
				<button class="button_one">view</button>
				<button class="button_two">delete</button>
			</td>
		</tr>

		<tr>
			<td><img src="https://placehold.co/60" alt="placehold"></td>
			<td>eman mohamed</td>
			<td>160</td>
			<td>
				<button class="button_one">view</button>
				<button class="button_two">delete</button>
			</td>
		</tr>
	</tbody>

	<tr>
		<td><img src="https://placehold.co/60" alt="placehold"></td>
		<td rowspan="2">valhala</td>
		<td>mohamed inbrahim</td>
		<td>190</td>
		<td>
			<button class="button_one">view</button>
			<button class="button_two">delete</button>
		</td>
	</tr>

	<tr>
		<td><img src="https://placehold.co/60" alt="placehold"></td>
		<td>noor atef</td>
		<td>110</td>
		<td>
			<button class="button_one">view</button>
			<button class="button_two">delete</button>
		</td>
	</tr>

	<tr class="bottom">
		<td><img src="https://placehold.co/60" alt="placehold"></td>
		<td>unino</td>
		<td>ibrahim adel</td>
		<td>130</td>
		<td>
			<button class="button_one">view</button>
			<button class="button_two">delete</button>
		</td>
	</tr>
</table>

<style>
	h2 {
		text-transform: capitalize;
		text-align: center;
	}

	table {
		width: 700px;
		margin: 20px auto;
	}

	table,
	th,
	td {
		border: 1px solid white;
		border-collapse: collapse;
		padding: 15px;
		text-align: center;
		text-transform: capitalize;
		font-size: 20px;
	}

	table th {
		background-color: #404040;
		color: white;
	}

	table td {
		background-color: #eeeeee;

	}

	img {
		border: 1px solid #b7b6b6;
	}

	button {
		font-size: 18px;
		padding: 8px;
		text-transform: capitalize;
		border-radius: 5px;
		border: none;
		cursor: pointer;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		-ms-border-radius: 5px;
		-o-border-radius: 5px;
	}

	.button_one {
		background: #03a9f4;
		color: white;
	}

	.button_two {
		background: #e91e63;
		color: white;
	}

	.bottom {
		border-bottom: 2px solid #009688;
	}
</style>