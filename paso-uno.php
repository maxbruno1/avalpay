<?php
/**
 * Reconstrucción del "Paso 1" del flujo de pago, con fines de documentación
 * del sitio de phishing pagosaval.azurewebsites.net (clon de Aval Pay Center).
 *
 * Deliberadamente NO se incluye aquí lo que en el sitio original es el
 * mecanismo de robo de credenciales: el botón "Agiliza tu pago" en el
 * original abre un modal que pide correo+contraseña o documento+banco,
 * envía esos datos en texto plano a un bot de Telegram, y luego redirige
 * a una página que imita el login real de un banco (o a un enlace de
 * cobro real en Bold.co). Nada de eso se reproduce aquí: el botón queda
 * deshabilitado y el botón "Pagar" solo valida localmente, guarda los datos
 * del formulario en el navegador y continúa a una reconstrucción visual del
 * "paso dos", sin enviar datos a ningún sitio externo.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aval Pay Center - Realizar Pago</title>
    <script>
        (function () {
            try {
                var convenioSeleccionado = localStorage.getItem('convenioSeleccionado');
                if (!convenioSeleccionado) {
                    window.location.replace('index.php');
                }
            } catch (error) {
                window.location.replace('index.php');
            }
        })();
    </script>
    <link rel="icon" type="image/svg+xml" href="assets/img/favicon-avalpay.svg">
    <link rel="stylesheet" href="assets/estilos-avalpay.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@700&family=Plus+Jakarta+Sans:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="cabecera">
        <div class="contenedor-cabecera">
            <div class="grupo-logos">
                <img src="assets/img/logo-avalpay-center.webp" alt="Aval Pay Center Logo" class="logo-principal">
                <img src="assets/img/aval-group-logo.png" alt="Grupo Aval Logo" class="logo-secundario">
            </div>
            <nav class="menu-navegacion">
                <ul>
                    <li><a href="index.php" class="enlace-navegacion texto-oscuro">Volver al Inicio</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="contenedor pagina-pago">

        <h1 class="titulo-principal">Realiza tu pago</h1>
        <div class="indicadores">
            <span class="punto punto-azul-oscuro"></span>
            <span class="punto punto-rojo"></span>
            <span class="punto punto-azul-claro"></span>
            <span class="punto punto-verde"></span>
        </div>

        <div class="contenedor-columnas">

            <!-- COLUMNA IZQUIERDA: Pasos -->
            <div class="columna-pasos">
                <div class="paso activo">
                    <div class="circulo-paso">1</div>
                    <div class="contenido-paso">
                        <h3 class="titulo-paso">Datos de tu pago</h3>
                        <p class="descripcion-paso">
                            Ingresa los datos necesarios para realizar tu pago, recuerda que los
                            campos con asterisco son obligatorios. Lee y acepta términos y condiciones.
                        </p>
                    </div>
                </div>
                <div class="paso inactivo">
                    <div class="circulo-paso">2</div>
                    <div class="contenido-paso">
                        <h3 class="titulo-paso">Realiza tu pago seguro</h3>
                    </div>
                </div>
                <div class="paso inactivo sin-borde">
                    <div class="circulo-paso">3</div>
                    <div class="contenido-paso">
                        <h3 class="titulo-paso">Recibe tu comprobante</h3>
                    </div>
                </div>
                <p class="texto-medios-pago">Este pago lo puedes realizar a través de los siguientes medios:</p>
                <div class="medios-pago-logos">
                    <div class="tarjeta-logo-pago">
                        <img src="assets/img/aval-group-logo.png" alt="Grupo Aval">
                    </div>
                    <div class="tarjeta-logo-pago">
                        <img src="assets/img/pse-logo.png" alt="PSE">
                    </div>
                </div>
            </div>

            <!-- COLUMNA DERECHA: Formulario -->
            <div class="columna-formulario">

                <p class="etiqueta-servicio">Servicio a pagar</p>
                <h2 id="nombreConvenioMostrar" class="nombre-servicio-grande">Cargando...</h2>

                <div class="formulario-agrupado">
                    <div class="campo-formulario campo-formulario--flotante" id="campoReferenciaWrapper">
                        <span class="etiqueta-flotante" id="etiquetaCampoReferencia">Cargando...</span>
                        <input type="text" id="campoReferencia" class="entrada-formulario" placeholder="Cargando..." autocomplete="off" required>
                        <p class="mensaje-error" id="errorReferencia"><span class="icono-error">✖</span> Este campo es obligatorio.</p>
                    </div>
                    <div id="camposAdicionales"></div>
                    <div class="campo-formulario campo-formulario--flotante" id="campoValorWrapper">
                        <span class="etiqueta-flotante" id="etiquetaCampoValor">Valor a pagar*</span>
                        <input type="text" id="campoValor" class="entrada-formulario" placeholder="Valor a pagar*" inputmode="numeric" autocomplete="off" required>
                        <p class="mensaje-error" id="errorValor"><span class="icono-error">✖</span> Este campo es obligatorio.</p>
                    </div>
                </div>

                <div class="fila-resumen">
                    <span class="etiqueta-resumen">Valor de la transacción</span>
                    <span class="valor-resumen" id="valorResumen">$ 0</span>
                </div>

                <div class="fila-resumen-detalle">
                    <span class="etiqueta-resumen">Agregar detalle del pago</span>
                    <label class="interruptor">
                        <input type="checkbox" id="interruptorDetalle">
                        <span class="deslizador redondo"></span>
                    </label>
                </div>

                <div id="contenedorDetallePago" class="contenedor-detalle-pago oculto">
                    <textarea id="textareaDetalle" class="textarea-detalle" placeholder="Detalle del pago" rows="4"></textarea>
                </div>

                <div class="contenedor-terminos">
                    <input type="checkbox" id="aceptoTerminos" class="casilla-verificacion">
                    <label for="aceptoTerminos" class="texto-terminos">Acepto <a href="#" class="enlace-terminos">términos y condiciones</a></label>
                </div>
                <p class="mensaje-error" id="errorTerminos"><span class="icono-error">✖</span> Debes aceptar términos y condiciones</p>

                <!-- Casilla estilo reCAPTCHA: puramente decorativa, no valida nada -->
                <div class="caja-recaptcha">
                    <div class="recaptcha-interior">
                        <div class="recaptcha-check" data-recaptcha="">
                            <input type="checkbox" id="casillaRecaptcha" class="casilla-recaptcha">
                            <div class="recaptcha-check__caja"></div>
                            <div class="recaptcha-check__spinner oculto"></div>
                            <svg class="recaptcha-check__chulito oculto" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"></path>
                            </svg>
                        </div>
                        <span class="texto-recaptcha">No soy un robot</span>
                    </div>
                    <img src="assets/img/recapchat.png" alt="reCAPTCHA" class="recaptcha-sello">
                </div>
                <p class="mensaje-error" id="errorRecaptcha"><span class="icono-error">✖</span> Debes marcar la casilla</p>

                <div class="grupo-botones-formulario">
                    <button id="botonPagar" class="boton boton-primario-suave">Pagar</button>
                    <button id="botonAgiliza" class="boton boton-primario-suave" disabled title="Omitido en esta reconstrucción: en el original captura credenciales">Agiliza tu pago</button>
                </div>

            </div>
        </div>
    </main>

    <!-- Modal Confirmación (solo visual, no envía datos ni avanza de paso) -->
    <div id="modalConfirmacion" class="modal-confirmacion" aria-hidden="true">
        <div class="modal-confirmacion__overlay" data-cerrar-modal=""></div>
        <div class="modal-confirmacion__dialog" role="dialog" aria-modal="true" aria-labelledby="modalConfirmacionTitulo">
            <div class="modal-confirmacion__header">
                <div class="modal-confirmacion__titulo">
                    <span class="modal-confirmacion__icono" aria-hidden="true">✓</span>
                    <h3 id="modalConfirmacionTitulo">Confirmación</h3>
                </div>
                <button type="button" class="modal-confirmacion__cerrar" aria-label="Cerrar" data-cerrar-modal="">×</button>
            </div>
            <div class="modal-confirmacion__body">
                <p>¿Estás seguro que la información del pago es correcta?</p>
            </div>
            <div class="modal-confirmacion__footer">
                <button type="button" id="modalConfirmacionAceptar" class="boton boton-primario-suave">Aceptar</button>
                <button type="button" class="boton modal-confirmacion__boton-secundario" data-cerrar-modal="">Cancelar</button>
            </div>
        </div>
    </div>

    <script src="assets/paso-uno.js"></script>
</body>
</html>
