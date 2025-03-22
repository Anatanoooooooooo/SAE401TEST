import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  standalone: false,
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent {
  nomProfile: string = "Nom profile";

  nom: string = "";
  prenom: string = "";
  mail: string = "";
  adresse: string = "";
  codePostale: string = "";
  telephone: string = "";
  login: string = "";
  password: string = "";

  constructor(private router: Router) {}

  confirmer() {
    console.log("Données sauvegardées :", {
      nom: this.nom,
      prenom: this.prenom,
      mail: this.mail,
      adresse: this.adresse,
      codePostale: this.codePostale,
      telephone: this.telephone,
      login: this.login,
      password: this.password
    });
    alert("Informations confirmées !");
  }

  retour() {
    this.router.navigate(['/']);
  }
}

