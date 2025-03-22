import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-footer',
  standalone: false,
  templateUrl: './footer.component.html',
  styleUrl: './footer.component.css'
})
export class FooterComponent implements OnInit{
  showFooter: boolean = true;
  private noFooterRoutes: string[] = ['/login']; // Routes sans footer

  constructor(private router: Router) {}

  ngOnInit(): void {
    this.router.events.subscribe(() => {
      this.showFooter = !this.noFooterRoutes.includes(this.router.url);
    });
  }

}
