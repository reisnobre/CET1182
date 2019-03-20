import { masterApiDomain } from './api'
export const login = masterApiDomain + 'oauth/token'

/**
  * ### getHeader ###
  * @description A function based on the pattern of login, that get the tokenData and
  * returns a default header for secure api calls
  * @author Eduardo Reis Nobre
  * @return {Object} return headers
  * @version * 1.0
  * @requires * The following of the login via OAuth2 pattern defined as default
*/
export const getHeader = function () {
  const tokenData = JSON.parse(window.localStorage.getItem('authTokens'))
  const headers = {
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + tokenData.access_token
  }
  return headers
}
