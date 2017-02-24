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


    $app->get("/stylist_edit/{stylist_id}", function($stylist_id) use ($app) {
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => Stylist::find($stylist_id)));
    });

    $app->patch("/stylist_edit/{stylist_id}", function($stylist_id) use ($app) {
        $stylist = Stylist::find($stylist_id);
        if (!empty($_POST['stylist_name']))
        {$stylist->update('stylist_name',$_POST['stylist_name']);}
        if (!empty($_POST['specialty']))
        {$stylist->update('specialty',$_POST['specialty']);}
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => Stylist::find($stylist_id)));
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

    // placeholder for route from deleting a client
    $app->delete("/delete_client/{client_id}", function($client_id) use ($app) {
        $new_client = Client::find($client_id);
        $stylist = Stylist::find($new_client->getStylistId());
        $new_client->delete();
        $clients = $stylist->findClients();
        return $app['twig']->render('client_list.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->get("/client_edit/{client_id}", function($client_id) use ($app) {
        $client = Client::find($client_id);
        $stylist = Stylist::find($client->getStylistId());
        return $app['twig']->render('client_edit.html.twig', array('client' => Client::find($client_id),'stylist' => $stylist));
    });

    $app->patch("/client_edit/{client_id}", function($client_id) use ($app) {
        $client = Client::find($client_id);
        if (!empty($_POST['client_name']))
        {$client->update('client_name',$_POST['client_name']);}
        if (!empty($_POST['next_appointment']))
        {$client->update('next_appointment',$_POST['next_appointment']);}
        $stylist = Stylist::find($client->getStylistId());
        return $app['twig']->render('client_edit.html.twig', array('client' => Client::find($client_id),'stylist' => $stylist));
    });


    // These routes are just here to auto populate all stylists with a few clients for UI testing.
    $app->get("/populate_stylists", function() use ($app) {
        $stylist_name = 'Eduardo';
        $specialty = "pompadour";
        $test_stylist = new Stylist ($stylist_name,$specialty);
        $test_stylist->save();
        $stylist_name2 = 'Phillipe';
        $specialty2 = "Wavy Mess";
        $test_stylist2 = new Stylist ($stylist_name2,$specialty2);
        $test_stylist2->save();
        $stylist_name3 = 'Meekus';
        $specialty3 = "Styling Gel";
        $test_stylist3 = new Stylist ($stylist_name3,$specialty3);
        $test_stylist3->save();
        $stylist_name4 = 'Brint';
        $specialty4 = "Male Models";
        $test_stylist4 = new Stylist ($stylist_name4,$specialty4);
        $test_stylist4->save();
        return $app['twig']->render('stylist_list.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/populate_clients", function() use ($app) {
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
