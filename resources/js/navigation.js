import { FacebookIcon, InstagramIcon, XIcon, YoutubeIcon } from './icons.js';
import { ShoppingCartIcon, PencilSquareIcon, BuildingStorefrontIcon, PhoneIcon,  } from '@heroicons/vue/24/outline';

export default {
    main: [
        { name: 'Booking', href: '#booking', icon: PencilSquareIcon },
        { name: 'Toko', href: '#', icon: ShoppingCartIcon },
        { name: 'Resto', href: '#', icon: BuildingStorefrontIcon },
        { name: 'Kontak', href: '#', icon:  PhoneIcon },
    ],
    social: [
        {
            name: 'Facebook',
            href: '#',
            icon: FacebookIcon,
        },

        {
            name: 'Instagram',
            href: '#',
            icon: InstagramIcon,
        },
        {
            name: 'X',
            href: '#',
            icon: XIcon,
        },

        {
            name: 'YouTube',
            href: '#',
            icon: YoutubeIcon,
        },
    ],
};
