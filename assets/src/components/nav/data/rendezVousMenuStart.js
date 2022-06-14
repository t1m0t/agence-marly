const rendezVousMenuStart = [
    {
        id: 1,
        values: {
            type: 'dropdownLink',
            content: 'Rendez-vous',
            items: [
                { id: 11, values: { type: 'link', content: 'Prendre un rendez-vous', ref: '/app/prendre-rendez-vous' } },
                {
                    id: 12,
                    values: { type: 'link', content: 'Mes rendez-vous', ref: '/app/mes-rendez-vous' }
                },

            ]
        }
    }
]

export default rendezVousMenuStart
