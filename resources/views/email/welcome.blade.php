<html>
	<head>
		<title>Bienvenue</title>
	</head>
	<body>
		{{ $user['email'] }}
		<br>
		<p>Votre email enregistré est: {{ $user['email'] }}</p>
		<p>{{ config('app.name') }}</p>
	</body>
</html>