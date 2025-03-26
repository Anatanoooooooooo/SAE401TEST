import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ApiService } from '../../../services/api/api.service';

@Component({
  selector: 'app-modifier-profile',
  standalone: false,
  templateUrl: './modifier-profile.component.html',
  styleUrl: './modifier-profile.component.css'
})
export class ModifierProfileComponent implements OnInit {
  formDataCandidat: any = {};
  formDataAutoecole: any = {};
  apiType: string = '';

  constructor(private route: ActivatedRoute, private apiService: ApiService, private router: Router) {}

  ngOnInit(): void {
    const id = Number(this.route.snapshot.paramMap.get('id_personne')); // Conversion de l'ID en number
    this.apiType = this.route.snapshot.paramMap.get('type') || '';
  
    if (this.apiType === 'candidat') {
      this.apiService.getDataCandidatsById(id).subscribe(
        (data) => {
          this.formDataCandidat = { ...data, id_personne: id }; // Ajoutez l'ID aux données
          console.log('Données récupérées pour candidat :', this.formDataCandidat);
        },
        (error) => {
          console.error('Erreur lors de la récupération du candidat :', error);
        }
      );
    } else if (this.apiType === 'autoecole') {
      this.apiService.getDataAutoecoleById(id).subscribe(
        (data) => {
          this.formDataAutoecole = { ...data, id_personne: id }; // Ajoutez l'ID aux données
          console.log('Données récupérées pour auto-école :', this.formDataAutoecole);
        },
        (error) => {
          console.error('Erreur lors de la récupération de l\'auto-école :', error);
        }
      );
    }
  }

  modifierProfil() {
    if (this.apiType === 'candidat') {
      console.log('Données envoyées pour candidat :', this.formDataCandidat);
      this.apiService.updateDataCandidat(this.formDataCandidat).subscribe(
        (response) => {
          alert('Candidat mis à jour avec succès');
        },
        (error) => {
          console.error('Erreur lors de la mise à jour du candidat :', error);
          this.router.navigate(['dashboard']);
        }
      );
    } else if (this.apiType === 'autoecole') {
      console.log('Données envoyées pour auto-école :', this.formDataAutoecole);
      this.apiService.updateDataAutoecole(this.formDataAutoecole).subscribe(
        (response) => {
          alert('Auto-école mise à jour avec succès');
        },
        (error) => {
          console.error('Erreur lors de la mise à jour de l\'auto-école :', error);
        }
      );
    }
  }

  onCancel() {
    // Logique pour annuler ou revenir au dashboard
    history.back();
  }
}

