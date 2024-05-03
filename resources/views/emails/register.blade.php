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
		<tr><td>Welcome to Sample3 Your account information is as below:</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Name: {{ $name }}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Mobile: {{ $mobile }}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Email: {{ $email }}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Password: ********(as chosen by you)</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you Regards,</td></tr>
		<tr><td>Sample3</td></tr>
		<tr><td>&nbsp;</td></tr>
	</table>
</body>
</html>