import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

// modules
import { DataTablesModule } from 'angular-datatables';
import { QuillModule } from 'ngx-quill';

// website skeleton
import { HeaderComponent } from './components/header/header.component';
import { HeaderDecoComponent } from './components/header/header-deco/header-deco.component';
import { NavbarComponent } from './components/header/navbar/navbar.component';
import { FooterComponent } from './components/footer/footer.component';
import { FooterDecoComponent } from './components/footer/footer-deco/footer-deco.component';
import { FooterAddressComponent } from './components/footer/footer-address/footer-address.component';
import { FooterPrivacyComponent } from './components/footer/footer-privacy/footer-privacy.component';

// pages
import { HomeComponent } from './components/pages/home/home.component';
import { BannerComponent } from './components/banner/banner.component';
import { RecentsComponent } from './components/recents/recents.component';
import { RegisterComponent } from './components/pages/register/register.component';
import { LoginComponent } from './components/pages/login/login.component';
import { ProfileComponent } from './components/pages/profile/profile.component';
import { ApplicationsComponent } from './components/pages/applications/applications.component';
import { JobsComponent } from './components/pages/jobs/jobs.component';
import { DetailsComponent } from './components/pages/details/details.component';

// testing
import { SlideshowComponent } from './components/pages/slideshow/slideshow.component';
import { ApiResultsComponent } from './components/pages/api-results/api-results.component';
import { TextEditorComponent } from './components/text-editor/text-editor.component';
import { TestComponent } from './components/pages/test/test.component';
import { NavbarTestComponent } from './components/header/navbar-test/navbar-test.component';

@NgModule({
  declarations: [
    AppComponent,

    HeaderComponent,
    HeaderDecoComponent,
    NavbarComponent,
    FooterComponent,
    FooterDecoComponent,
    FooterAddressComponent,
    FooterPrivacyComponent,

    HomeComponent,
    BannerComponent,
    RecentsComponent,
    RegisterComponent,
    LoginComponent,
    ProfileComponent,
    ApplicationsComponent,
    JobsComponent,
    DetailsComponent,

    NavbarTestComponent,
    ApiResultsComponent,
    TextEditorComponent,
    TestComponent,
    SlideshowComponent,
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
