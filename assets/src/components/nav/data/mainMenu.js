const mainMenu = [
  { id: 1, values: { type: 'link', content: 'Nos Biens', ref: '/nos-biens' } },
  {
    id: 2,
    values: {
      type: 'dropdownLink',
      content: 'Liens Supplémentaires',
      items: [
        { id: 21, values: { type: 'link', content: 'A Propos', ref: '/a-propos' } },
        {
          id: 22,
          values: { type: 'link', content: 'Nous Contacter', ref: '/nous-contacter' }
        },
        { id: 23, values: { type: 'hr' } },
        {
          id: 24,
          values: { type: 'link', content: 'Rapporter une erreur', ref: '/rapporter-erreur' }
        }
      ]
    }
  }
]

export default mainMenu
