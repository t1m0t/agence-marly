const regex = new RegExp(
  '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{10,})'
)

const passwordValidator = input => {
  var re = regex
  return re.test(input)
}

export default passwordValidator
