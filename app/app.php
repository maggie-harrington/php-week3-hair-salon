<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    // index, displays all stylists
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    // add a stylist
    $app->post("/stylists/add", function() use ($app) {
        $stylist = new Stylist($_POST['name']);
        $stylist->save();

        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    // delete all stylists (will also delete all clients)
    $app->delete("/stylists/delete_all", function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();

        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    // delete a stylist
    $app->delete("/stylists/{id}/delete", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();

        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    // edit a stylist, goes from index to stylist edit page
    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);

        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    // submit edit to a stylist, returns to index from stylist edit page
    $app->patch("/stylists/{id}/submit_edit", function($id) use ($app) {
        $name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);

        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    // click on a single stylist, goes to clients page and displays all clients for that stylist
    $app->get("/stylists/{id}/view_clients", function($id) use ($app) {
        $stylist = Stylist::find($id);

        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    // from clients page, adds new client to that stylist and returns to clients page
    $app->post("/stylists/{id}/add_client", function($id) use($app) {
        $stylist = Stylist::find($id);
        $name = $_POST['name'];
        // $stylist_id = $_POST['stylist_id'];
        $stylist_id = $id;
        $client = new Client($name, $stylist_id);
        $client->save();

        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    // from clients page, click on edit button next to client, goes to client edit page
    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);

        return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

    // from client edit page, edits client and returns to clients page
    $app->patch("/clients/{id}/submit_edit", function($id) use ($app) {
        $name = $_POST['name'];
        $client = Client::find($id);
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);
        $client->update($name);

        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    // from clients page, click on delete button next to client, deletes that client and re-displays clients page
    $app->delete("/clients/{id}/delete", function($id) use ($app) {
        $client = Client::find($id);
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);
        $client->delete();

        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    return $app;
?>
