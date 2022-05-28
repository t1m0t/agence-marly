const menuStartItems = [
  //{ id: 1, values: { type: 'link', content: 'Qui sommes-nous ?', ref: '/qui-sommes-nous' } },
  { id: 2, values: { type: 'link', content: 'Nos Biens', ref: '/nos-biens' } },
  {
    id: 3,
    values: {
      type: 'dropdownLink',
      content: 'Liens Supplémentaires',
      items: [
        { id: 31, values: { type: 'link', content: 'A Propos', ref: '/a-propos' } },
        {
          id: 32,
          values: { type: 'link', content: 'Nous Contacter', ref: '/nous-contacter' }
        },
        { id: 33, values: { type: 'hr' } },
        {
          id: 34,
          values: { type: 'link', content: 'Rapporter une erreur', ref: '/rapporter-erreur' }
        }
      ]
    }
  }
]

export default menuStartItems
