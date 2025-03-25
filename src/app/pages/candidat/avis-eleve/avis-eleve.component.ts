import { Component } from '@angular/core';
import { ApiService } from '../../../services/api/api.service';

@Component({
  selector: 'app-avis-eleve',
  standalone: false,
  templateUrl: './avis-eleve.component.html',
  styleUrl: './avis-eleve.component.css'
})
export class AvisEleveComponent {
  avis: any[] = [];
  nouveauAvis: any = {
    titre: '',
    texte: ''
  };

  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.fetchAvis();
  }

  fetchAvis(): void {
    this.apiService.getDataAvis().subscribe((data: any) => {
      this.avis = data;
    });
  }

  ajouterAvis(nouvelAvis: any): void {
    this.apiService.postDataAvis(nouvelAvis).subscribe(() => {
      this.fetchAvis(); // Recharger les avis après ajout
      this.nouveauAvis = { titre: '', texte: '' }; // Réinitialiser le formulaire
    });
  }

  modifierAvis(avisModifie: any): void {
    this.apiService.updateDataAvis(avisModifie).subscribe(() => {
      this.fetchAvis(); // Recharger les avis après modification
    });
  }

  supprimerAvis(id: number): void {
    this.apiService.deleteDataAvis(id).subscribe(() => {
      this.fetchAvis(); // Recharger les avis après suppression
    });
  }
}
