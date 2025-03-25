import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AvisEleveComponent } from './avis-eleve.component';

describe('AvisEleveComponent', () => {
  let component: AvisEleveComponent;
  let fixture: ComponentFixture<AvisEleveComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [AvisEleveComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AvisEleveComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
