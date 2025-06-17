# 🏆 Premio 17 de Octubre - Sistema de Registro y Gestión | IEEH

¡Bienvenido al sistema de registro y administración de usuarios.
Aquí podrás gestionar registros, administrar participantes, consultar reportes y mucho más, todo en una plataforma moderna, segura y fácil de usar. 🚀

---

## ✨ ¿Qué es este sistema?

Es una plataforma web desarrollada para la gestión integral de registros. Permite el registro de participantes, la administración de usuarios, la generación de reportes y la aplicación de encuestas de satisfacción, todo bajo altos estándares de seguridad y usabilidad.

---

## 🛠️ Tecnologías Utilizadas

- **PHP** (backend y lógica de negocio)
- **MySQL** (gestión de base de datos)
- **JavaScript** (interactividad y AJAX)
- **jQuery** (facilita la manipulación del DOM y peticiones AJAX)
- **Bootstrap 5** (diseño responsivo y componentes UI)
- **SweetAlert2** (notificaciones y diálogos modernos)
- **Chart.js** (gráficas y visualización de datos)
- **PHPMailer** (envío de correos electrónicos)
- **Google reCAPTCHA v3** (protección contra bots)
- **DataTables** (tablas dinámicas y exportación)
- **XAMPP** (entorno local recomendado para desarrollo)

---

## 🎯 Características Destacadas

- **Registro de participantes** con validaciones y confirmación por correo.
- **Inicio de sesión seguro** con reCAPTCHA v3.
- **Panel de administración** para gestión de usuarios y reportes.
- **Exportación de datos** a Excel, PDF e impresión directa.
- **Encuesta de satisfacción** vinculada a cada usuario.
- **Notificaciones amigables** con SweetAlert2.
- **Control de apertura/cierre de registros** con indicadores visuales.
- **Barra de progreso y cuenta regresiva** para la convocatoria.
- **Soporte para modo claro/oscuro**.

---

## 📁 Estructura del Proyecto

La estructura del proyecto está organizada para facilitar el desarrollo, mantenimiento y escalabilidad del sistema. A continuación se describe cada carpeta y su propósito principal:

```plaintext
17deOctubre/
├── app/                  # Contiene la lógica de la aplicación, controladores, modelos y helpers.
├── public/               # Carpeta pública accesible desde el navegador. Incluye index.php, archivos CSS, JS e imágenes.
├── resources/            # Recursos de la aplicación, como vistas (plantillas), archivos CSS, JS e imágenes.
│   ├── css/              # Hojas de estilo personalizadas.
│   ├── js/               # Scripts JavaScript propios del sistema.
│   └── img/              # Imágenes utilizadas en la interfaz.
├── storage/              # Archivos generados por el sistema: logs, caché, archivos temporales y exportaciones.
├── vendor/               # Dependencias instaladas mediante Composer.
├── database/             # Archivos relacionados con la base de datos, como migraciones y el script de creación inicial.
├── composer.json         # Archivo de configuración de Composer para gestionar dependencias PHP.
├── README.md             # Documentación principal del proyecto.
└── .env                  # Archivo de variables de entorno para configuración sensible (no debe compartirse públicamente).
```

## 🚀 ¿Cómo instalar y usar el sistema?

1. **Clona el repositorio** en tu entorno local:
   ```bash
   git clone https://github.com/tu-usuario/17deOctubre.git
   ```
2. **Configura XAMPP** e inicia los servicios de Apache y MySQL.
3. **Copia el proyecto** a la carpeta `htdocs` de XAMPP.
4. **Crea la base de datos** importando el archivo SQL incluido en `/database/`.
5. **Configura los parámetros** de conexión a la base de datos en el archivo de configuración (por ejemplo, `app/config.php`).
6. **Instala las dependencias** de Composer (si aplica):
   ```bash
   composer install
   ```
7. **Accede al sistema** desde tu navegador en `http://localhost/17deOctubre/public`.

---

## 💡 Consejos y buenas prácticas

- Mantén actualizado el sistema y las dependencias.
- Realiza respaldos periódicos de la base de datos y archivos importantes.
- Usa contraseñas seguras y únicas para los usuarios administradores.
- No expongas archivos de configuración sensibles en entornos públicos.
- Prueba las funcionalidades después de cada actualización.
- Utiliza el entorno local para pruebas antes de desplegar en producción.

---

## 🦸‍♂️ Autor

**Wilibaldo Salitre**  
Desarrollador Web | Apasionado por la tecnología y el diseño  
[LinkedIn](#) | [GitHub](#) | [Correo](#)

---

## 📬 Contacto

¿Te gustó lo que viste?  
¡Hablemos!  
Encuentra mis redes y correo en la sección de contacto del portafolio.
