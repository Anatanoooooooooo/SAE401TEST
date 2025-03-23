import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './services/auth-guard.service';
import { DashboardComponent } from './pages/admin/dashboard/dashboard.component';
import { HomeComponent } from './pages/home/home.component';
import { LoginComponent } from './pages/login/login.component';
import { AjoutProfileComponent } from './pages/admin/ajout-profile/ajout-profile.component';
import { ModifierProfileComponent } from './pages/admin/modifier-profile/modifier-profile.component';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'dashboard', component: DashboardComponent, canActivate: [AuthGuard] },
  { path: 'ajout-profile', component: AjoutProfileComponent, canActivate: [AuthGuard] },
  { path: 'modifier-profile', component: ModifierProfileComponent, canActivate: [AuthGuard] },
  { path: 'home', component: HomeComponent},
  { path: '**', redirectTo: '/home' } // Redirection par défaut
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
