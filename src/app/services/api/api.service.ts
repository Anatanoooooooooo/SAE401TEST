import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';



@Injectable({
  providedIn: 'root'
})

export class ApiService {

private apiURL = 'http://localhost/tp4/api/src'; // Remplace par l'URL de ton API PHP
constructor(private http: HttpClient) { }

// Méthode GET pour récupérer des données (login)
getDataLogin(): Observable<any> {
  return this.http.get<any>(`${this.apiURL}/get.php`);
}

// Méthode GET pour récupérer les profils (Candidat)
getDataCandidats(): Observable<any> {
  return this.http.get<any>(`${this.apiURL}/getC.php`);
}

// Méthode GET pour récupérer les profils (Autoecole)
getDataAutoecole(): Observable<any> {
  return this.http.get<any>(`${this.apiURL}/getAE.php`);
}

// Méthode GET pour récupérer l'ID pour modifier(Candidat)
getDataCandidatsById(id_personne: number): Observable<any> {
  return this.http.get<any>(`${this.apiURL}/getC.php`);
}

// Méthode GET pour récupérer l'ID pour modifier(Autoecole)
getDataAutoecoleById(id_personne: number): Observable<any> {
  return this.http.get<any>(`${this.apiURL}/getC.php`);
}

// Méthode POST pour envoyer des données (login)
postDataLogin(credentials: any): Observable<any> {
  return this.http.post<any>(`${this.apiURL}/login.php`, credentials);
}

// Méthode POST pour envoyer des données (profile Candidat)
postDataCandidat(credentials: any): Observable<any> {
  return this.http.post<any>(`${this.apiURL}/personneCAjout.php`, credentials);
}

// Méthode POST pour envoyer des données (profile Autoecole)
postDataAutoecole(credentials: any): Observable<any> {
  return this.http.post<any>(`${this.apiURL}/personneAEAjout.php`, credentials);
}

// Méthode PUT pour envoyer des données (profile Candidat)
putDataCandidat(credentials: any): Observable<any> {
  return this.http.put<any>(`${this.apiURL}/personneCModif.php`, credentials);
}

// Méthode PUT pour envoyer des données (profile Autoecole)
putDataAutoecole(credentials: any): Observable<any> {
  return this.http.put<any>(`${this.apiURL}/personneAEModif.php`, credentials);
}

// Méthode DELETE pour Candidat
deleteDataCandidat(id_personne: number): Observable<any> {
  return this.http.delete<any>(`${this.apiURL}/personneCSuppr.php?id_personne=${id_personne}`);
}

// Méthode DELETE pour Autoécole
deleteDataAutoecole(id_personne: number): Observable<any> {
  return this.http.delete<any>(`${this.apiURL}/personneAESuppr.php?id_personne=${id_personne}`);
}




}
