const errorCodes = {
  10002: `Le format de l'email est invalide.`,
  10003: 'Le format du mot de passe est invalide.',
  10004: `L'année de naissance est invalide.`,
  10005: `L'email est manquant.`,
  10006: `Le mot de passe est manquant`,
  10007: 'Genre invalide.',
  10009: 'Code postal invalide.',
  10013: 'Consentement invalide.',
  10014: `Déclaration sur l'honneur invalide`,
  10018: 'Prénom invalide.',
  10019: 'Nom invalide.',
  20001: 'Une erreur est survenue.',
  20002: 'Cet email existe déjà en base de donnée.',
  30001: 'Une erreur est survenue.',
  30003: 'Email ou mot de passe invalide.',
  30004: 'Connexion impossible. Cet email est bloqué.',
  50003: 'Le mois de naissance est invalide.',
  50004: 'Le jour de naissance est invalide.',
  70001: 'Une erreur est survenue.',
  70002: 'Aucun utilisateur ne correspond à cet email.',
  80001: 'Une erreur est survenue.',
  80002: 'Le lien pour la réinitialisation du mot de passe a expiré.',
}

const getErrorMessage = (code, details) => {
  if (code === '20001' && Object.keys(details)[0]) {
    return errorCodes[details[Object.keys(details)[0]].errorCode]
  }

  if (errorCodes[code]) {
    return errorCodes[code]
  } else {
    return 'Une erreur est survenue.'
  }
}

export default getErrorMessage
