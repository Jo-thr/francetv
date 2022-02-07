import { extend, localize } from 'vee-validate'

const defaultErrorMessage = {
  email: {
    fr: 'Veuillez saisir une adresse email valide',
    en: 'Please enter a valid email address',
  },
  birth: {
    fr: 'Veuillez saisir une date de naissance valide',
    en: 'Please enter a valid date of birth',
  },
  zip_code: {
    fr: 'Veuillez saisir un code postal français valide',
    en: 'Please enter a valid French postal code',
  },
}

export default ({ app }) => {
  extend('password', {
    params: ['target'],
    validate(value, { target }) {
      return value === target
    },
  })

  extend('emailftv', (value) => {
    if (!/^[-+&_.a-zA-Z0-9]+@[-.a-zA-Z0-9]+\.[a-zA-Z]{2,6}$/.test(value)) {
      return false
    } else if (!/^(?:(?!voila.fr|gmail.fr).)*$\r?\n?/.test(value)) {
      return false
    } else if (value.includes('++')) {
      return false
    } else if (value.includes('?')) {
      return false
    } else {
      return true
    }
  })
  extend('date', (value) => {
    return app.$dayjs(value).isValid()
  })
  extend('minimumAge', (value) => {
    return app.$dayjs(value).isBefore(app.$dayjs().subtract(16, 'year'))
  })
  extend('limitAge', (value) => {
    return app.$dayjs(value).isAfter(app.$dayjs().subtract(105, 'year'))
  })
}

localize({
  en: {
    names: {
      email: 'email',
      password: 'password',
      password_confirmation: 'password confirmation',
      birth: 'year of birth',
      zip_code: 'zip code',
      gender: 'gender',
      firstname: 'firstname',
      lastname: 'lastname',
    },
    fields: {
      email: {
        required: defaultErrorMessage.email.en,
        email: defaultErrorMessage.email.en,
        emailftv: defaultErrorMessage.email.en,
        regex: defaultErrorMessage.email.en,
      },
      password: {
        password: 'Password confirmation does not match',
        regex:
          'The password must contain at least: 1 capital letter, 1 number and 1 special character',
      },
      birth: {
        required: defaultErrorMessage.birth.en,
        digits: defaultErrorMessage.birth.en,
        minimumAge: 'You must be at least 16 years of age to register',
        limitAge: defaultErrorMessage.birth.en,
      },
      zip_code: {
        required: defaultErrorMessage.zip_code.en,
        digits: defaultErrorMessage.zip_code.en,
        between: defaultErrorMessage.zip_code.en,
      },
    },
  },
  fr: {
    names: {
      email: 'e-mail',
      password: 'mot de passe',
      password_confirmation: 'confirmation du mot de passe',
      birth: 'année de naissance',
      zip_code: 'code postal',
      gender: 'civilité',
      firstname: 'prénom',
      lastname: 'nom',
    },
    fields: {
      email: {
        required: defaultErrorMessage.email.fr,
        email: defaultErrorMessage.email.fr,
        emailftv: defaultErrorMessage.email.fr,
        regex: defaultErrorMessage.email.fr,
      },
      password: {
        password: 'Les mots de passes ne correspondent pas',
        regex:
          'Le mot de passe doit contenir au minimum : 1 majuscule, 1 chiffre et 1 caractère spécial',
      },
      birth: {
        required: defaultErrorMessage.birth.fr,
        digits: defaultErrorMessage.birth.fr,
        minimumAge:
          "Vous devez être âgé(e) d'au moins 16 ans pour vous inscrire",
        limitAge: defaultErrorMessage.birth.fr,
      },
      zip_code: {
        required: defaultErrorMessage.zip_code.fr,
        digits: defaultErrorMessage.zip_code.fr,
        between: defaultErrorMessage.zip_code.fr,
      },
    },
  },
})
