<template>
    <main style="mx-auto">
        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 6px 24px rgba(0,0,0,.06);">
            <FullCalendar :options="calendarOptions" />
        </div>


    </main>
</template>


<script>
import FullCalendar from '@fullcalendar/vue3'
import resourceTimelinePlugin from '@fullcalendar/resource-timeline'
import interactionPlugin from '@fullcalendar/interaction'
import idLocale from '@fullcalendar/core/locales/id'
import { createDuration } from '@fullcalendar/core/internal';

export default {
    components: { FullCalendar },
    data() {


        return {
            calendarOptions: {
                plugins: [resourceTimelinePlugin, interactionPlugin],
                initialView: 'resourceTimelineDay', // 1-day view so columns = time
                locale: 'id', locales: [idLocale],
                timeZone: 'Asia/Jakarta',

                // columns & hours
                slotDuration: '01:00',
                slotMinTime: '08:00:00',
                slotMaxTime: '24:00:00',
                slotLabelContent(arg) {
                    const start = arg.view.calendar.formatDate(arg.date, { hour: '2-digit', hour12: false })
                    const endDate = arg.view.dateEnv.add(arg.date, createDuration({ hours: 1 }))
                    let end = arg.view.calendar.formatDate(endDate, { hour: '2-digit', hour12: false })
                    if (end === '00') end = '24'
                    return `${start}-${end}`
                },
                slotMinWidth: 48,

                // expandRows: true,
                height: 'auto',
                resourceAreaWidth: 260,
                resourceAreaColumns: [{ field: 'title', headerContent: 'HARI / LAPANGAN' }],
                resourceOrder(a, b) {
                    const getOrd = (r) =>
                        r && r.extendedProps && Number.isFinite(r.extendedProps.ord)
                            ? r.extendedProps.ord
                            : 0
                    return getOrd(a) - getOrd(b)
                },
                resources: [
                    { id: 'mon', title: 'Senin',  extendedProps: { ord: 1 }, children: [
                            { id: 'mon-1', title: 'Court 1' }, { id: 'mon-2', title: 'Court 2' }
                        ]},
                    { id: 'tue', title: 'Selasa', extendedProps: { ord: 2 }, children: [
                            { id: 'tue-1', title: 'Court 1' }, { id: 'tue-2', title: 'Court 2' }
                        ]},
                    { id: 'wed', title: 'Rabu',   extendedProps: { ord: 3 }, children: [
                            { id: 'wed-1', title: 'Court 1' }, { id: 'wed-2', title: 'Court 2' }
                        ]},
                    { id: 'thu', title: 'Kamis',  extendedProps: { ord: 4 }, children: [
                            { id: 'thu-1', title: 'Court 1' }, { id: 'thu-2', title: 'Court 2' }
                        ]},
                    { id: 'fri', title: 'Jumat',  extendedProps: { ord: 5 }, children: [
                            { id: 'fri-1', title: 'Court 1' }, { id: 'fri-2', title: 'Court 2' }
                        ]},
                    { id: 'sat', title: 'Sabtu',  extendedProps: { ord: 6 }, children: [
                            { id: 'sat-1', title: 'Court 1' }, { id: 'sat-2', title: 'Court 2' }
                        ]},
                    { id: 'sun', title: 'Minggu', extendedProps: { ord: 7 }, children: [
                            { id: 'sun-1', title: 'Court 1' }, { id: 'sun-2', title: 'Court 2' }
                        ]},
                ],

                // sample
                events: [
                    { title:'PB Berbagi Senyum', start:'2025-09-06T09:00:00', end:'2025-09-06T14:00:00', resourceId:'mon-1' },
                    { title:'Hendra', start:'2025-09-06T09:00:00', end:'2025-09-06T10:00:00', resourceId:'mon-2' },
                    { title:'Happy Minton', start:'2025-09-06T08:00:00', end:'2025-09-06T10:00:00', resourceId:'tue-1' },
                    { title:'Happy Minton', start:'2025-09-06T09:00:00', end:'2025-09-06T11:00:00', resourceId:'tue-2' },
                    { title:'Gaston', start:'2025-09-06T10:00:00', end:'2025-09-06T14:00:00', resourceId:'tue-1', extendedProps:{ status:'member' } },
                ],
                eventDidMount({ el, event }) {
                    const m = {
                        pending: { bg:'#f59e0b', br:'#b45309' },
                        member:    { bg:'#10b981', br:'#047857' },
                    }
                    const st = event.extendedProps.status
                    if (m[st]) {
                        el.style.backgroundColor = m[st].bg
                        el.style.borderColor = m[st].br
                        el.style.color = '#fff'
                    }
                },
            }
        }
    }
}
</script>
