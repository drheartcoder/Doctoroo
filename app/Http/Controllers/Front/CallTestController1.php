<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


$autoloader = __DIR__.'/../../../../vendor/autoload.php';
if (!file_exists($autoloader)) {
  die('You must run `composer install` in the sample app directory');
}
require($autoloader);

use Slim\Slim;
use Gregwar\Cache\Cache;

use OpenTok\OpenTok;
use OpenTok\Role;
use OpenTok\MediaMode;
use OpenTok\OutputMode;


class CallTestController1 extends Controller
{
    public function __construct()
	{
		$this->module_url_path = url('/');
	}

	public function index()
	{
		// PHP CLI webserver compatibility, serving static files
		$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
		if (php_sapi_name() === 'cli-server' && is_file($filename)) {
		    return false;
		}

		// Verify that the API Key and API Secret are defined
		if (!(getenv('TOKBOX_API_KEY') && getenv('TOXBOX_API_SECRET'))) {
		    die('You must define an TOKBOX_API_KEY and TOXBOX_API_SECRET in the run-demo file');
		}

		// Initialize Slim application
		$app = new Slim(array(
		    'templates.path' => __DIR__.'/../../../../resources/views/front/templates',
		    'view' => new \Slim\Views\Twig()
		));

		// Intialize a cache, store it in the app container
		$app->container->singleton('cache', function() {
		    return new Cache;
		});

		// Initialize OpenTok instance, store it in the app contianer
		$app->container->singleton('opentok', function () {
		    return new OpenTok(getenv('TOKBOX_API_KEY'), getenv('TOXBOX_API_SECRET'));
		});
		// Store the API Key in the app container
		$app->apiKey = getenv('TOKBOX_API_KEY');

		// If a sessionId has already been created, retrieve it from the cache
		$sessionId = $app->cache->getOrCreate('sessionId', array(), function() use ($app) {
		    // If the sessionId hasn't been created, create it now and store it
		    $session = $app->opentok->createSession(array(
		      'mediaMode' => MediaMode::ROUTED
		    ));
		    return $session->getSessionId();
		});

		// Configure routes
		$app->get('/doctor/start_consultation1', function () use ($app) {
		    $app->render('index.blade.php');
		});

		$app->get('/doctor/host', function () use ($app, $sessionId) {

		    $token = $app->opentok->generateToken($sessionId, array(
		        'role' => Role::MODERATOR
		    ));

		    $app->render('host.blade.php', array(
		        'apiKey' => $app->apiKey,
		        'sessionId' => $sessionId,
		        'token' => $token,
		        'path'=>$this->module_url_path
		    ));
		});

		$app->get('/doctor/participant', function () use ($app, $sessionId) {

		    $token = $app->opentok->generateToken($sessionId, array(
		        'role' => Role::MODERATOR
		    ));

		    $app->render('participant.blade.php', array(
		        'apiKey' => $app->apiKey,
		        'sessionId' => $sessionId,
		        'token' => $token,
		        'path'=>$this->module_url_path
		    ));
		});

		$app->get('/doctor/history', function () use ($app) {
		    $page = intval($app->request->get('page'));
		    if (empty($page)) {
		        $page = 1;
		    }

		    $offset = ($page - 1) * 5;

		    $archives = $app->opentok->listArchives($offset, 5);

		    $toArray = function($archive) {
		      return $archive->toArray();
		    };

		    $app->render('history.blade.php', array(
		        'archives' => array_map($toArray, $archives->getItems()),
		        'showPrevious' => $page > 1 ? '/history?page='.($page-1) : null,
		        'showNext' => $archives->totalCount() > $offset + 5 ? '/history?page='.($page+1) : null
		    ));
		});

		$app->get('/doctor/download/:archiveId', function ($archiveId) use ($app) {
		    $archive = $app->opentok->getArchive($archiveId);
		    $app->redirect($archive->url);
		});

		$app->get('/doctor/start', function () use ($app, $sessionId) {
			
		    $archive = $app->opentok->startArchive($sessionId, array(
		      'name' => "PHP Archiving Sample App",
		      'hasAudio' => ($app->request->get('hasAudio') == 'on'),
		      'hasVideo' => ($app->request->get('hasVideo') == 'on'),
		      'outputMode' => ($app->request->get('outputMode') == 'composed' ? OutputMode::COMPOSED : OutputMode::INDIVIDUAL)
		    ));

		    $app->response->headers->set('Content-Type', 'application/json');
		    echo $archive->toJson();
		});

		$app->get('/doctor/stop/:archiveId', function($archiveId) use ($app) {
		    $archive = $app->opentok->stopArchive($archiveId);
		    $app->response->headers->set('Content-Type', 'application/json');
		    echo $archive->toJson();
		});

		$app->get('/doctor/delete/:archiveId', function($archiveId) use ($app) {
		    $app->opentok->deleteArchive($archiveId);
		    $app->redirect('/history');
		});

		$app->run();
	}
}
