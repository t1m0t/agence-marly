const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

function emailValidator (email) {
  var re = regex
  return re.test(email)
}

export default emailValidator
