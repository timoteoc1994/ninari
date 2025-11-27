<script setup>
import { Link } from "@inertiajs/vue3";

// Iconos de ejemplo (puedes reemplazar estas rutas con tus PNGs)
const logoNinari = "/storage/webninari2/logoblancoarriba.webp";
const iconFacebook = "/storage/webninari2/facebook.webp";
const iconTiktok = "/storage/webninari2/tiktok.webp";
const iconInstagram = "/storage/webninari2/instagram.webp";
const linkedin = "/storage/webninari2/linkenid.webp";
const telefono = "/storage/webninari2/telefono.webp";
const email = "/storage/webninari2/mail.webp";
const ubicacion = "/storage/webninari2/ubicacion.webp";
</script>

<template>
    <footer class="footer-container">
        <div class="footer-content">
            <!-- Columna 1: Logo y descripción -->
            <div class="footer-column">
                <div class="logo-section">
                    <img
                        :src="logoNinari"
                        alt="NINARI Logo"
                        class="footer-logo"
                    />
                    <p class="logo-text">
                        Innovación y<br />
                        desarrollo<br />
                        sostenible
                    </p>
                </div>
            </div>

            <!-- Columna 2: Menú -->
            <div class="footer-column">
                <h3 class="footer-title">Menú</h3>
                <ul class="footer-links">
                    <li ><Link href="/inicio">Inicio</Link></li>
                    <li><Link href="/nosotros">Nosotros</Link></li>
                    <li><Link href="/ecosistema">Ecosistema</Link></li>
                    <li><Link href="/programas">Programas</Link></li>
                    <li><Link href="/noticias">Noticias</Link></li>
                    <li><Link href="/contacto">Contacto</Link></li>
                </ul>
            </div>

            <!-- Columna 3: Contactos -->
            <div class="footer-column">
                <h3 class="footer-title">Contactos</h3>
                <div class="contact-info">
                    <p class="contact-item">
                        <img :src="telefono" alt="Teléfono" /> 0963211354
                    </p>
                    <p class="contact-item">
                        <img :src="email" alt="Email" /> info@ninari.org.ec
                    </p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/ninarifoundation" target="_blank" class="social-link">
                            <img :src="iconFacebook" alt="Facebook" />
                        </a>
                        <a href="https://www.tiktok.com/@ninarifoundation" target="_blank" class="social-link">
                            <img :src="iconTiktok" alt="TikTok" />
                        </a>
                        <a href="https://www.instagram.com/ninarifoundation/#" target="_blank" class="social-link">
                            <img :src="iconInstagram" alt="Instagram" />
                        </a>
                        <a href="https://www.linkedin.com/company/ninari-foundation/posts/?feedView=all" target="_blank" class="social-link">
                            <img :src="linkedin" alt="LinkedIn" />
                        </a>
                    </div>
                </div>
            </div>

            <!-- Columna 4: Dirección -->
            <div class="footer-column">
                <h3 class="footer-title">Dirección:</h3>
                <div class="flex items-start gap-2">
                    <div>
                        <img :src="ubicacion" alt="Ubicación" />
                    </div>
                    <div>
                        <p class="address">
                            Ficoa - Guaytambos y<br />
                            Manzanos - Edificio UTPL
                        </p>
                    </div>
                </div>

                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d289.1605764950617!2d-78.63513780850593!3d-1.2405102434363786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1ses!2sec!4v1763047876713!5m2!1ses!2sec" width="250" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p class="barlow-regular">© 2025 NINARI Foundation. Todos los derechos reservados.</p>
        </div>
    </footer>
</template>

<style scoped>
.footer-container {
    background: linear-gradient(135deg, #551368 0%, #7b1fa2 50%, #551368 100%);
    color: white;
    padding: 2rem 2rem 2rem;
    position: relative;
    overflow: hidden;
}

.footer-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(
            circle at 20% 50%,
            rgba(255, 104, 28, 0.15) 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 80% 80%,
            rgba(135, 221, 254, 0.15) 0%,
            transparent 50%
        );
    pointer-events: none;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 3rem;
    position: relative;
    z-index: 1;
}

.footer-column {
    display: flex;
    flex-direction: column;
}

/* Logo y descripción */
.logo-section {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.footer-logo {
    width: 120px;
    margin-bottom: 1rem;
}

.logo-text {
    font-size: 1.1rem;
    line-height: 0.9;
    font-family: "Barlow-Regular", sans-serif;
    margin: 0;
}

/* Títulos */
.footer-title {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    font-family: "Barlow-Regular", sans-serif;
}

/* Links del menú */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.5rem 1rem;
    
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: white;
    text-decoration: none;
    font-size: 1.1rem;
    font-family: "Barlow-Regular", sans-serif;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #87ddfe;
    padding-left: 5px;
}

/* Contactos */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    font-family: "Barlow-Regular", sans-serif;
    margin: 0;
}

.contact-icon {
    font-size: 1.2rem;
}

/* Redes sociales */
.social-icons {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.social-link {
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-3px);
}

.social-link img {
    width: 45px;
    height: 45px;
}

/* Dirección */
.address {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-family: "Barlow-Regular", sans-serif;
}

.btn-mapa {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.8);
    color: white;
    padding: 0.6rem 1.5rem;
    border-radius: 20px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: "Barlow-Bold", sans-serif;
    align-self: flex-start;
}

.btn-mapa:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: white;
    transform: translateY(-2px);
}

/* Copyright */
.footer-bottom {
    max-width: 1200px;
    margin: 3rem auto 0;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    text-align: center;
    position: relative;
    z-index: 1;
    
}
.barlow-regular {
    font-family: 'Barlow-Regular', sans-serif;
}
.footer-bottom p {
    font-size: 0.95rem;
    font-family: "Barlow-Regular", sans-serif;
    margin: 0;
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 1024px) {
    .footer-content {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .footer-container {
        padding: 3rem 1.5rem 1.5rem;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 2.5rem;
    }

    .footer-title {
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .footer-links a {
        font-size: 1rem;
    }

    .social-link {
        width: 40px;
        height: 40px;
    }

    .social-link img {
        width: 20px;
        height: 20px;
    }

    .footer-bottom {
        margin-top: 2rem;
        padding-top: 1.5rem;
    }

    .footer-bottom p {
        font-size: 0.85rem;
    }
}
</style>
