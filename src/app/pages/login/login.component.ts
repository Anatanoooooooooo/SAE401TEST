import { Component } from '@angular/core';
import { LoginService } from '../../services/api/login.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: false,
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  data: any[] = [];
  login: string = '';
  mdp: string = '';
  errorMessage: string = '';

  constructor(private loginService: LoginService, private router: Router) {}

  ngOnInit(): void {
    this.getDataFromApi();
  }

  getDataFromApi(): void {
    this.loginService.getData().subscribe(response => {
      this.data = response;
      console.log('Données reçues:', this.data);
    });
  }

  onSubmit(): void {
    this.loginService.postData({ login: this.login, mdp: this.mdp }).subscribe({
      next: (response: { user: { id: string, role: string } }) => {
        localStorage.setItem('user', JSON.stringify(response.user)); // Sauvegarde de l'utilisateur
        this.redirectUser(response.user.role); // Redirection en fonction du rôle
      },
      error: err => console.error("Erreur API :", err)
    });
}

redirectUser(role: string): void {
    switch (role) {
      case 'admin':
        this.router.navigate(['/dashboard']);
        break;
      case 'autoecole':
        this.router.navigate(['/home']);
        break;
      case 'candidat':
        this.router.navigate(['/home']);
        break;
      default:
        this.router.navigate(['/home']); // Page générique
        break;
    }
  }

}
