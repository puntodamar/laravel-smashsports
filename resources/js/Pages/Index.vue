<template>
    <Header></Header>
    <Hero></Hero>
    <Feature
        hook="Rasakan"
        title="Lapangan Berstandar Internasional"
        description="Permukaan berkualitas turnamen, pencahayaan pro-grade, dan ruang nyaman—dirancang untuk latihan, sparring, hingga mini-kompetisi"
        :image="lapangan"
        :features="featureLapangan"
        image-position="left">
    </Feature>

    <Feature
        hook="Premium Sport Vibe"
        title="Gear Terbaik, Harga Tepat, Paling Kalcer"
        description="Raket terbaru, apparel performa, sepatu court stabil—koleksi lengkap dengan harga kompetitif setiap hari"
        :image="store"
        :features="featureToko"
        image-position="right">
    </Feature>

    <Feature
        hook="Makanan Enak"
        title="Isi Energi, Pulihkan Tenaga"
        description="Dari sarapan ringan hingga makan setelah rally, kami sajikan menu segar, rasa mantap, dan porsi pas atlet—langsung di dalam pusat badminton."
        :image="resto"
        :features="featureResto"
        image-position="left">
    </Feature>

    <Footer></Footer>
</template>

<script setup>
// (Optional) remove unused imports to avoid linter warnings
import Footer from '@/components/layout/Footer.vue'
import Header from '@/components/layout/Header.vue'

// Use your alias if configured; otherwise keep your relative path
import bgMobile from '../../assets/images/background/bg-hero-mobile.jpg'
import bgDesktop from '../../assets/images/background/bg-hero-desktop.jpg'
import lapangan from '../../assets/images/background/lapangan.jpg'
import store from '../../assets/images/background/store.jpg'
import resto from '../../assets/images/background/restaurant.jpg'
import Hero from '@/components/layout/Hero.vue';
import Feature from '@/components/layout/Feature.vue';
import { FireIcon, HeartIcon, LightBulbIcon } from '@heroicons/vue/20/solid/index.js';

// Pre-wrap as CSS-ready strings
const bgMobileCss  = `url(${bgMobile})`
const bgDesktopCss = `url(${bgDesktop})`


const featureLapangan = [
    {
        name: 'Standar BWF',
        description:
            'empat lapangan dengan garis, permukaan, dan jarak aman sesuai acuan kompetisi',
        icon: FireIcon,
    },
    {
        name: 'Cahaya Konsisten',
        description: 'pencahayaan pro-grade yang minim silau untuk rally lebih presisi',
        icon: LightBulbIcon,
    },
    {
        name: 'Ruang Nyaman',
        description: 'area tunggu ber-AC, loker, shower, dan air minum isi ulang',
        icon: HeartIcon,
    },
]

const featureToko = [
    {
        name: 'Koleksi lengkap',
        description:
            'tersedia raket, sepatu, grip dll dari harga murah hingga sultan. Dijamin ori!',
        icon: FireIcon,
    },
    {
        name: 'Harga Terbaik',
        description: 'jadilah member untuk mendapatkan harga promo dan penawaran menarik',
        icon: LightBulbIcon,
    },
    {
        name: 'Jasa Pasang Senar',
        description: 'bisa pasang senar dari berbagai macam merk. Standar BWF.',
        icon: HeartIcon,
    },
]

const featureResto = [
    {
        name: 'Menu untuk pemain',
        description:
            'karbo cerdas, protein tinggi, dan opsi rendah minyak',
        icon: FireIcon,
    },
    {
        name: 'Nyaman buat tim',
        description: 'area duduk lega, bisa pre-order untuk rombongan',
        icon: LightBulbIcon,
    },
    {
        name: 'Cepat & hangat',
        description: 'pesanan keluar cepat di jam sibuk pertandingan',
        icon: HeartIcon,
    },
]



</script>

<style scoped>
.hero{
    position: relative;
    isolation: isolate;      /* keeps the pseudo inside this section */
    min-height: 60vh;
}

/* Put the image on ::before and darken it */
.hero::before{
    content: "";
    position: absolute;
    inset: 0;
    background-image: v-bind('bgMobileCss');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: brightness(.3);   /* ≈ Tailwind brightness-50 */
    z-index: -1;              /* keep it behind content */
}

@media (min-width: 768px){
    .hero::before{ background-image: v-bind('bgDesktopCss'); }
}
</style>

