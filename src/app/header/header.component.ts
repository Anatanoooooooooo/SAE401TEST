import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';


@Component({
  selector: 'app-header',
  standalone: false,
  templateUrl: './header.component.html',
  styleUrl: './header.component.css'
})
export class HeaderComponent implements OnInit {
  showHeader: boolean = true;
  private noHeaderRoutes: string[] = ['/login']; // Routes sans header

  constructor(private router: Router) {}

  ngOnInit(): void {
    this.router.events.subscribe(() => {
      this.showHeader = !this.noHeaderRoutes.includes(this.router.url);
    });
  }

  getUserRole(): string | null {
    const user = localStorage.getItem('user');
    return user ? JSON.parse(user).role : null; // Retourne le rôle ou null si aucun utilisateur
  }

  isLogged(): boolean {
    const user = localStorage.getItem('user');
    return user !== null; // Retourne true si un utilisateur est connecté
  }
  
  isAdmin(): boolean {
    return this.getUserRole() === 'admin'; // Vérifie si le rôle est "admin"
  }
  
  isCandidat(): boolean {
    return this.getUserRole() === 'candidat'; // Vérifie si le rôle est "candidat"
  }
  

  logout(): void {
    localStorage.removeItem('user'); // Supprime le token utilisateur
    this.router.navigate(['/login']); // Redirige vers la page de connexion
  }
  


}
