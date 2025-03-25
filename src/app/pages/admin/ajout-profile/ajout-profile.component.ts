import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../../services/api/api.service';
import { Profil } from '../../../models/profil';
import { ProfilAE } from '../../../models/profil-ae';


@Component({
  selector: 'app-ajout-profile',
  standalone: false,
  templateUrl: './ajout-profile.component.html',
  styleUrl: './ajout-profile.component.css'
})
export class AjoutProfileComponent {
  selectedType: string = 'candidat'; // Type sélectionné
  nomProfil: string = "Nom du profil par défaut";
  formDataCandidat: Profil = new Profil(); // Modèle pour candidat
  formDataAutoecole: ProfilAE = new ProfilAE(); // Modèle pour auto-école

  constructor(private router: Router, private candidatService: ApiService, private autoecoleService: ApiService) {}

  // Gestion du changement de type
  onTypeChange() {
    if (this.selectedType === 'candidat') {
      this.formDataCandidat = new Profil(); // Réinitialisation des champs pour candidat
    } else if (this.selectedType === 'autoecole') {
      this.formDataAutoecole = new ProfilAE(); // Réinitialisation des champs pour auto-école
    }
  }

  // Soumission des données du formulaire
  onSubmit() {
    if (this.selectedType === 'candidat') {
      this.candidatService.postDataCandidat(this.formDataCandidat).subscribe(
        response => {
          console.log('Candidat ajouté avec succès', response);
          alert('Candidat ajouté avec succès !');
          this.router.navigate(['dashboard']);

        },
        error => {
          console.error('Erreur lors de l\'ajout du candidat', error);
          alert('Erreur lors de l\'ajout du candidat.');
        }
      );
    } else if (this.selectedType === 'autoecole') {
      this.autoecoleService.postDataAutoecole(this.formDataAutoecole).subscribe(
        response => {
          console.log('Auto-école ajoutée avec succès', response);
          alert('Auto-école ajoutée avec succès !');
        },
        error => {
          console.error('Erreur lors de l\'ajout de l\'auto-école', error);
          alert('Erreur lors de l\'ajout de l\'auto-école.');
        }
      );
    }
  }

  retour() {
    alert('Retour à l\'étape précédente ou réinitialisation de la page.');
  }

}

