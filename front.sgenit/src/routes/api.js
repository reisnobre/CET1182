const env = process.env.NODE_ENV
export const masterApiDomain = env === 'development' ? 'http://nit.uesc.br/sgenit/back/public/index.php' : 'http://nit.uesc.br/sgenit/back/public/index.php'
const masterApiEndPoint = masterApiDomain + 'api/'
const apiVersion = 'v1/'
const masterApiDomainSecure = masterApiEndPoint + apiVersion

export const bonds = masterApiDomainSecure + 'bonds'
export const event = masterApiDomainSecure + 'event'
export const events = masterApiDomainSecure + 'events'
export const privateEvents = masterApiDomainSecure + 'p-events'
export const privateEvent = masterApiDomainSecure + 'p-event'
export const footer = masterApiDomainSecure + 'footer'
export const footers = masterApiDomainSecure + 'footers'
export const inscriptions = masterApiDomainSecure + 'inscriptions'
export const inscription = masterApiDomainSecure + 'inscription'
export const genres = masterApiDomainSecure + 'genres'
export const login = masterApiDomain + 'oauth/token'
export const template = masterApiDomainSecure + 'template'
export const templates = masterApiDomainSecure + 'templates'
export const user = masterApiDomainSecure + 'user'
export const users = masterApiDomainSecure + 'users'

// admin routes
export const createSu = masterApiDomainSecure + 'create-users'
