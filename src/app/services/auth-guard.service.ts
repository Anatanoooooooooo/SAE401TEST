import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(private router: Router) {}

  canActivate(): boolean {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    
    if (user && user.role) {
      return true;
    } else {
      this.router.navigate(['/login'], { replaceUrl: true}); // Redirection vers le login si pas connecté
      return false;
    }
  }
}
