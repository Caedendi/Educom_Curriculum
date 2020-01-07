import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { HeaderDecoComponent } from './header-deco.component';

describe('HeaderDecoComponent', () => {
  let component: HeaderDecoComponent;
  let fixture: ComponentFixture<HeaderDecoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ HeaderDecoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(HeaderDecoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
