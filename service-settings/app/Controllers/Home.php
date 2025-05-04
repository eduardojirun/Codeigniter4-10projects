<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // https://settings.codeigniter.com/
        helper('setting');
        // $name = setting('App.siteName');
        // Store a value
        // setting('App.siteName', 'All Codeigniter');

        setting('Track.url', base_url());

        $nameSite = setting()->get('Site.nameSite');d($nameSite); // REQUEST_URI

        // Using the service through the helper
        $name = setting()->get('App.uriProtocol');d($name); // REQUEST_URI
        // $name = setting()->get('ContentSecurityPolicy.scriptSrc');dd($name); // "self"

        setting()->set('App.uriProtocol', 'PATH_INFO');
        $rename = setting()->get('App.uriProtocol');dd($rename);

        
        

        return view('welcome_message');
    }

    private function doc()
    {
        /* ===== Usando servicio ===== */

        // The same as config('App')->siteName;
        // Obtener valor
        $siteName = service('settings')->get('App.siteName');
        // Establecer valor
        service('settings')->set('App.siteName', 'My Great Site');
        // Puedes eliminar un valor del almacenamiento persistente con el método forget(). Al eliminarlo, se restablece automáticamente al valor predeterminado del archivo de configuración, si lo hay.
        service('settings')->forget('App.siteName');
        // Si alguna vez necesita eliminar por completo todas las configuraciones de su almacenamiento persistente, puede usar el método flush(). Esto elimina inmediatamente todas las configuraciones de la base de datos y de la caché en memoria.
        service('settings')->flush();


        /* ===== Usando el Helper ===== */

        helper('setting');

        $name = setting('App.siteName');
        // Store a value
        setting('App.siteName', 'My Great Site');

        // Using the service through the helper
        $name = setting()->get('App.siteName');
        setting()->set('App.siteName', 'My Great Site');

        // Forgetting a value
        setting()->forget('App.siteName');
    }
}
