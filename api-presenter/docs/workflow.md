# Flujo de trabajo para creación de api presenter

- install codeigniter con composer
> composer create-project codeigniter4/appstarter api-presenter

- Establcer configuración de base de datos, base_url, etc. en .env, modo development

- Quitar index.php de la url para que no la incluya, opcional
    Then	After
    public $baseURL = 'http://localhost:8080';	public $baseURL = 'http://localhost/your_project/';
    public $indexPage = 'index.php';	public $indexPage = '';
    public $uriProtocol = 'REQUEST_URI';	public $uriProtocol = 'PATH_INFO';

2. Copy the index.php and .htaccess files file from the public directory and paste them into your project directory.
3. Update the index.php file and change the pathsPath variable.
    Then	After
    $pathsPath = FCPATH . '../app/Config/Paths.php';	$pathsPath = FCPATH . 'app/Config/Paths.php';


- arrancar servidor de codeigniter spark
> php spark serve

- Se crea la base de datos
> php spark db:create books

- Crear la migracion y correrla
> php spark make:migration Books
> php spark migrate

- Crear sedder y correrlo
> php spark make:seeder Books --suffix
> php spark db:seed Books

- Crear controlador, modelo, migracion y sedder con spark
> php spark make:scaffold Books --restful presenter


Codeigniter 4, Controlador(ResourcePresenter), 1 modelo, 2 vistas(con Layout), 1 migración, 1 seeder, 1 helper
Bootstrap 5, iconos Bootstrap, 


