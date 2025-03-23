import { Component } from '@angular/core';
import { Router } from '@angular/router';


@Component({
  selector: 'app-dashboard',
  standalone: false,
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent {

  profiles = [1, 2, 3, 4, 5, 6, 7, 8]; // Exemple de données

  editProfile(profile: number) {
    // Redirection vers admin.html
    window.location.href = '/modifier-profile';
  }

  deleteProfile(profile: number) {
    alert(`Supprimer le profil: ${profile}`);
  }


}

