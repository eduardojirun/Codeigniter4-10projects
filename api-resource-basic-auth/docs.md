# Basic auth - encode Base64 -

username: yourusername
password: yourpassword

```
var encodedData = window.btoa("Hello, world"); // encode a string
var decodedData = window.atob(encodedData); // decode the string

// Comprobar con funcion nativa de javascript WindowBase64.atob() en consola
atob("eW91cnVzZXJuYW1lOnlvdXJwYXNzd29yZA==") // yourusername:yourpassword'
```