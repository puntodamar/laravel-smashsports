import { FacebookIcon, InstagramIcon, TiktokIcon, XIcon, YoutubeIcon } from './icons.js';
import { ShoppingCartIcon, PencilSquareIcon, BuildingStorefrontIcon, PhoneIcon,  } from '@heroicons/vue/24/outline';
import { route } from 'ziggy-js';
import { markRaw } from 'vue';

export default {
    main: [
        { name: 'Booking', routeName: 'schedule.booking', href: route('schedule.booking'),  icon: markRaw(PencilSquareIcon) },
        { name: 'Toko', routeName: 'store.index', href: route('store.index'), icon: markRaw(BuildingStorefrontIcon) },
        { name: 'Resto', href: '#', icon: markRaw(ShoppingCartIcon) },
        { name: 'Kontak', href: '#', icon:  markRaw(PhoneIcon) },
    ],
    social: [
        {
            name: 'Facebook',
            href: '#',
            icon: markRaw(FacebookIcon) ,
        },

        {
            name: 'Instagram',
            href: '#',
            icon: markRaw(InstagramIcon) ,
        },
        {
            name: 'X',
            href: '#',
            icon: markRaw(XIcon) ,
        },

        {
            name: 'YouTube',
            href: '#',
            icon: markRaw(YoutubeIcon) ,
        },
        {
            name: 'Tiktok',
            href: '#',
            icon: markRaw(TiktokIcon) ,
        },
    ],
};
