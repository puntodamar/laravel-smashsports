// Full-screen ripple that starts at the click point and expands outward.
// Call returned function with (event, onMidpoint) where onMidpoint toggles your theme.

export function useRippleToggle(options = {}) {
    const {
        // Compute the fill color dynamically (e.g., based on current theme)
        getFillColor = () => '#000000',
        duration = 550,         // ms
        opacity = 0.9,
        zIndex = 9999,
    } = options

    // Returns a handler: (MouseEvent|KeyboardEvent, onMidpoint?: () => void) => void
    return (e, onMidpoint) => {
        // Respect reduced motion
        if (typeof window !== 'undefined' &&
            window.matchMedia?.('(prefers-reduced-motion: reduce)').matches) {
            onMidpoint?.()
            return
        }

        const vw = window.innerWidth
        const vh = window.innerHeight

        // Compute origin (click point if mouse; otherwise button center)
        let x, y
        const target = e?.currentTarget
        if (e && 'clientX' in e && typeof e.clientX === 'number') {
            x = e.clientX
            y = e.clientY
        } else if (target && target.getBoundingClientRect) {
            const rect = target.getBoundingClientRect()
            x = rect.left + rect.width / 2
            y = rect.top + rect.height / 2
        } else {
            x = vw / 2
            y = vh / 2
        }

        // Max radius: distance to farthest viewport corner
        const maxX = Math.max(x, vw - x)
        const maxY = Math.max(y, vh - y)
        const radius = Math.hypot(maxX, maxY)
        const size = radius * 2

        const fillColor = getFillColor()

        // Build the ripple node
        const ripple = document.createElement('div')
        Object.assign(ripple.style, {
            position: 'fixed',
            left: `${x}px`,
            top: `${y}px`,
            width: `${size}px`,
            height: `${size}px`,
            transform: 'translate(-50%, -50%) scale(0)',
            borderRadius: '99999px',
            background: fillColor,
            opacity: String(opacity),
            pointerEvents: 'none',
            zIndex: String(zIndex),
            transition: `transform ${duration}ms ease-out, opacity ${duration + 150}ms ease-out`,
        })
        document.body.appendChild(ripple)

        // Animate
        requestAnimationFrame(() => {
            ripple.style.transform = 'translate(-50%, -50%) scale(1)'
            ripple.style.opacity = '0'
        })

        // Fire your action near the beginning (feels snappy)
        window.setTimeout(() => onMidpoint?.(), Math.min(140, duration / 3))

        // Cleanup
        window.setTimeout(() => ripple.remove(), duration + 200)
    }
}
