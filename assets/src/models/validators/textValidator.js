const regex = /^[0-9a-zA-Z ]{1,500}?$/

const textValidator = input => {
  var re = regex
  return re.test(input)
}

export default textValidator
