# Settings
https://settings.codeigniter.com/

## Intalación de Codeigniter 
composer create-project codeigniter4/appstarter service-settings

## Instalacion de Settings con composer
composer require codeigniter4/settings

## Correr migración
php spark db:create service-settings
php spark migrate --all
// Solo migraciones de Settings
php spark migrate -n CodeIgniter\Settings
// para unix
php spark migrate -n CodeIgniter\\Settings

Esta biblioteca utiliza lo que llamamos "notación de punto" para especificar el nombre de la clase y el nombre de la propiedad. Estos se unen con un punto, de ahí el nombre. Si tiene una clase llamada App y la propiedad que desea usar es siteName, la clave sería App.siteName.

General
Para recuperar un valor de configuración, utilice el servicio de configuración.

```
// The same as config('App')->siteName;
$siteName = service('settings')->get('App.siteName');
```

En este caso, usamos el nombre corto de la clase, App, que el método config() ubica automáticamente en el directorio app/Config. Si provenía de un módulo, se encontraría allí. En cualquier caso, la clase Settings detecta automáticamente el nombre completo para separar los valores de los archivos de configuración que pueden compartir el mismo nombre, pero con espacios de nombres diferentes. Si no se encuentra ninguna coincidencia en el archivo de configuración, se usará el nombre corto, lo que permite almacenar configuraciones sin archivos de configuración. Para guardar un valor, llame al método set() en la clase settings, proporcionando el nombre de la clase, la clave y el valor. Tenga en cuenta que los valores booleanos true/false se convertirán en cadenas :true y :false al almacenarse en la base de datos, pero se convertirán de nuevo en booleanos al recuperarse. Los arrays y los objetos se serializan al guardarse y se deserializan al recuperarse.

```
service('settings')->set('App.siteName', 'My Great Site');
```

Puedes eliminar un valor del almacenamiento persistente con el método forget(). Al eliminarlo, se restablece automáticamente al valor predeterminado del archivo de configuración, si lo hay.

service('settings')->forget('App.siteName');

### Si alguna vez necesita eliminar por completo todas las configuraciones de su almacenamiento persistente, puede usar el método flush(). Esto elimina inmediatamente todas las configuraciones de la base de datos y de la caché en memoria.
service('settings')->flush();


### Ajustes contextuales 
Además del comportamiento predeterminado descrito anteriormente, los ajustes se pueden usar para definir "ajustes contextuales". Un contexto puede ser cualquier cosa que se desee, pero ejemplos comunes son un entorno de ejecución o un usuario autenticado. Para usar un contexto, se pasa como parámetro adicional a los métodos get()/set()/forget(); si se solicita un ajuste de contexto y no existe, se usará el valor general. Los contextos pueden ser cualquier cadena única que se elija, pero un formato recomendado para proporcionar cierta consistencia es asignarles una categoría y un identificador, como environment:production, group:superadmin o lang:en. Un ejemplo... Supongamos que la configuración de la aplicación incluye el nombre de un tema para mejorar la visualización. Por defecto, el archivo de configuración especifica App.theme = 'default'. Cuando un usuario cambia su tema, no se desea que esto cambie el tema para todos los visitantes del sitio, por lo que se debe proporcionar al usuario como contexto para el cambio:

```
$context = 'user:' . user_id();
service('settings')->set('App.theme', 'dark', $context);

Ahora, cuando su filtro determina qué tema aplicar, puede verificar el usuario actual como contexto:

$context = 'user:' . user_id();
$theme = service('settings')->get('App.theme', $context);

// or using the helper
setting()->get('App.theme', $context);
```

### El Helper proporciona un acceso directo al servicio. Indicando a BaseController que lo cargue siempre o solo donde se usa.
```
helper('setting');

$name = setting('App.siteName');
// Store a value
setting('App.siteName', 'My Great Site');

// Using the service through the helper
$name = setting()->get('App.siteName');
setting()->set('App.siteName', 'My Great Site');

// Forgetting a value
setting()->forget('App.siteName');

```
Debido a la naturaleza abreviada de la función auxiliar, no puede acceder a configuraciones contextuales.


// borrar todas las configuraciones de la base de datos con el comando settings:clear
php spark settings:clear
Se le pedirá que confirme la acción antes de realizarla.

### Limitaciones conocidas 

Las siguientes son limitaciones conocidas de la biblioteca: Actualmente solo se puede almacenar una configuración a la vez. Si bien DatabaseHandler utiliza una caché local para maximizar el rendimiento de las lecturas, las escrituras deben realizarse una a la vez. Solo se puede acceder directamente al primer nivel dentro de una propiedad. En la mayoría de las clases de configuración, esto no supone un problema, ya que las propiedades son valores simples. Algunos archivos de configuración, como el archivo de base de datos, contienen propiedades que son matrices.
