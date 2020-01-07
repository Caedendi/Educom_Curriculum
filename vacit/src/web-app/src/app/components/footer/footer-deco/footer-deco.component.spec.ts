import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FooterDecoComponent } from './footer-deco.component';

describe('FooterDecoComponent', () => {
  let component: FooterDecoComponent;
  let fixture: ComponentFixture<FooterDecoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FooterDecoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FooterDecoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
