<?php
require_once './vendor/autoload.php';

define('APPLICATION_NAME', 'List test');
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');

$dayLightSaving = '05:00';
if (date('I')) {
	$dayLightSaving = '04:00';
}

function getClient()
{
	$client = new Google_Client();
	$client->setApplicationName(APPLICATION_NAME);
	$client->setAuthConfig(CLIENT_SECRET_PATH);
	$client->setAccessType('offline');

	// Load previously authorized credentials from a file.
	$credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
	if (file_exists($credentialsPath)) {
		$accessToken = json_decode(file_get_contents($credentialsPath), true);
	} else {
		// Request authorization from the user.
		$authUrl = $client->createAuthUrl();
		printf("Open the following link in your browser:\n%s\n", $authUrl);
		print 'Enter verification code: ';
		$authCode = trim(fgets(STDIN));

		// Exchange authorization code for an access token.
		$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

		// Store the credentials to disk.
		if(!file_exists(dirname($credentialsPath))) {
			mkdir(dirname($credentialsPath), 0700, true);
		}
		file_put_contents($credentialsPath, json_encode($accessToken));
		printf("Credentials saved to %s\n", $credentialsPath);
	}
	$client->setAccessToken($accessToken);

	// Refresh the token if it's expired.
	if ($client->isAccessTokenExpired()) {
		$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
		file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
	}
	return $client;

}

function expandHomeDirectory($path) {
	$homeDirectory = getenv('HOME');
	if (empty($homeDirectory)) {
		$homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
	}
	return str_replace('~', realpath($homeDirectory), $path);
}




// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
	'maxResults' => 10,
	'orderBy' => 'startTime',
	'singleEvents' => TRUE,
	'timeMin' => '2017-04-04T12:00:00-' . $dayLightSaving,
	'timeMax'=> '2017-04-04T13:15:00-'. $dayLightSaving,
);
$results = $service->events->listEvents($calendarId, $optParams);

if (count($results->getItems()) == 0) {
	print "No upcoming events found.\n";
	print date('I');
} else {
	print "Upcoming events:\n";
	foreach ($results->getItems() as $event) {
		$start = $event->start->dateTime;
		if (empty($start)) {
			$start = $event->start->date;
		}
		printf("%s (%s)\n", $event->getSummary(), $start);
	}
}










?>	