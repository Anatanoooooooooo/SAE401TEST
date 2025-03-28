import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { DashboardComponent } from './pages/admin/dashboard/dashboard.component';
import { HomeComponent } from './pages/home/home.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { AjoutProfileComponent } from './pages/admin/ajout-profile/ajout-profile.component';
import { ModifierProfileComponent } from './pages/admin/modifier-profile/modifier-profile.component';
import { DashboardCandidatComponent } from './pages/candidat/dashboard-candidat/dashboard-candidat.component';
import { AvisEleveComponent } from './pages/candidat/avis-eleve/avis-eleve.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    DashboardComponent,
    HomeComponent,
    HeaderComponent,
    FooterComponent,
    AjoutProfileComponent,
    ModifierProfileComponent,
    DashboardCandidatComponent,
    AvisEleveComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
