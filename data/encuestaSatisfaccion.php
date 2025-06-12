<?php
include "../modelo/conexion.php";
$usuario_id = $_GET['usuario_id'] ?? '';
$ya_contesto = false;

if ($usuario_id) {
  $stmt = $db_connection->prepare("SELECT id FROM encuesta_satisfaccion WHERE usuario_id = ?");
  $stmt->bind_param("i", $usuario_id);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    $ya_contesto = true;
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Encuesta de retroalimentación - Premio 17 de Octubre</title>
  <style>
    :root {
      --primary-color: #9a6ee2;
      --primary-light: #c9b1f0;
      --primary-dark: #7a4bcb;
      --text-color: #333;
      --light-gray: #f5f5f5;
      --white: #ffffff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--light-gray);
      color: var(--text-color);
      line-height: 1.6;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 2rem;
    }

    header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .logo {
      width: 100px;
      height: 100px;
      background-color: var(--primary-color);
      border-radius: 50%;
      margin: 0 auto 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: 2rem;
      font-weight: bold;
    }

    h1 {
      color: var(--primary-dark);
      margin-bottom: 0.5rem;
      font-size: 1.8rem;
    }

    h2 {
      color: var(--primary-color);
      margin-bottom: 1.5rem;
      font-size: 1.4rem;
      font-weight: 500;
    }

    .intro-text {
      margin-bottom: 2rem;
      text-align: center;
      font-size: 1.1rem;
    }

    .survey-form {
      background-color: var(--white);
      border-radius: 10px;
      padding: 2rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 1.8rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.8rem;
      font-weight: 600;
      color: var(--primary-dark);
    }

    .radio-group {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .radio-option {
      display: flex;
      align-items: center;
      margin-right: 1.5rem;
    }

    .radio-option input {
      margin-right: 0.5rem;
    }

    textarea {
      width: 100%;
      padding: 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      resize: vertical;
      min-height: 120px;
      font-size: 1rem;
      transition: border 0.3s;
    }

    textarea:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 2px var(--primary-light);
    }

    .submit-btn {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 0.8rem 2rem;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      display: block;
      margin: 2rem auto 0;
      font-weight: 600;
    }

    .submit-btn:hover {
      background-color: var(--primary-dark);
    }

    footer {
      text-align: center;
      margin-top: 3rem;
      color: #666;
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      .container {
        padding: 1.5rem;
      }

      h1 {
        font-size: 1.5rem;
      }

      h2 {
        font-size: 1.2rem;
      }

      .survey-form {
        padding: 1.5rem;
      }

      .radio-group {
        flex-direction: column;
        gap: 0.5rem;
      }

      .radio-option {
        margin-right: 0;
        margin-bottom: 0.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <header>
      <img src="https://i.postimg.cc/wTXLnyx1/IEEH-SF01.png" alt="IEEH Logo" style="width: 150px" />
      <h1>ENCUESTA DE RETROALIMENTACIÓN</h1>
      <h2>
        Premio 17 de Octubre<br />Convocatoria 2025<br />Décima Tercera
        Edición
      </h2>
    </header>

    <p class="intro-text">
      Agradecemos tu participación en este Concurso. Con el propósito de
      mejorar las siguientes ediciones y fortalecer su impacto, nos gustaría
      que nos compartas tu opinión, con respecto de los siguientes aspectos:
    </p>

    <?php if ($ya_contesto): ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          Swal.fire({
            icon: 'info',
            title: 'Encuesta ya respondida',
            text: 'Ya has respondido la encuesta. ¡Gracias por tu participación!',
            confirmButtonColor: '#9a6ee2'
          }).then(() => {
            // window.location.href = 'https://tusitio.com/17deOctubre/';
          });
        });
      </script>
    <?php else: ?>
      <form class="survey-form" id="surveyForm">
        <div class="form-group">
          <label for="q1">1. ¿Tuviste alguna dificultad para llevar a cabo el Proceso de
            Registro?</label>
          <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($_GET['usuario_id'] ?? ''); ?>">
          <div class="radio-group">
            <div class="radio-option">
              <input type="radio" id="q1_yes" name="q1" value="Sí" />
              <label for="q1_yes">Sí</label>
            </div>
            <div class="radio-option">
              <input type="radio" id="q1_no" name="q1" value="No" />
              <label for="q1_no">No</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="q2">2. ¿Consideras que los Requisitos para participar en la
            Convocatoria son accesibles?</label>
          <div class="radio-group">
            <div class="radio-option">
              <input type="radio" id="q2_yes" name="q2" value="Sí" />
              <label for="q2_yes">Sí</label>
            </div>
            <div class="radio-option">
              <input type="radio" id="q2_no" name="q2" value="No" />
              <label for="q2_no">No</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="q3">3. ¿La Rúbrica de Evaluación, que corresponde a la categoría en la
            que participas, te sirvió para desarrollar tu Ensayo?</label>
          <div class="radio-group">
            <div class="radio-option">
              <input type="radio" id="q3_yes" name="q3" value="Sí" />
              <label for="q3_yes">Sí</label>
            </div>
            <div class="radio-option">
              <input type="radio" id="q3_no" name="q3" value="No" />
              <label for="q3_no">No</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="suggestion">4. ¿Quisieras compartir con nosotros alguna sugerencia?</label>
          <textarea id="suggestion" name="suggestion" placeholder="Escribe aquí tus sugerencias..."></textarea>
        </div>

        <button type="submit" class="submit-btn">Enviar Encuesta</button>
      </form>
    <?php endif; ?>

    <footer>
      <p>Premio 17 de Octubre - Décima Tercera Edición © 2025</p>
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('surveyForm').addEventListener('submit', function (e) {
      e.preventDefault();

      // Validar campos requeridos
      const q1 = document.querySelector('input[name="q1"]:checked');
      const q2 = document.querySelector('input[name="q2"]:checked');
      const q3 = document.querySelector('input[name="q3"]:checked');

      // Validar preguntas de radio
      if (!q1 || !q2 || !q3) {
        let missingFields = [];
        if (!q1) missingFields.push("Pregunta 1");
        if (!q2) missingFields.push("Pregunta 2");
        if (!q3) missingFields.push("Pregunta 3");

        Swal.fire({
          icon: 'error',
          title: 'Campos requeridos',
          html: `Por favor responde las siguientes preguntas:<br><br>• ${missingFields.join('<br>• ')}`,
          confirmButtonColor: '#9a6ee2'
        });
        return;
      }

      // Si todo está validado, proceder con el envío
      const form = e.target;
      const formData = new FormData(form);

      fetch('../controlador/procesarEncuesta.php', {
        method: 'POST',
        body: formData
      })
        .then(resp => resp.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: '¡Gracias!',
              text: data.message,
              confirmButtonColor: '#9a6ee2'
            }).then(() => {
              window.location.href = 'http://localhost/17deoctubre/';
            });
            form.reset();
          } else {
            Swal.fire({
              icon: 'info',
              title: 'Aviso',
              text: data.message,
              confirmButtonColor: '#9a6ee2'
            }).then(() => {
              window.location.href = 'http://localhost/17deoctubre/';
            });
          }
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al enviar la encuesta.',
            confirmButtonColor: '#9a6ee2'
          });
        });
    });

    // Opcional: Resaltar visualmente los campos no respondidos
    document.querySelectorAll('.radio-group').forEach(group => {
      group.addEventListener('change', function () {
        const questionName = this.querySelector('input[type="radio"]').name;
        const errorElement = document.getElementById(`error-${questionName}`);
        if (errorElement) {
          errorElement.textContent = '';
        }
      });
    });
  </script>
</body>

</html>