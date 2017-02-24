<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $app['debug'] = true;


    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('stylist_list.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/", function() use ($app) {
        $new_stylist = new Stylist($_POST['stylist_name'], $_POST['specialty']);
        $new_stylist->save();
        return $app['twig']->render('stylist_list.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/clients/{stylist_id}", function($stylist_id) use ($app) {
        $stylist = Stylist::find($stylist_id);
        $clients = $stylist->findClients();
        return $app['twig']->render('client_list.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->post("/clients/{stylist_id}", function($stylist_id) use ($app) {
        $stylist = Stylist::find($stylist_id);
        $new_client = new Client($_POST['client_name'],$_POST['appointment'],$stylist->getId());
        $new_client->save();
        $clients = $stylist->findClients();
        return $app['twig']->render('client_list.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });



    return $app;
?>
