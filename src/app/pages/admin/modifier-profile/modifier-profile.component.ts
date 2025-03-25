import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { ApiService } from '../../../services/api/api.service';
import { Profil } from '../../../models/profil';
import { ProfilAE } from '../../../models/profil-ae';

@Component({
  selector: 'app-modifier-profile',
  standalone: false,
  templateUrl: './modifier-profile.component.html',
  styleUrl: './modifier-profile.component.css'
})
export class ModifierProfileComponent implements OnInit {
  selectedType: string = 'candidat'; // Type du profil (candidat ou autoécole)
  formDataCandidat: Profil = new Profil(); // Données pour un candidat
  formDataAutoecole: ProfilAE = new ProfilAE(); // Données pour une auto-école
  profileId!: number; // ID du profil à modifier

  constructor(
    private route: ActivatedRoute, // Pour récupérer les paramètres de la route
    private apiService: ApiService,
    private router: Router // Pour rediriger après modification
  ) {}

  ngOnInit(): void {
    // Récupérer l'ID depuis l'URL
    this.profileId = Number(this.route.snapshot.paramMap.get('id_personne'));
    // Charger les données du profil à modifier
    this.loadProfile();
  }

  // Charger le profil en fonction du type sélectionné
 loadProfile(): void {
  if (this.selectedType === 'candidat') {
    // Charger les données du candidat en fonction de l'ID
    this.apiService.getDataCandidatsById(this.profileId).subscribe(
      (data: Profil) => {
        this.formDataCandidat = data; // Pré-remplir les champs du formulaire
      },
      error => {
        console.error('Erreur lors du chargement du candidat', error);
      }
    );
  } else if (this.selectedType === 'autoecole') {
    // Charger les données de l'auto-école en fonction de l'ID
    this.apiService.getDataAutoecoleById(this.profileId).subscribe(
      (data: ProfilAE) => {
        this.formDataAutoecole = data; // Pré-remplir les champs du formulaire
      },
      error => {
        console.error('Erreur lors du chargement de l\'auto-école', error);
      }
    );
  }
}

  // Soumettre les modifications
  onSubmit(): void {
    if (this.selectedType === 'candidat') {
      this.apiService.putDataCandidat(this.formDataCandidat).subscribe(
        response => {
          alert('Candidat modifié avec succès');
          this.router.navigate(['/dashboard']); // Redirection vers le tableau de bord
        },
        error => {
          console.error('Erreur lors de la modification du candidat', error);
        }
      );
    } else if (this.selectedType === 'autoecole') {
      this.apiService.putDataAutoecole(this.formDataAutoecole).subscribe(
        response => {
          alert('Auto-école modifiée avec succès');
          this.router.navigate(['/dashboard']); // Redirection vers le tableau de bord
        },
        error => {
          console.error('Erreur lors de la modification de l\'auto-école', error);
        }
      );
    }
  }

  // Retourner au tableau de bord sans modifier
  onCancel(): void {
    this.router.navigate(['/dashboard']);
  }

}
