<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password HTML</title>
</head>
<body>
	<table>
		<tr><td>Dear User</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Click on the Below link to reset your Password:</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><a href="{{ url('user/reset-password/'.$code) }}">Reset Password</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you Regards,</td></tr>
		<tr><td>Sample3</td></tr>
		<tr><td>&nbsp;</td></tr>
	</table>
</body>
</html>