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

    $app->delete("/delete_all", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('stylist_list.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->delete("/delete_stylist/{stylist_id}", function($stylist_id) use ($app) {
        $new_stylist = Stylist::find($stylist_id);
        $new_stylist->delete();
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

    $app->get("/stylist_edit/{stylist_id}", function($stylist_id) use ($app) {
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => Stylist::find($stylist_id)));
    });

    $app->patch("/stylist_edit/{stylist_id}", function($stylist_id) use ($app) {
        $stylist = Stylist::find($stylist_id);
        if (!empty($_POST['stylist_name']))
        {$stylist->update('stylist_name',$_POST['stylist_name']);}
        $stylist = Stylist::find($stylist_id);
        if (!empty($_POST['specialty']))
        {$stylist->update('specialty',$_POST['specialty']);}
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => Stylist::find($stylist_id)));
    });


    // This route is just here to auto populate all stylists with a few clients for UI testing.
    $app->get("/populate", function() use ($app) {
        $stylists = Stylist::getAll();
        foreach ($stylists as $stylist)
        {
            $stylist_id = $stylist->getId();
            $client_name = 'Mr. Dude';
            $next_appointment = "2017-02-24 15:00:00";
            $test_client = new Client ($client_name,$next_appointment,$stylist_id);
            $test_client->save();
            $client_name2 = 'El Duderino';
            $next_appointment2 = "2017-02-24 17:00:00";
            $test_client2 = new Client ($client_name2,$next_appointment2,$stylist_id);
            $test_client2->save();
            $client_name3 = 'Monsieur Fancee';
            $next_appointment3 = "2017-02-24 19:00:00";
            $test_client3 = new Client ($client_name3,$next_appointment3,$stylist_id);
            $test_client3->save();
        }
        return $app['twig']->render('stylist_list.html.twig', array('stylists' => Stylist::getAll()));
    });

    return $app;
?>
