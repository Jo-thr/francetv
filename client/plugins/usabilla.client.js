/* eslint-disable */
export default ({ app }) => {
  if (app.$config.USABILLA_ID) {
    /* {literal}<![CDATA[ */ window.lightningjs ||
      (function (c) {
        function g(b, d) {
          d && (d += (/\?/.test(d) ? '&' : '?') + 'lv=1')
          c[b] ||
            (function () {
              const i = window
              const h = document
              const j = b
              const g = h.location.protocol
              const l = 'load'
              let k = 0
              ;(function () {
                function b() {
                  a.P(l)
                  a.w = 1
                  c[j]('_load')
                }
                c[j] = function () {
                  function m() {
                    m.id = e
                    return c[j].apply(m, arguments)
                  }
                  let b
                  var e = ++k
                  b = this && this != i ? this.id || 0 : 0
                  ;(a.s = a.s || []).push([e, b, arguments])
                  m.then = function (b, c, h) {
                    const d = (a.fh[e] = a.fh[e] || [])
                    const j = (a.eh[e] = a.eh[e] || [])
                    const f = (a.ph[e] = a.ph[e] || [])
                    b && d.push(b)
                    c && j.push(c)
                    h && f.push(h)
                    return m
                  }
                  return m
                }
                var a = (c[j]._ = {})
                a.fh = {}
                a.eh = {}
                a.ph = {}
                a.l = d
                  ? d.replace(/^\/\//, (g == 'https:' ? g : 'http:') + '//')
                  : d
                a.p = { 0: +new Date() }
                a.P = function (b) {
                  a.p[b] = new Date() - a.p[0]
                }
                a.w && b()
                i.addEventListener
                  ? i.addEventListener(l, b, !1)
                  : i.attachEvent('on' + l, b)
                var q = function () {
                  function b() {
                    return [
                      '<head></head><',
                      c,
                      ' onload="var d=',
                      n,
                      ";d.getElementsByTagName('head')[0].",
                      d,
                      '(d.',
                      g,
                      "('script')).",
                      i,
                      "='",
                      a.l,
                      '\'"></',
                      c,
                      '>',
                    ].join('')
                  }
                  var c = 'body'
                  const e = h[c]
                  if (!e) return setTimeout(q, 100)
                  a.P(1)
                  var d = 'appendChild'
                  var g = 'createElement'
                  var i = 'src'
                  const k = h[g]('div')
                  const l = k[d](h[g]('div'))
                  const f = h[g]('iframe')
                  var n = 'document'
                  let p
                  k.style.display = 'none'
                  e.insertBefore(k, e.firstChild).id = o + '-' + j
                  f.frameBorder = '0'
                  f.id = o + '-frame-' + j
                  ;/MSIE[ ]+6/.test(navigator.userAgent) &&
                    (f[i] = 'javascript:false')
                  f.allowTransparency = 'true'
                  l[d](f)
                  try {
                    f.contentWindow[n].open()
                  } catch (s) {
                    ;(a.domain = h.domain),
                      (p =
                        'javascript:var d=' +
                        n +
                        ".open();d.domain='" +
                        h.domain +
                        "';"),
                      (f[i] = p + 'void(0);')
                  }
                  try {
                    const r = f.contentWindow[n]
                    r.write(b())
                    r.close()
                  } catch (t) {
                    f[i] =
                      p +
                      'd.write("' +
                      b().replace(/"/g, String.fromCharCode(92) + '"') +
                      '");d.close();'
                  }
                  a.P(2)
                }
                a.l && setTimeout(q, 0)
              })()
            })()
          c[b].lv = '1'
          return c[b]
        }
        var o = 'lightningjs'
        const k = (window[o] = g(o))
        k.require = g
        k.modules = c
      })({})
    window.usabilla_live = lightningjs.require(
      'usabilla_live',
      `//w.usabilla.com/${app.$config.USABILLA_ID}.js`
    ) /* ]]>{/literal} */
  }
}
