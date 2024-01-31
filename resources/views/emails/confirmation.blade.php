<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register HTML</title>
</head>
<body>
	<table>
		<tr><td>Dear {{ $name }}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Click on the Below link to activate your Sample3 in Account:</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><a href="{{ url('user/confirm/'.$code) }}">Confirm Account</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you Regards,</td></tr>
		<tr><td>Sample3</td></tr>
		<tr><td>&nbsp;</td></tr>
	</table>
</body>
</html>