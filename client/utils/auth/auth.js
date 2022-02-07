import crypto from 'crypto'
import base64Url from 'base64-url'
import axios from 'axios'

export const register = async (data, gin) => {
  const env = {
    ...gin,
    contentType: 'application/json',
  }

  const config = {
    headers: {
      ...parseHeaders(env),
      'X-HMAC-Signature': generateHmac('register', env, data),
    },
  }

  return await axios.post(
    `${env.endpoint}/v3/${env.app}/user/register`,
    data,
    config
  )
}

export const passwordReset = async (data, gin) => {
  const env = {
    ...gin,
    contentType: 'application/json',
  }

  const config = {
    headers: {
      ...parseHeaders(env),
      'X-HMAC-Signature': generateHmac('password', env, data),
    },
  }

  return await axios.post(
    `${env.endpoint}/v3/${env.app}/user/forgot-password`,
    data,
    config
  )
}

export const generateHmac = (path, config, body = null) => {
  const contentOptions = {}

  const { xuser, hmacKey, app } = config

  if (path !== 'login' && path !== 'register' && path !== 'password') {
    contentOptions.accessToken = localStorage.getItem('auth._token.gin')

    const token = parseJwt(contentOptions.accessToken)
    const userId = token.userId

    contentOptions.path = constructPath(path, app, userId)

    contentOptions.refreshToken = localStorage.getItem(
      'auth._refresh_token.gin'
    )
  } else {
    contentOptions.path = constructPath(path, app)
  }

  if (body) {
    contentOptions.requestBody = body
  }

  contentOptions.proxyUserId = xuser

  const content = JSON.stringify(sortObject(contentOptions))

  return base64Url.escape(
    crypto.createHmac('sha256', hmacKey).update(content).digest('base64')
  )
}

export const parseJwt = (token) => {
  const base64Payload = token.split('.')[1]
  if (!base64Payload) return false
  const payload = Buffer.from(base64Payload, 'base64')
  return JSON.parse(payload.toString())
}

const constructPath = (key, app, userId = null) => {
  switch (key) {
    case 'login':
      return `/v3/${app}/user/login`
    case 'user':
      return `/v3/${app}/user/get-info/${userId}`
    case 'register':
      return `/v3/${app}/user/register`
    case 'password':
      return `/v3/${app}/user/forgot-password`
    case 'logout':
      return `/v3/${app}/user/logout/${userId}`
    default:
      return false
  }
}

export const parseHeaders = (headers) => {
  const { contentType, xuser, xsource } = headers
  return {
    'Content-Type': contentType,
    'X-User': xuser,
    'X-Source': xsource,
  }
}

function sortObject(obj) {
  return Object.keys(obj)
    .sort()
    .reduce(function (result, key) {
      result[key] = obj[key]
      return result
    }, {})
}
