import { defineComponent, h } from 'vue'

const UserIcon = defineComponent({
    name: 'UserIcon',
    render: () =>
        h(
            'svg',
            {
                xmlns: 'http://www.w3.org/2000/svg',
                fill: 'none',
                viewBox: '0 0 24 24',
                stroke: 'currentColor',
                'stroke-width': 1.5,
                'aria-hidden': 'true',
            },
            [
                h('path', {
                    'stroke-linecap': 'round',
                    'stroke-linejoin': 'round',
                    d: 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z',
                }),
            ]
        ),
})

const FacebookIcon = defineComponent({
    name: 'FacebookIcon',
        render: () =>
            h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                h('path', {
                    'fill-rule': 'evenodd',
                    d: 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z',
                    'clip-rule': 'evenodd',
                }),
            ]),
    })

const InstagramIcon = defineComponent({
    name: 'InstagramIcon',
    render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
                'fill-rule': 'evenodd',
                d: 'M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z',
                'clip-rule': 'evenodd',
            }),
        ]),
})

const XIcon = defineComponent({
    name: 'XIcon',
    render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
                d: 'M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z',
            }),
        ]),
})



const YoutubeIcon = defineComponent({
    name: 'YoutubeIcon',
    render: () =>
        h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
                'fill-rule': 'evenodd',
                d: 'M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z',
                'clip-rule': 'evenodd',
            }),
        ]),
})

const MoonIcon = defineComponent({
    name: 'MoonIcon',
    inheritAttrs: false,
    setup(_, { attrs }) {
        return () =>
            h(
                'svg',
                {
                    xmlns: 'http://www.w3.org/2000/svg',
                    fill: 'currentColor',
                    viewBox: '0 0 20 20',
                    ...attrs, // lets you pass class/aria/etc. from parent
                },
                [h('path', { d: 'M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z' })]
            )
    },
})

const SunIcon = defineComponent({
    name: 'SunIcon',
    inheritAttrs: false,
    setup(_, { attrs }) {
        return () =>
            h(
                'svg',
                {
                    xmlns: 'http://www.w3.org/2000/svg',
                    fill: 'currentColor',
                    viewBox: '0 0 20 20',
                    ...attrs,
                },
                [
                    h('path', {
                        d: 'M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z',
                        'fill-rule': 'evenodd',
                        'clip-rule': 'evenodd',
                    }),
                ]
            )
    },
})

const TiktokIcon = defineComponent({
    name: 'TikTokIconOutline',
    props: {
        size: { type: [Number, String], default: 24 },
        strokeWidth: { type: [Number, String], default: 1.8 },
        title: { type: String, default: 'TikTok' },
    },
    render() {
        const size = typeof this.size === 'number' ? `${this.size}` : this.size;
        const strokeWidth =
            typeof this.strokeWidth === 'number' ? `${this.strokeWidth}` : this.strokeWidth;

        // Stylized mono-outline of the TikTok note
        return h(
            'svg',
            {
                xmlns: 'http://www.w3.org/2000/svg',
                viewBox: '0 0 24 24',
                width: size,
                height: size,
                role: 'img',
                'aria-label': this.title,
                fill: 'none',
                stroke: 'currentColor',
                'stroke-width': strokeWidth,
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round',
            },
            [
                // stem + head path (built to resemble the TikTok mark in outline)
                h('path', {
                    d: [
                        // vertical stem
                        'M12 4', 'v9',
                        // transition to circle (note head) using a small arc
                        'a4 4 0 1 1 -4 4',
                        // keep outline continuous
                        'm4 -9',
                        // top-right “hook” (the short arm that follows the brand style)
                        'c0 0 1.6 2.1 5 2.4',
                        'M17 10.4',
                    ].join(' '),
                }),
                // note head circle (kept separate so stroke joins look crisp)
                h('circle', { cx: 8, cy: 17, r: 3.5 }),
            ]
        );
    },
});

const FacebookIconColor = defineComponent({
    name: 'FacebookIcon',
    props: {
        size: { type: [Number, String], default: 24 },
        title: { type: String, default: 'Facebook' },
    },
    render() {
        const size = typeof this.size === 'number' ? `${this.size}` : this.size;

        return h(
            'svg',
            {
                xmlns: 'http://www.w3.org/2000/svg',
                viewBox: '0 0 24 24',
                width: size,
                height: size,
                role: 'img',
                'aria-label': this.title,
            },
            [
                // Blue rounded-square background
                h('rect', {
                    x: 0,
                    y: 0,
                    width: 24,
                    height: 24,
                    rx: 4,
                    fill: '#1877F2',
                }),
                // White "f"
                h('path', {
                    fill: '#FFFFFF',
                    d: 'M15.5 6.75H14.2c-1.52 0-2.45.96-2.45 2.54V11H9.5v2.4h2.25V20h2.6v-6.6h2.17l.38-2.4h-2.55V9.62c0-.52.35-.87.93-.87h1.22V6.78l-.1-.03Z',
                }),
            ]
        );
    },
});

const GoogleIcon = defineComponent({
    name: 'GoogleIcon',
    props: {
        size: { type: [Number, String], default: 24 },
        title: { type: String, default: 'Google' },
    },
    render() {
        const size = typeof this.size === 'number' ? `${this.size}` : this.size;

        return h(
            'svg',
            {
                xmlns: 'http://www.w3.org/2000/svg',
                viewBox: '0 0 24 24',
                width: size,
                height: size,
                role: 'img',
                'aria-label': this.title,
            },
            [
                // Blue
                h('path', {
                    fill: '#4285F4',
                    d: 'M23.49 12.27c0-.78-.07-1.53-.2-2.27H12v4.3h6.44c-.28 1.5-1.12 2.77-2.39 3.62v3h3.86c2.26-2.08 3.59-5.14 3.59-8.65z',
                }),
                // Green
                h('path', {
                    fill: '#34A853',
                    d: 'M12 24c3.24 0 5.96-1.07 7.95-2.91l-3.86-3c-1.08.73-2.47 1.16-4.09 1.16-3.14 0-5.8-2.12-6.75-4.98H1.24v3.13C3.22 21.33 7.3 24 12 24z',
                }),
                // Yellow
                h('path', {
                    fill: '#FBBC05',
                    d: 'M5.25 14.27c-.24-.73-.38-1.51-.38-2.27s.14-1.54.38-2.27V6.6H1.24C.45 8.22 0 10.06 0 12s.45 3.78 1.24 5.4l4.01-3.13z',
                }),
                // Red
                h('path', {
                    fill: '#EA4335',
                    d: 'M12 4.75c1.76 0 3.34.6 4.58 1.78l3.43-3.43C17.95 1.25 15.23 0 12 0 7.3 0 3.22 2.67 1.24 6.6l4.01 3.13C6.2 6.87 8.86 4.75 12 4.75z',
                }),
            ]
        );
    },
});


export {UserIcon, FacebookIcon, FacebookIconColor, InstagramIcon, XIcon, YoutubeIcon, MoonIcon, SunIcon, TiktokIcon, GoogleIcon}
