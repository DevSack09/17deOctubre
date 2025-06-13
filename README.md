# Premio 17 de Octubre | Sistema de Control

Este proyecto es una plataforma web para la gestión de usuarios, registro de participantes y control de documentos para el Premio 17 de Octubre, desarrollado para el Instituto Estatal Electoral de Hidalgo (IEEH).

## Características principales

- **Gestión de usuarios**: Registro, inicio de sesión, recuperación y restablecimiento de contraseñas, asignación de roles y permisos.
- **Formulario de registro**: Captura de datos personales, validación avanzada de formularios, cálculo automático de edad, y control de acceso a secciones según edad.
- **Gestión de documentos**: Subida y descarga de documentos requeridos para el registro.
- **Reportes**: Generación y exportación de reportes en Excel, PDF, impresión y copia.
- **Notificaciones por correo**: Envío automático de correos de confirmación y restablecimiento de contraseña usando PHPMailer.
- **Seguridad**: Integración con Google reCAPTCHA v3 y manejo seguro de sesiones.
- **Interfaz moderna**: Basada en Bootstrap 5, con soporte para temas claro/oscuro y diseño responsivo.

## Estructura del proyecto

- `/controlador`: Lógica de backend (PHP), controladores de usuarios, formularios, login, registro, envío de correos, etc.
- `/modelo`: Archivos de conexión y lógica de base de datos.
- `/data`: Vistas principales, formularios, reportes, menú, y recursos JS/CSS.
- `/js`, `/css`: Archivos de scripts y estilos personalizados.
- `/template`: Plantillas HTML para correos electrónicos.
- `/uploads`: Carpeta para archivos subidos.
- `/vendor`: Dependencias externas (PHPMailer, etc.).

## Instalación

1. **Clonar el repositorio**
   ```sh
   git clone <url-del-repositorio>
   ```
2. **Configurar la base de datos**

   Importa el archivo dbpremio17_2025-05-28_134411.sql en tu servidor MySQL<vscode_annotation details='%5B%7B%22title%22%3A%22hardcoded-credentials%22%2C%22description%22%3A%22Embedding%20credentials%20in%20source%20code%20risks%20unauthorized%20access%22%7D%5D'>. </vscode_annotation> - Actualiza las credenciales de conexión en modelo/conexion.php.

3. **Instalar dependencias PHP**

4. **Configurar PHPMailer**

   Edita los datos de correo en los controladores que envían emails (controlador_registrar.php, send_reset_link.php, etc.).

5. **Configurar Google reCAPTCHA**

   - Actualiza las claves de reCAPTCHA en los formularios de login/registro y en el backend.

6. **Configurar el servidor web**

   Asegúrate de que tu servidor (Apache, Nginx, XAMPP, etc.) apunte a la carpeta raíz del proyecto.

## Uso

    Accede a la página principal (index.php) para iniciar sesión o registrarte.
    Los usuarios pueden completar el formulario de registro, subir documentos y consultar el estado de su registro.
    Los administradores pueden gestionar usuarios, asignar permisos y generar reportes.

## Créditos

    Desarrollado por el Ing. Wilibaldo Salitre Cervantes
    Basado en Bootstrap 5 y librerías de código abierto como PHPMailer, DataTables, SweetAlert2, Quill, Choices.js, entre otras.

## Contacto:

    Ing. Wilibaldo Salitre Cervantes
    salwilcer@gmail.com
