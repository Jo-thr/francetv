import LocalScheme from '@nuxtjs/auth/lib/schemes/local'
import { parseJwt, generateHmac, parseHeaders } from '~/utils/auth/auth'

export default class GinProxy extends LocalScheme {
  async fetchUser(endpoint) {
    if (process.server) return

    if (localStorage.getItem('auth._token.gin') === 'false') {
      this.$auth.reset()
      return false
    }

    const parsedJwt = parseJwt(localStorage.getItem('auth._token.gin'))

    const fetchUrl = `${this.options.endpoints.user.url}/${parsedJwt.userId}`

    const data = {
      ...endpoint,
      headers: {
        ...parseHeaders(this.options.headers),
        'X-Refresh-Token': localStorage.getItem('auth._refresh_token.gin'),
        'X-HMAC-Signature': generateHmac('user', this.options.headers),
        Authorization: `Bearer ${localStorage.getItem('auth._token.gin')}`,
      },
    }

    let user = {}

    try {
      user = await this.$auth.requestWith('gin', data, {
        ...this.options.endpoints.user,
        url: fetchUrl,
      })
    } catch (e) {
      return this.$auth.reset()
    }

    const customUser = {
      ...user,
      fullName: user.firstName + ' ' + user.lastName,
      id: parsedJwt.userId,
      roles: ['user'],
    }

    this.$auth.setUser(customUser)
  }

  mounted() {
    this.$auth.fetchUserOnce()
  }

  async login(endpoint) {
    if (process.server) return

    localStorage.setItem('auth._token.gin', null)
    localStorage.setItem('auth._refresh_token.gin', null)

    const data = {
      ...endpoint,
      headers: {
        ...endpoint.headers,
        ...parseHeaders(this.options.headers),
        'X-HMAC-Signature': generateHmac(
          'login',
          {
            ...this.options.headers,
          },
          {
            ...endpoint.data,
          }
        ),
      },
    }
    await this.$auth.reset()

    const { response } = await this.$auth.request(
      data,
      this.options.endpoints.login,
      true
    )

    if (this.options.tokenRequired) {
      localStorage.setItem('auth._token.gin', response.data.access_token)
      localStorage.setItem(
        'auth._refresh_token.gin',
        response.data.refresh_token
      )
    }

    if (this.options.autoFetchUser) {
      await this.fetchUser()
    }

    return response
  }

  async logout(endpoint) {
    const parsedJwt = parseJwt(localStorage.getItem('auth._token.gin'))

    this.options.endpoints.logout.url = `${this.options.endpoints.logout.url}/${parsedJwt.userId}`

    const data = {
      ...endpoint,
      headers: {
        ...parseHeaders(this.options.headers),
        'X-Refresh-Token': localStorage.getItem('auth._refresh_token.gin'),
        'X-HMAC-Signature': generateHmac('logout', this.options.headers),
        Authorization: `Bearer ${localStorage.getItem('auth._token.gin')}`,
      },
    }

    if (this.options.endpoints.logout) {
      await this.$auth
        .requestWith('gin', data, this.options.endpoints.logout)
        .catch(() => {})
    }

    return this.$auth.reset()
  }

  reset() {
    if (this.options.tokenRequired) {
      this._clearToken()
    }

    this.$auth.setUser(false)
    this.$auth.setToken(this.name, false)
    this.$auth.setRefreshToken(this.name, false)

    return Promise.resolve()
  }
}
