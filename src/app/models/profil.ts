export class Profil {
    nom: string = "";
    prenom: string = "";
    mail: string = "";
    adresse_rue: string = "";
    adresse_cp: string = "";
    adresse_ville: string = "";
    telephone: string = "";
    date_naissance: string = "";
    NEPH: string = "";
    login: string = "";
    mdp: string = "";
    id_personne: string = "";

  fullProfil(): string {
    return `${this.prenom} ${this.nom}`;
  }


}
