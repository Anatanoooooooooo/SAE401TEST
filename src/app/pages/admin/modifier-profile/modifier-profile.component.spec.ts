import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModifierProfileComponent } from './modifier-profile.component';

describe('ModifierProfileComponent', () => {
  let component: ModifierProfileComponent;
  let fixture: ComponentFixture<ModifierProfileComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ModifierProfileComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModifierProfileComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
