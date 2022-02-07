export default function ({ app, $auth }) {
  $auth.options.redirect = {
    login: app.localePath({ name: 'connexion' }),
    logout: app.localePath({ name: 'index' }),
    callback: app.localePath({ name: 'connexion' }),
    home: app.localePath({ name: 'index' }),
  }
}
