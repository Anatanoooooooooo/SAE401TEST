import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../../services/api/api.service';
import { Profil } from '../../../models/profil';
import { ProfilAE } from '../../../models/profil-ae';


@Component({
  selector: 'app-dashboard',
  standalone: false,
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent {
  profiles: Profil[] = []; // Liste des candidats
  profilesAE: ProfilAE[] = []; // Liste des auto-écoles

  constructor(private apiService: ApiService, private router: Router) {}

  ngOnInit(): void {
    this.loadProfiles(); // Charger les profils
    this.loadProfilesAE(); // Charger les auto-écoles
  }

  // Charger les candidats
  loadProfiles() {
    this.apiService.getDataCandidats().subscribe(
      (data: any[]) => {
        console.log('Données des candidats reçues :', data);
        this.profiles = data; // Assurez-vous que chaque élément contient les bonnes propriétés
      },
      error => {
        console.error('Erreur lors de la récupération des candidats :', error);
      }
    );
  }
  

  // Charger les auto-écoles
  loadProfilesAE() {
    this.apiService.getDataAutoecole().subscribe(
      (data: ProfilAE[]) => {
        this.profilesAE = data;
      },
      error => {
        console.error('Erreur lors de la récupération des auto-écoles', error);
      }
    );
  }

  ajoutProfil() {
    this.router.navigate(['/ajout-profile']); // Chemin vers le composant AjoutProfileComponent
  }

  // Modifier un profil
  modifProfil(profil: Profil | ProfilAE): void {
    this.router.navigate(['/modifier-profile', profil.id_personne]); // Redirection avec l'ID
  }
  

  supprProfil(profil: any, apiType: string) {
    console.log('Objet reçu pour suppression :', profil);
  
    if (!profil.id_personne) {
      console.error('ID du profil manquant');
      return;
    }
  
    if (confirm(`Voulez-vous vraiment supprimer l'élément ID: ${profil.id_personne} ?`)) {
      if (apiType === 'candidat') {
        console.log('Suppression d\'un candidat avec l\'ID :', profil.id_personne);
        this.apiService.deleteDataCandidat(profil.id_personne).subscribe(
          response => {
            console.log('Réponse réussie de l\'API :', response);
            alert('Candidat supprimé avec succès');
            this.loadProfiles();
          },
          error => {
            console.error('Erreur lors de la suppression du candidat :', error);
          }
        );
      } else if (apiType === 'autoecole') {
        console.log('Suppression d\'une auto-école avec l\'ID :', profil.id_personne);
        this.apiService.deleteDataAutoecole(profil.id_personne).subscribe(
          response => {
            console.log('Réponse réussie de l\'API :', response);
            alert('Auto-école supprimée avec succès');
            this.loadProfilesAE();
          },
          error => {
            console.error('Erreur lors de la suppression de l\'auto-école :', error);
          }
        );
      }
    }
  }
}  
