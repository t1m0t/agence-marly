const authenticatedMenu = [
  {
    id: 1,
    values: {
      type: 'dropdownLink',
      content: 'Admin',
      items: [
        {
          id: 11,
          values: { type: 'link', content: 'Gestion des biens', ref: '/app/gestion-biens' }
        },
        {
          id: 22,
          values: { type: 'link', content: 'Gestion des utilisateurs', ref: '/app/gestion-utilisateurs' }
        },

      ]
    }
  }
]

export default authenticatedMenu
