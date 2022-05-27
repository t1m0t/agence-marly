import axios from "axios"

function protectedRoutes(to) {
  return true
  /* const { reponseCode } = axios.get(to, { validateStatus: () => true })
  if (reponseCode === 403) {
    return {
      path: '/connexion',
      query: { redirect: to.fullPath }
    }
  } */
}

export default protectedRoutes