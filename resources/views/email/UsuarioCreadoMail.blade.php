<h2>!Bienvenido {{ $usuario->nombre }} {{ $usuario->apellido }}!</h2>

<p>Esperemos que nuestra aplicación te sea de gran utilidad!</p>
<p>Para ingresar da click en el siguiente enlace <a href={{ url('/login') }} title="Iniciar sesion">Iniciar sesión</a></p>
<p>La contraseña es el rut sin guion ni digito verificador. La primera vez que ingrese deberá obligatoriamente cambiar el password.</p>

Enviado automáticamente desde <a href={{ url('/') }} title="{{ str_replace('_', ' ', config('app.name', 'TecnoBot')) }}">{{ str_replace("_", " ", config('app.name', 'TecnoBot')) }}</a>

<br /><br /><br /><br /><br /><br />

© 2015-{{ date('Y') }}  <a href="http://www.tecnobot.cl">TecnoBot</a>. @lang('All rights reserved.')