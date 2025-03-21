import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class LoginService {

private apiURL = 'http://localhost/tp4/api/src'; // Remplace par l'URL de ton API PHP
constructor(private http: HttpClient) { }

// Méthode GET pour récupérer des données
getData(): Observable<any> {
  return this.http.get<any>(`${this.apiURL}/get.php`);
}

// Méthode POST pour envoyer des données
postData(credentials: any): Observable<any> {
  return this.http.post<any>(`${this.apiURL}/login.php`, credentials);
}

}
