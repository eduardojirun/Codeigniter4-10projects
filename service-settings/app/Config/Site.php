<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Site extends BaseConfig
{
    public string $nameSite = 'https://github/loremipsum/';
    public string $home = 'Acelerar la transición del mundo hacia la energía sostenible';
    public array $products = ['alimentos', 'cosméticos', 'vestimenta', 'electrodomesticos', 'cpu'];
    public array $services = ['limpieza', 'seguridad', 'transporte', 'salud', 'educación', 'distribución', 'entretenimiento'];
    public array $areas = ['sistemas', 'administración', 'recursos humanos','dirección', 'Producción', 'Finanzas', 'Marketing', 'Ventas'];
    public string $about = 'Ofrecer a los clientes los precios más bajos que sea posible, obteniendo la mayor selección y disponibilidad de la forma más rápida y cómoda posible.';
    public array $team = ['juan', 'alma', 'pedro', 'ana', 'luis', 'raquel', 'lola'];
    public string $contact = 'loremipsum@gmail.com';


    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     *
     * URL to your CodeIgniter root. Typically, this will be your base URL,
     * WITH a trailing slash:
     *
     * E.g., http://example.com/
     */
    public string $_nameSite = 'https://github/eduardojirun/';

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     *
     * If $negotiateLocale is true, this array lists the locales supported
     * by the application in descending order of priority. If no match is
     * found, the first locale will be used.
     *
     * IncomingRequest::setLocale() also uses this list.
     *
     * @var list<string>
     */
    public array $descriptionSite = ['en'];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     *
     * Enables the Response's Content Secure Policy to restrict the sources that
     * can be used for images, scripts, CSS files, audio, video, etc. If enabled,
     * the Response object will populate default values for the policy from the
     * `ContentSecurityPolicy.php` file. Controllers can always add to those
     * restrictions at run time.
     *
     * For a better understanding of CSP, see these documents:
     *
     * @see http://www.html5rocks.com/en/tutorials/security/content-security-policy/
     * @see http://www.w3.org/TR/CSP/
     */
    public bool $themes = false;
}
