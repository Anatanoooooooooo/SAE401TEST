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
      (data: Profil[]) => {
        this.profiles = data;
      },
      error => {
        console.error('Erreur lors de la récupération des candidats', error);
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
  

  supprProfil(profil: Profil | ProfilAE) {
    if (confirm(`Voulez-vous vraiment supprimer le profil ID: ${profil.id_personne} ?`)) {
      // Vérifiez le type de profil pour appeler la bonne méthode
      if (profil instanceof Profil) {
        // Supprimer un candidat
        this.apiService.deleteDataCandidat({ id_personne: profil.id_personne }).subscribe(
          (response) => {
              console.log('API Response:', response);
              alert('Candidat supprimé avec succès');
              this.loadProfiles(); // Recharger la liste des candidats
          },
          (error) => {
              console.error('Erreur lors de la suppression du candidat', error);
          }
      );
      
      } else if (profil instanceof ProfilAE) {
        // Supprimer une auto-école
        this.apiService.deleteDataAutoecole({ id_personne: profil.id_personne }).subscribe(
          () => {
            alert('Auto-école supprimée avec succès');
            this.loadProfilesAE(); // Recharger la liste des auto-écoles
          },
          error => {
            console.error('Erreur lors de la suppression de l\'auto-école', error);
          }
        );
      }
  
    }
  }
}

