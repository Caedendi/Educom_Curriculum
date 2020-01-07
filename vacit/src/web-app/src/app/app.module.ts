import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './components/pages/home/home.component';

import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { NavbarComponent } from './components/header/navbar/navbar.component';

import { DataTablesModule } from 'angular-datatables';
import { QuillModule } from 'ngx-quill';

import { HeaderDecoComponent } from './components/header/header-deco/header-deco.component';
import { FooterDecoComponent } from './components/footer/footer-deco/footer-deco.component';
import { SlideshowComponent } from './components/pages/slideshow/slideshow.component';
import { ApiResultsComponent } from './components/pages/api-results/api-results.component';
import { TextEditorComponent } from './components/text-editor/text-editor.component';
import { TestComponent } from './components/pages/test/test.component';
import { FooterAddressComponent } from './components/footer/footer-address/footer-address.component';
import { FooterPrivacyComponent } from './components/footer/footer-privacy/footer-privacy.component';
import { RegisterComponent } from './components/pages/register/register.component';
import { LoginComponent } from './components/pages/login/login.component';
import { BannerComponent } from './components/banner/banner.component';
import { ProfileComponent } from './components/pages/profile/profile.component';
import { DetailsComponent } from './components/pages/details/details.component';
import { ApplicationsComponent } from './components/pages/applications/applications.component';
import { JobsComponent } from './components/pages/jobs/jobs.component';
import { NavbarTestComponent } from './components/header/navbar-test/navbar-test.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    HeaderComponent,
    FooterComponent,
    NavbarComponent,
    HeaderDecoComponent,
    FooterDecoComponent,
    SlideshowComponent,
    ApiResultsComponent,
    TextEditorComponent,
    TestComponent,
    FooterAddressComponent,
    FooterPrivacyComponent,
    RegisterComponent,
    LoginComponent,
    BannerComponent,
    ProfileComponent,
    DetailsComponent,
    ApplicationsComponent,
    JobsComponent,
    NavbarTestComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    AppRoutingModule,
    DataTablesModule,
    QuillModule.forRoot(),
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
