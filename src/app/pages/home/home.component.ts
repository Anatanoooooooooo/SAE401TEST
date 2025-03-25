import { Component, ElementRef, AfterViewInit } from '@angular/core';

@Component({
  selector: 'app-home',
  standalone: false,
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent implements AfterViewInit {
  counters!: NodeListOf<HTMLSpanElement>;
  animatedElements!: NodeListOf<HTMLElement>;

  constructor(private elementRef: ElementRef) {}

  ngAfterViewInit(): void {
    // Gérer les compteurs
    this.initCounters();

    // Gérer les animations au défilement
    this.initAnimations();
  }

  private initCounters(): void {
    this.counters = this.elementRef.nativeElement.querySelectorAll('.number');
    const observerOptions: IntersectionObserverInit = { threshold: 0.5 };

    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const counter = entry.target as HTMLSpanElement;
          const target = parseInt(counter.getAttribute('data-target') || '0', 10);
          this.startCounter(counter, target);
          observer.unobserve(counter); // Désactiver l'observation après comptage
        }
      });
    }, observerOptions);

    this.counters.forEach((counter) => counterObserver.observe(counter));
  }

  private startCounter(counter: HTMLSpanElement, target: number): void {
    let count = 0;
    const speed = 100;

    const update = (): void => {
      const increment = Math.ceil(target / speed);
      if (count < target) {
        count += increment;
        counter.innerText = count.toLocaleString('fr-FR'); // Affiche en français
        requestAnimationFrame(update);
      } else {
        counter.innerText = target.toLocaleString('fr-FR'); // Valeur finale
      }
    };

    update();
  }

  private initAnimations(): void {
    this.animatedElements = this.elementRef.nativeElement.querySelectorAll(
      '.stat, .image-wrapper, .success-circle'
    );

    const animObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          (entry.target as HTMLElement).style.animationPlayState = 'running';
          observer.unobserve(entry.target); // Une fois animée, désactiver
        }
      });
    }, { threshold: 0.3 });

    this.animatedElements.forEach((element) => {
      element.style.animationPlayState = 'paused'; // Initialement en pause
      animObserver.observe(element);
    });
  }
}

